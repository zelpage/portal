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
		private $type = 0;
		/** @var array */
		private $types = [];
		/** @var bool */
		private $active = FALSE;
		/** @var string */
		private $seoUrl = "";
		private $modified;

		public function getId() { return $this->id; }
		public function setId($id) : Event { $this->id = $id; return $this; }

		public function getFromDate() { return $this->fromDate; }
		public function hasFromDate() : bool { return empty($this->fromDate) === FALSE; }
		public function setFromDate($fromDate) : Event { $this->fromDate = $fromDate; return $this; }
		
		public function getTillDate() { return $this->tillDate; }
		public function hasTillDate() : bool { return empty($this->tillDate) === FALSE; }
		public function setTillDate($tillDate) : Event { $this->tillDate = $tillDate; return $this; }
		
		public function getName() { return $this->name; }
		public function setName(string $name) : Event { $this->name = $name; return $this; }

		public function getDescriptionCz() { return $this->descriptionCZ; }
		public function hasDescriptionCz() : bool { return empty($this->descriptionCZ) === FALSE; }
		public function setDescriptionCz(string$descriptionCZ) : Event { $this->descriptionCZ = $descriptionCZ; return $this; }
		
		public function getDescriptionSk() { return $this->descriptionSK; }
		public function hasDescriptionSk() : bool { return empty($this->descriptionSK) === FALSE; }
		public function setDescriptionSk(string$descriptionSK) : Event { $this->descriptionSK = $descriptionSK; return $this; }
		
		public function getDescriptionDe() { return $this->descriptionDE; }
		public function hasDescriptionDe() : bool { return empty($this->descriptionDE) === FALSE; }
		public function setDescriptionDe(string$descriptionDE) : Event { $this->descriptionDE = $descriptionDE; return $this; }
		
		public function getDescriptionEn() { return $this->descriptionEN; }
		public function hasDescriptionEn() : bool { return empty($this->descriptionEN) === FALSE; }
		public function setDescriptionEn(string$descriptionEN) : Event { $this->descriptionEN = $descriptionEN; return $this; }
		
		public function getDescriptionPl() { return $this->descriptionPL; }
		public function hasDescriptionPl() : bool { return empty($this->descriptionPL) === FALSE; }
		public function setDescriptionPl(string$descriptionPL) : Event { $this->descriptionPL = $descriptionPL; return $this; }

		public function getVenue() { return $this->venue; }
		public function hasVenue() : bool { return empty($this->venue) === FALSE; }
		public function setVenue($venue) : Event { $this->venue = $venue; return $this; }
		
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
		public function setSeoUrl($seoUrl) : Event { $this->seoUrl = $seoUrl; return $this; }
		
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


		public function getType() : int { return $this->type; }
		public function setType(int $type) { $this->type = $type; return $this; }

		public function getTypes() { return $this->types; }
		public function setTypes($types) { $this->types = $types; return $this; }

		public function isActive() { return $this->active; }
		public function setActive($active) { $this->active = $active; return $this; }

		public function getSeoUrl() : string { return $this->seoUrl; }
		public function setSeoUrl(string $seoUrl) : Organizer { $this->seoUrl = $seoUrl; return $this; }

		public function getModified() { return $this->modified; }
		public function hasModified() : bool { return empty($this->modified) === FALSE; }
		public function setModified($modified) : Organizer { $this->modified = $modified; return $this; }

	}
