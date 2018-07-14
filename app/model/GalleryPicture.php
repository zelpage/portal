<?php

	namespace ZelPage;

	use \Nette\Utils\DateTime;

	class GalleryPicture {
		/** @var null|string */
		private $id;
		/** @var null|string */
		private $label;
		/** @var null|GalleryCategory */
		private $parent;
		/** @var null|string */
		private $title;
		/** @var null|string */
		private $place;
		/** @var null|string */
		private $dateCreated;
		/** @var null|DateTime */
		private $datePublished;
		/** @var null|User */
		private $author;
		/** @var null|string */
		private $note;
		/** @var int */
		private $pointsPositive = 0;
		/** @var int */
		private $pointsNegative = 0;
		/** @var User[] */
		private $pointsByAdministrators = [];
		/** @var null|string */
		private $published = 'y_n';
		/** @var string */
		private $ratingAllowed = 'y';
		/** @var string */
		private $commentsAllowed = 'y';
		/** @var int */
		private $commentCount = 0;

		public function getId(): ?string { return $this->id; }

		public function setId(?string $id): GalleryPicture {
			$this->id = $id;
			return $this;
		}

		public function getLabel(): ?string { return $this->label; }

		public function setLabel(?string $label): GalleryPicture {
			$this->label = $label;
			return $this;
		}

		public function getParent(): ?GalleryCategory { return $this->parent; }

		public function setParent(?GalleryCategory $parent): GalleryPicture {
			$this->parent = $parent;
			return $this;
		}

		public function getTitle(): ?string { return $this->title; }

		public function setTitle(?string $title): GalleryPicture {
			$this->title = $title;
			return $this;
		}

		public function getPlace(): ?string { return $this->place; }

		public function setPlace( ?string $place ): GalleryPicture {
			$this->place = $place;
			return $this;
		}

		public function getDateCreated(): ?string { return $this->dateCreated; }

		public function setDateCreated(?string $dateCreated): GalleryPicture {
			$this->dateCreated = $dateCreated;
			return $this;
		}

		public function getDatePublished(): ?DateTime { return $this->datePublished; }

		public function setDatePublished(?DateTime $datePublished): GalleryPicture {
			$this->datePublished = $datePublished;
			return $this;
		}

		public function getAuthor(): ?User { return $this->author; }

		public function setAuthor(?User $author): GalleryPicture {
			$this->author = $author;
			return $this;
		}

		public function getNote(): ?string { return $this->note; }

		public function setNote(?string $note): GalleryPicture {
			$this->note = $note;
			return $this;
		}

		public function getPointsPositive(): int { return $this->pointsPositive; }

		public function setPointsPositive(int $pointsPositive): GalleryPicture {
			$this->pointsPositive = $pointsPositive;
			return $this;
		}

		public function getPointsNegative(): int { return $this->pointsNegative; }

		public function setPointsNegative(int $pointsNegative): GalleryPicture {
			$this->pointsNegative = $pointsNegative;
			return $this;
		}

		/** @return User[] */
		public function getPointsByAdministrators(): array { return $this->pointsByAdministrators; }

		/**
		 * @param User[] $pointsByAdministrators
		 * @return GalleryPicture
		 */
		public function setPointsByAdministrators(array $pointsByAdministrators): GalleryPicture {
			$this->pointsByAdministrators = $pointsByAdministrators;
			return $this;
		}

		public function getPublished(): ?string { return $this->published; }


		public function setPublished(?string $published): GalleryPicture {
			$this->published = $published;
			return $this;
		}

		public function getRatingAllowed(): string { return $this->ratingAllowed; }

		public function setRatingAllowed(string $ratingAllowed): GalleryPicture {
			$this->ratingAllowed = $ratingAllowed;
			return $this;
		}

		public function getCommentsAllowed(): string { return $this->commentsAllowed; }

		public function setCommentsAllowed(string $commentsAllowed): GalleryPicture {
			$this->commentsAllowed = $commentsAllowed;
			return $this;
		}

		public function getCommentCount(): int { return $this->commentCount; }

		public function setCommentCount(int $commentCount): GalleryPicture {
			$this->commentCount = $commentCount;
			return $this;
		}
	}
