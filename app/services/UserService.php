<?php

	namespace ZelPage;

	use \Nette\Database\Row;
	use \Nette\Database\Table\ActiveRow;
	use \Nette\SmartObject;
	use \Nette\Database\Context;

	class UserService {
		use SmartObject;
		use LegacyAwareObject;

		/** @var Context */
		private $db;

		public function __construct(Context $db) {
			$this->db = $db;
		}

		/**
		 * Finds all system user groups, and also includes group layers.
		 *
		 * @return Group[]
		 */
		public function findGroups(): array {
			$gs = [];
			foreach ($this->db->query('SELECT id, name, comment, id_forum, slack FROM groups ORDER BY id ASC') as $row) {
				$g = self::mapToGroup($row);
				$gs[$g->getId()] = $g;
			}

			foreach ($this->db->query('SELECT id, id_group, nadpis, uroven FROM group_layers ORDER BY id_group ASC, uroven ASC') as $row) {
				self::mapToGroupLayer($row, $gs);
			}

			return $gs;
		}

		public function findUserByID(int $id): ?User {
			$row = $this->db->table('users')->where('id', $id)->fetch();
			return ($row === FALSE) ? NULL : self::mapToUser($row);
		}

		public function findUserByUsername(string $username): ?User {
			$row = $this->db->table('users')->where('login', $username)->fetch();
			return ($row === FALSE) ? NULL : self::mapToUser($row);
		}

		private static function mapToGroup(Row $row): Group {
			$g = (new Group())
				->setId($row->id)
				->setName($row->name)
				->setDescription($row->comment)
				;

			if (empty($row->id_forum) === FALSE) { $g->setForumId(intval($row->id_forum)); }
			if (empty($row->slack) === FALSE) { $g->setSlack($row->slack); }

			return $g;
		}

		/**
		 * @param Row $row
		 * @param Group[] $groups
		 */
		public function mapToGroupLayer(Row $row, array &$groups) {
			$gl = (new GroupLayer())
				->setId($row->id)
				->setName($row->nadpis)
				->setLevel($row->uroven)
				;

			if (array_key_exists($row->id_group, $groups)) {
				$groups[$row->id_group]->addLayer($gl);
			}
		}

		private static function mapToUser(ActiveRow $row): User {
			$u = (new User())
				->setId($row->id)
				->setMigratedFromMD5($row->is_migrated_from_md5)
				;

			if (empty($row->login) === FALSE) { $u->setLogin($row->login); }
			if (empty($row->pass) === FALSE) { $u->setPassword($row->pass); }
			if (empty($row->jmeno) === FALSE) { $u->setName($row->jmeno); }
			if (empty($row->zkratka) === FALSE) { $u->setAbbr($row->zkratka); }
			if (empty($row->nick) === FALSE) { $u->setNickname($row->nick); }
			if (empty($row->email) === FALSE) { $u->setEmail($row->email); }

			return $u;
		}
	}
