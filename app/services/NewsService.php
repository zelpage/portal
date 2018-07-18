<?php

	namespace ZelPage;

	use \Nette\SmartObject;
	use \Nette\Database\Context;

	class NewsService {
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

		public function findCategoryByID(int $categoryID): ?Category {
			$row = $this->db->table('kategorie')->where('id', $categoryID)->fetch();
			return ($row === FALSE) ? NULL : self::mapToCategory($row);
		}

		/** @return News[] */
		public function findLatestNews(int $limit = 10): array {
			$news = [];
			foreach ($this->db->table('news')->order('datum_reverse ASC')->limit($limit) as $row) {
				$n = self::mapToNews($row);
				$news[] = $n
					->setAuthors($this->findNewsAuthors($n->getId()))
					->setCategories($this->findNewsCategories($n->getId()))
					;
			}
			return $news;
		}

		/**
		 * @param $newsID int
		 * @return User[]
		 */
		public function findNewsAuthors(int $newsID): array {
			$authors = [];
			foreach ($this->db->table('news_autor')->where('id_news', $newsID) as $row) {
				$author = $this->userService->findUserByID($row->id_autor);
				if (!is_null($author)) {
					$authors[] = $author;
				}
			}
			return $authors;
		}

		/**
		 * @param $newsID int
		 * @return Category[]
		 */
		public function findNewsCategories(int $newsID): array {
			$categories = [];
			foreach ($this->db->table('news_kategorie')->where('id_news', $newsID) as $row) {
				$category = $this->findCategoryByID($row->id_kategorie);
				if (!is_null($category)) {
					$categories[] = $category;
				}
			}
			return $categories;
		}

		private static function mapToCategory($row): Category {
			$c = (new Category())
				->setId($row->id)
				->setType($row->typ)
				->setVisible(boolval($row->zobraz))
				;

			if (empty($row->nazev) === FALSE) { $c->setName($row->nazev); }
			if (empty($row->img) === FALSE) { $c->setImage($row->img); }
			if (empty($row->poradi) === FALSE) { $c->setOrderPosition($row->poradi); }
			if (empty($row->seo_url) === FALSE) { $c->setSeoUrl($row->seo_url); }

			return $c;
		}

		private static function mapToNews($row): News {
			$n = (new News())
				->setId($row->id)
				;

			if (empty($row->titulek) === FALSE) { $n->setTitle($row->titulek); }
			if (empty($row->perex) === FALSE) { $n->setPerex($row->perex); }
			if (empty($row->datum) === FALSE) { $n->setTimestamp($row->datum); }
			if (empty($row->zprava) === FALSE) { $n->setText($row->zprava); }

			return $n;
		}

	}
