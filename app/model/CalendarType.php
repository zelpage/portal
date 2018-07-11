<?php

	namespace ZelPage;

	class CalendarType {
		/** @var int */
		private $id;
		/** @var string */
		private $type;
		/** @var int */
		private $flag = 0;
		/** @var string */
		private $imageUrl;
		/** @var int */
		private $imageWidth = 0;
		/** @var int */
		private $imageHeight = 0;
		/** @var string */
		private $abbr;
		/** @var string */
		private $shortName;
		/** @var string */
		private $longName;

		public function getId(): ?int { return $this->id; }

		public function setId(int $id): CalendarType {
			$this->id = $id;
			return $this;
		}

		public function getType(): ?string { return $this->type; }

		public function setType(string $type): CalendarType {
			$this->type = $type;
			return $this;
		}

		public function getFlag(): int { return $this->flag; }

		public function setFlag(int $flag): CalendarType {
			$this->flag = $flag;
			return $this;
		}

		public function getImageUrl(): ?string { return $this->imageUrl; }

		public function setImageUrl(string $imageUrl): CalendarType {
			$this->imageUrl = $imageUrl;
			return $this;
		}

		public function getImageWidth(): int { return $this->imageWidth; }

		public function setImageWidth(int $imageWidth): CalendarType {
			$this->imageWidth = $imageWidth;
			return $this;
		}

		public function getImageHeight(): int { return $this->imageHeight; }

		public function setImageHeight(int $imageHeight): CalendarType {
			$this->imageHeight = $imageHeight;
			return $this;
		}

		public function getAbbr(): ?string { return $this->abbr; }

		public function setAbbr(?string $abbr): CalendarType {
			$this->abbr = $abbr;
			return $this;
		}

		public function getShortName(): ?string { return $this->shortName; }

		public function setShortName(?string $shortName): CalendarType {
			$this->shortName = $shortName;
			return $this;
		}

		public function getLongName(): ?string { return $this->longName; }

		public function setLongName(string $longName): CalendarType {
			$this->longName = $longName;
			return $this;
		}
	}