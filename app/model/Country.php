<?php

	namespace ZelPage;

	class Country {
		/** @var int */
		private $id;
		/** @var string */
		private $name;
		/** @var string */
		private $seoHandle;
		/** @var string */
		private $abbr;
		/** @var int|null */
		private $uicCode;
		/** @var string */
		private $nameEn;
		/** @var string */
		private $nameDe;
		/** @var string */
		private $nameFr;
		/** @var string */
		private $nameOrig;
		/** @var string */
		private $continent;

		public function getId(): ?int { return $this->id; }

		public function setId(int $id): Country {
			$this->id = $id;
			return $this;
		}

		public function getName(): ?string { return $this->name; }

		public function setName(string $name): Country {
			$this->name = $name;
			return $this;
		}

		public function getSeoHandle(): ?string { return $this->seoHandle; }

		public function setSeoHandle(?string $seoHandle): Country {
			$this->seoHandle = $seoHandle;
			return $this;
		}

		public function getAbbr(): ?string { return $this->abbr; }

		public function setAbbr(?string $abbr): Country {
			$this->abbr = $abbr;
			return $this;
		}

		public function getUicCode(): ?int { return $this->uicCode; }

		public function setUicCode(?int $uicCode): Country {
			$this->uicCode = $uicCode;
			return $this;
		}

		public function getNameEn(): ?string { return $this->nameEn; }

		public function setNameEn(?string $nameEn): Country {
			$this->nameEn = $nameEn;
			return $this;
		}

		public function getNameDe(): ?string { return $this->nameDe; }

		public function setNameDe(?string $nameDe): Country {
			$this->nameDe = $nameDe;
			return $this;
		}

		public function getNameFr(): ?string { return $this->nameFr; }

		public function setNameFr(?string $nameFr): Country {
			$this->nameFr = $nameFr;
			return $this;
		}

		public function getNameOrig(): ?string { return $this->nameOrig; }

		public function setNameOrig(?string $nameOrig): Country {
			$this->nameOrig = $nameOrig;
			return $this;
		}

		public function getContinent(): ?string { return $this->continent; }

		public function setContinent(?string $continent): Country {
			$this->continent = $continent;
			return $this;
		}
	}
