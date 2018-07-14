<?php

	namespace ZelPage;

	class Region {
		/** @var null|int */
		private $id;
		/** @var null|string */
		private $name;
		/** @var null|int */
		private $kzcRegion;
		/** @var null|int */
		private $kzcCountry;
		/** @var null|string */
		private $abbr;
		/** @var null|int */
		private $orderPosition;
		/** @var bool */
		private $visible = TRUE;
		/** @var null|string */
		private $seoUrl;

		public function getId(): ?int { return $this->id; }

		public function setId(?int $id): Region {
			$this->id = $id;
			return $this;
		}

		public function getName(): ?string { return $this->name; }

		public function setName(?string $name): Region {
			$this->name = $name;
			return $this;
		}

		public function getKzcRegion(): ?int { return $this->kzcRegion; }

		public function setKzcRegion(?int $kzcRegion): Region {
			$this->kzcRegion = $kzcRegion;
			return $this;
		}

		public function getKzcCountry(): ?int { return $this->kzcCountry; }

		public function setKzcCountry(?int $kzcCountry): Region {
			$this->kzcCountry = $kzcCountry;
			return $this;
		}

		public function getAbbr(): ?string { return $this->abbr; }

		public function setAbbr(?string $abbr): Region {
			$this->abbr = $abbr;
			return $this;
		}

		public function getOrderPosition(): ?int { return $this->orderPosition; }

		public function setOrderPosition(?int $orderPosition): Region {
			$this->orderPosition = $orderPosition;
			return $this;
		}

		public function isVisible(): bool { return $this->visible; }

		public function setVisible(bool $visible): Region {
			$this->visible = $visible;
			return $this;
		}

		public function getSeoUrl(): ?string { return $this->seoUrl; }

		public function setSeoUrl(?string $seoUrl): Region {
			$this->seoUrl = $seoUrl;
			return $this;
		}
	}
