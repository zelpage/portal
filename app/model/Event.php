<?php

	namespace ZelPage;

	class Event {
		/** @var null|int */
		private $id;
		/** @var null|string */
		private $name;
		/** @var null|int */
		private $nature;
		/** @var mixed */
		private $fromDate;
		/** @var mixed */
		private $tillDate;
		/** @var null|string */
		private $descriptionCz;
		/** @var null|string */
		private $descriptionSk;
		/** @var null|string */
		private $descriptionDe;
		/** @var null|string */
		private $descriptionEn;
		/** @var null|string */
		private $descriptionPl;
		/** @var null|string */
		private $venue;
		/** @var int */
		private $region = 0;
		/** @var int */
		private $country = 0;
		/** @var int */
		private $status = 0;
		/** @var array */
		private $statuses = [];
		/** @var int */
		private $eventType = 0;
		/** @var array */
		private $eventTypes = [];
		/** @var bool */
		private $active = FALSE;
		/** @var string */
		private $seoUrl = "";
		private $modified;
        private $author;

		public function getId() { return $this->id; }
		public function setId($id) : Event { $this->id = $id; return $this; }

		public function getFromDate() { return $this->fromDate; }
		public function hasFromDate() : bool { return empty($this->fromDate) === FALSE; }
		public function setFromDate($fromDate) : Event { $this->fromDate = $fromDate; return $this; }
		
		public function getTillDate() { return $this->tillDate; }
		public function hasTillDate() : bool { return empty($this->tillDate) === FALSE; }
		public function setTillDate($tillDate) : Event { $this->tillDate = $tillDate; return $this; }
		
		public function getName() { return $this->name; }
        public function hasName() : bool { return empty($this->name) === FALSE; }
		public function setName(string $name) : Event { $this->name = $name; return $this; }

		public function getDescriptionCz() { return $this->descriptionCz; }
		public function hasDescriptionCz() : bool { return empty($this->descriptionCz) === FALSE; }
		public function setDescriptionCz(string $descriptionCz) : Event { $this->descriptionCz = $descriptionCz; return $this; }
		
		public function getDescriptionSk() { return $this->descriptionSk; }
		public function hasDescriptionSk() : bool { return empty($this->descriptionSk) === FALSE; }
		public function setDescriptionSk(string $descriptionSk) : Event { $this->descriptionSk = $descriptionSk; return $this; }
		
		public function getDescriptionDe() { return $this->descriptionDe; }
		public function hasDescriptionDe() : bool { return empty($this->descriptionDe) === FALSE; }
		public function setDescriptionDe(string $descriptionDe) : Event { $this->descriptionDe = $descriptionDe; return $this; }
		
		public function getDescriptionEn() { return $this->descriptionEn; }
		public function hasDescriptionEn() : bool { return empty($this->descriptionEn) === FALSE; }
		public function setDescriptionEn(string $descriptionEn) : Event { $this->descriptionEn = $descriptionEn; return $this; }
		
		public function getDescriptionPl() { return $this->descriptionPl; }
		public function hasDescriptionPl() : bool { return empty($this->descriptionPl) === FALSE; }
		public function setDescriptionPl(string $descriptionPl) : Event { $this->descriptionPl = $descriptionPl; return $this; }

		public function getVenue() { return $this->venue; }
		public function hasVenue() : bool { return empty($this->venue) === FALSE; }
		public function setVenue(string $venue) : Event { $this->venue = $venue; return $this; }
		
		public function getStatus() { return $this->status; }
		public function hasStatus() : bool { return empty($this->status) === FALSE; }
		public function setStatus($status) : Event { $this->status = $status; return $this; }

		public function getEventType() { return $this->eventType; }
		public function hasEventType() : bool { return empty($this->eventType) === FALSE; }
		public function setEventType($eventType) : Event { $this->eventType = $eventType; return $this; }
		
		public function getRegion() { return $this->region; }
		public function hasRegion() : bool { return empty($this->region) === FALSE; }
		public function setRegion($region) : Event { $this->region = $region; return $this; }
		
		public function getCountry() { return $this->country; }
        public function hasCountry() : bool { return empty($this->country) === FALSE; }
		public function setCountry($country) : Event { $this->country = $country; return $this; }

		public function getSeoUrl() { return $this->seoUrl; }
		public function hasSeoUrl() : bool { return empty($this->seoUrl) === FALSE; }
		public function setSeoUrl(string $seoUrl) : Event { $this->seoUrl = $seoUrl; return $this; }

        public function getActive() { return $this->active; }
        public function hasActive() : bool { return empty($this->active) === FALSE; }
		public function setActive($active) : Event { $this->active = $active; return $this; }

		public function getModified() { return $this->modified; }
        public function hasModified() : bool { return empty($this->modified) === FALSE; }
		public function setModified($modified) : Event { $this->modified = $modified; return $this; }
		
		public function getAuthor() { return $this->author; }
        public function hasAuthor() : bool { return empty($this->author) === FALSE; }
		public function setAuthor($author) : Event { $this->author = $author; return $this; }

		public function getNature() { return $this->nature; }
        public function hasNature() : bool { return empty($this->nature) === FALSE; }
		public function setNature($nature) : Event { $this->nature = $nature; return $this; }

		public function getTypes() { return $this->types; }
        public function hasTypes() : bool { return empty($this->types) === FALSE; }
		public function setTypes($types) { $this->types = $types; return $this; }

	}
