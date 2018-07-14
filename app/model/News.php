<?php

	namespace ZelPage;

	use \Nette\Utils\DateTime;

	class News {
		/** @var null|int */
		private $id;
		/** @var User[] */
		private $authors = [];
		/** @var null|string */
		private $title;
		/** @var null|Image */
		private $image;
		/** @var null|string */
		private $perex;
		/** @var null|DateTime */
		private $timestamp;
		/** @var int */
		private $timestampReverse = 0;
		/** @var null|string */
		private $text;
		/** @var Region[] */
		private $regions = [];
		/** @var Category[] */
		private $categories = [];
		/** @var null|string */
		private $approveState;
		/** @var null|string */
		private $seoUrl;
		/** @var string */
		private $type = 'n';
		/** @var ImageFolder[] */
		private $imageFolder = [];
		/** @var bool */
		private $top = FALSE;
		/** @var null|string */
		private $description;
		/** @var null|string */
		private $keywords;

		public function getId(): ?int { return $this->id; }

		public function setId(?int $id): News {
			$this->id = $id;
			return $this;
		}

		/** @return User[] */
		public function getAuthors(): array { return $this->authors; }

		/**
		 * @param User[] $authors
		 * @return News
		 */
		public function setAuthors(array $authors): News {
			$this->authors = $authors;
			return $this;
		}

		public function getTitle(): ?string { return $this->title; }

		public function setTitle(?string $title): News {
			$this->title = $title;
			return $this;
		}

		public function getImage(): ?Image { return $this->image; }

		public function setImage(?Image $image): News {
			$this->image = $image;
			return $this;
		}

		public function getPerex(): ?string { return $this->perex; }

		public function setPerex(?string $perex): News {
			$this->perex = $perex;
			return $this;
		}

		public function getTimestamp(): ?DateTime { return $this->timestamp; }

		public function setTimestamp(?DateTime $timestamp ): News {
			$this->timestamp = $timestamp;
			return $this;
		}

		public function getTimestampReverse(): int { return $this->timestampReverse; }

		public function setTimestampReverse(int $timestampReverse ): News {
			$this->timestampReverse = $timestampReverse;
			return $this;
		}

		public function getText(): ?string { return $this->text; }

		public function setText(?string $text): News {
			$this->text = $text;
			return $this;
		}

		/** @return Region[] */
		public function getRegions(): array { return $this->regions; }

		/**
		 * @param Region[] $regions
		 * @return News
		 */
		public function setRegions(array $regions): News {
			$this->regions = $regions;
			return $this;
		}

		/** @return Category[] */
		public function getCategories(): array { return $this->categories; }

		/**
		 * @param Category[] $categories
		 *
		 * @return News
		 */
		public function setCategories(array $categories): News {
			$this->categories = $categories;
			return $this;
		}

		public function getApproveState(): ?string { return $this->approveState; }

		public function setApproveState(?string $approveState): News {
			$this->approveState = $approveState;
			return $this;
		}

		public function getSeoUrl(): ?string { return $this->seoUrl; }

		public function setSeoUrl(?string $seoUrl): News {
			$this->seoUrl = $seoUrl;
			return $this;
		}

		public function getType(): string { return $this->type; }

		public function setType(string $type): News {
			$this->type = $type;
		}

		public function getImageFolder(): ?ImageFolder { return $this->imageFolder; }

		public function setImageFolder(?ImageFolder $imageFolder): News {
			$this->imageFolder = $imageFolder;
			return $this;
		}

		public function isTop(): bool { return $this->top; }

		public function setTop(bool $top): News {
			$this->top = $top;
			return $this;
		}

		public function getDescription(): ?string { return $this->description; }

		public function setDescription(?string $description): News {
			$this->description = $description;
			return $this;
		}

		public function getKeywords(): ?string { return $this->keywords; }

		public function setKeywords(?string $keywords): News {
			$this->keywords = $keywords;
			return $this;
		}
	}
