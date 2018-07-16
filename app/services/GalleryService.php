<?php

	namespace ZelPage;

	use \Nette\Database\Context;
	use \Nette\SmartObject;

	class GalleryService {
		use SmartObject;
		use LegacyAwareObject;

		/** @var Context */
		private $db;
		/** @var UserService */
		private $userService;

		public function __construct(Context $db, UserService $userService) {
			$this->db = $db;
			$this->userService = $userService;
		}

		/** @return GalleryPicture[] */
		public function getLatestPictures($limit = 10): array {
			$pictures = [];
			foreach ($this->db->table('fotogalerie')->where('typ', 'pic')->where('zobrazit', 'y')->where('date_p_reverse >= ?', 2051218800 - strtotime(date('Y-m-d H:i:00')))->order('date_p_reverse ASC')->limit($limit) as $row) {
				$picture = self::mapToPicture($row);
				$pictures[] = $picture
					->setAuthor($this->userService->findUserByID($picture->getAuthor()->getId()))
					;
			}
			return $pictures;
		}

		private static function mapToPicture($row): GalleryPicture {
			$p = (new GalleryPicture())
				->setId($row->id)
				;

			if (empty($row->popis) === FALSE) { $p->setLabel($row->popis); }
			if (empty($row->parent) === FALSE) { $p->setParent((new GalleryCategory())->setId($row->parent)); }
			if (empty($row->titulek) === FALSE) { $p->setTitle($row->titulek); }
			if (empty($row->misto) === FALSE) { $p->setPlace($row->misto); }
			if (empty($row->date_f) === FALSE) { $p->setDateCreated($row->date_f); }
			if (empty($row->date_p) === FALSE) { $p->setDatePublished($row->date_p); }
			if (empty($row->id_autor) === FALSE) { $p->setAuthor((new User())->setId($row->id_autor)); }
			if (empty($row->note) === FALSE) { $p->setNote($row->note); }
			if (empty($row->hodn_y) === FALSE) { $p->setPointsPositive($row->hodn_y); }
			if (empty($row->hodn_n) === FALSE) { $p->setPointsNegative($row->hodn_n); }
			if (empty($row->hodn_user) === FALSE) { // TODO
			}
			if (empty($row->zobrazit) === FALSE) { $p->setPublished($row->zobrazit); }
			if (empty($row->hodnoceni) === FALSE) { $p->setRatingAllowed($row->hodnoceni); }
			if (empty($row->komenty) === FALSE) { $p->setCommentsAllowed($row->komenty); }
			if (empty($row->poc_koment) === FALSE) { $p->setCommentCount($row->poc_koment); }

			return $p;
		}

	}
