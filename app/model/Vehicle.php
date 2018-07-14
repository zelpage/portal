<?php

	namespace ZelPage;

	class Vehicle {
		/** @var null|int */
		private $id;
		/** @var null|string */
		private $name;
		/** @var array */
		private $type;
		/** @var null|string */
		private $seoUrl;
		/** @var null|string */
		private $linkAtlas;
		/** @var null|string */
		private $linkGallery;
		/** @var bool */
		private $active = FALSE;
		private $modified;
		/** @var null|string */
		private $uicCode;
		/** @var null|int */
		private $uicCountry;
		/** @var string */
		private $cat = 'v';

		public function getId(): ?int { return $this->id; }
		public function setId($id): Vehicle { $this->id = $id; return $this; }

		public function getName(): ?string { return $this->name; }
		public function hasName(): bool { return empty($this->name) === FALSE; }
		public function setName(string $name): Vehicle { $this->name = $name; return $this; }

		public function getType(): ?array { return $this->type; }
		public function hasType(): bool { return empty($this->type) === FALSE; }
		public function setType($type): Vehicle { $this->type = $type; return $this; }

		public function getSeoUrl(): ?string { return $this->seoUrl; }
		public function setSeoUrl(string $seoUrl): Vehicle { $this->seoUrl = $seoUrl; return $this; }

		public function getLinkAtlas(): ?string { return $this->linkAtlas; }
		public function hasLinkAtlas(): bool { return empty($this->linkAtlas) === FALSE; }
		public function setLinkAtlas(string $linkAtlas): Vehicle { $this->linkAtlas = $linkAtlas; return $this; }

		public function getLinkGallery(): ?string { return $this->linkGallery; }
		public function hasLinkGallery(): bool { return empty($this->linkGallery) === FALSE; }
		public function setLinkGallery(string $linkGallery): Vehicle { $this->linkGallery = $linkGallery; return $this; }

		public function isActive(): bool { return $this->active; }
		public function setActive(bool $active): Vehicle { $this->active = $active; return $this; }

		public function getModified() { return $this->modified; }
		public function hasModified(): bool { return empty($this->modified) === FALSE; }
		public function setModified($modified): Vehicle { $this->modified = $modified; return $this; }

		public function getUicCode(): ?string { return $this->uicCode; }
		public function hasUicCode(): bool { return empty($this->uicCode) === FALSE; }
		public function setUicCode(string $uicCode): Vehicle { $this->uicCode = $uicCode; return $this; }

		public function getUicCountry(): ?int { return $this->uicCountry; }
		public function hasUicCountry(): bool { return empty($this->uicCountry) === FALSE; }
		public function setUicCountry($uicCountry): Vehicle { $this->uicCountry = $uicCountry; return $this; }

		public function getCat(): ?string { return $this->cat; }
		public function setCat($cat): Vehicle { $this->cat = $cat; return $this; }
	}
