<?php

	namespace ZelPage;

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

		public function findUserByID(int $id): ?User {
			$row = $this->db->table('users')->where('id', $id)->fetch();
			return ($row === FALSE) ? NULL : self::mapToUser($row);
		}

		private static function mapToUser($row): User {
			$u = (new User())
				->setId($row->id)
				;

			if (empty($row->login) === FALSE) { $u->setLogin($row->login); }
			if (empty($row->jmeno) === FALSE) { $u->setName($row->jmeno); }
			if (empty($row->zkratka) === FALSE) { $u->setAbbr($row->zkratka); }
			if (empty($row->nick) === FALSE) { $u->setNickname($row->nick); }
			if (empty($row->email) === FALSE) { $u->setEmail($row->email); }

			return $u;
		}
	}