<?php

	namespace ZelPage;

	class Category {
		/** @var null|int */
		private $id;
		/** @var int */
		private $type = 0;
		/** @var null|string */
		private $name;
		/** @var null|string */
		private $image;
		/** @var null|int */
		private $orderPosition;
		/** @var bool */
		private $visible = TRUE;
		/** @var null|string */
		private $seoUrl;

		public function getId(): ?int { return $this->id; }

		public function setId(?int $id): Category {
			$this->id = $id;
			return $this;
		}

		public function getType(): int { return $this->type; }

		public function setType(int $type): Category {
			$this->type = $type;
			return $this;
		}

		public function getName(): ?string { return $this->name; }

		public function setName(?string $name): Category {
			$this->name = $name;
			return $this;
		}

		public function getImage(): ?string { return $this->image; }

		public function setImage(?string $image): Category {
			$this->image = $image;
			return $this;
		}

		public function getOrderPosition(): ?int { return $this->orderPosition; }

		public function setOrderPosition(?int $orderPosition): Category {
			$this->orderPosition = $orderPosition;
			return $this;
		}

		public function isVisible(): bool {	return $this->visible; }

		public function setVisible(bool $visible): Category {
			$this->visible = $visible;
			return $this;
		}

		public function getSeoUrl(): ?string { return $this->seoUrl; }

		public function setSeoUrl(?string $seoUrl): Category {
			$this->seoUrl = $seoUrl;
			return $this;
		}
	}
