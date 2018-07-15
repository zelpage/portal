<?php

	namespace ZelPage;

	class Ride {
		/** @var null|int */
		private $id;
		/** @var null|string */
		private $name;
		/** @var null|int */
		private $idCd;
		/** @var mixed */
		private $fromDate;
		/** @var mixed */
		private $tillDate;
		/** @var null|string */
		private $coaches;
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
		private $route;
		/** @var int */
		//private $region = 0;
		/** @var int */
		//private $country = 0;
		/** @var int */
		private $status = 0;
		/** @var array */
		private $statuses = [];
		/** @var int */
		private $traction = 0;
		/** @var array */
		private $tractions = [];
		/** @var int */
		private $eventType = 0;
		/** @var array */
		private $eventTypes = [];
		/** @var int */
		private $fareType = 0;
		/** @var array */
		private $fareTypes = [];
		/** @var bool */
		private $active = FALSE;
		/** @var string */
		private $seoUrl = "";
		private $modified;
        private $author;

		public function getId() { return $this->id; }
		public function setId($id) : Ride { $this->id = $id; return $this; }

        public function getIdCd() { return $this->idCd; }
        public function hasIdCd() : bool { return empty($this->idCd) === FALSE; }
        public function setIdCd($idCd) : Ride { $this->idCd = $idCd; return $this; }

        public function getFromDate() { return $this->fromDate; }
        public function hasFromDate() : bool { return empty($this->fromDate) === FALSE; }
        public function setFromDate($fromDate) : Ride { $this->fromDate = $fromDate; return $this; }

        public function getTillDate() { return $this->tillDate; }
        public function hasTillDate() : bool { return empty($this->tillDate) === FALSE; }
        public function setTillDate($tillDate) : Ride { $this->tillDate = $tillDate; return $this; }

        public function getName() { return $this->name; }
        public function hasName() : bool { return empty($this->name) === FALSE; }
        public function setName($name) : Ride { $this->name = $name; return $this; }

        public function getCoaches() { return $this->coaches; }
        public function hasCoaches() : bool { return empty($this->coaches) === FALSE; }
        public function setCoaches($coaches) : Ride { $this->coaches = $coaches; return $this; }

        public function getDescriptionCz() { return $this->descriptionCz; }
        public function hasDescriptionCz() : bool { return empty($this->descriptionCz) === FALSE; }
        public function setDescriptionCz($descriptionCz) : Ride { $this->descriptionCz = $descriptionCz; return $this; }

        public function getDescriptionSk() { return $this->descriptionSk; }
        public function hasDescriptionSk() : bool { return empty($this->descriptionSk) === FALSE; }
        public function setDescriptionSk($descriptionSk) : Ride { $this->descriptionSk = $descriptionSk; return $this; }

        public function getDescriptionDe() { return $this->descriptionDe; }
        public function hasDescriptionDe() : bool { return empty($this->descriptionDe) === FALSE; }
        public function setDescriptionDe($descriptionDe) : Ride { $this->descriptionDe = $descriptionDe; return $this; }

        public function getDescriptionEn() { return $this->descriptionEn; }
        public function hasDescriptionEn() : bool { return empty($this->descriptionEn) === FALSE; }
        public function setDescriptionEn($descriptionEn) : Ride { $this->descriptionEn = $descriptionEn; return $this; }

        public function getDescriptionPl() { return $this->descriptionPl; }
        public function hasDescriptionPl() : bool { return empty($this->descriptionPl) === FALSE; }
        public function setDescriptionPl($descriptionPl) : Ride { $this->descriptionPl = $descriptionPl; return $this; }

        public function getRoute() { return $this->route; }
        public function hasRoute() : bool { return empty($this->route) === FALSE; }
        public function setRoute($route) : Ride { $this->route = $route; return $this; }

        public function getStatus() { return $this->status; }
        public function hasStatus() : bool { return empty($this->status) === FALSE; }
        public function setStatus($status) : Ride { $this->status = $status; return $this; }

        public function getTraction() { return $this->traction; }
        public function hasTraction() : bool { return empty($this->traction) === FALSE; }
        public function setTraction($traction) : Ride { $this->traction = $traction; return $this; }

        public function getEventType() { return $this->eventType; }
        public function hasEventType() : bool { return empty($this->eventType) === FALSE; }
        public function setEventType($eventType) : Ride { $this->eventType = $eventType; return $this; }

        public function getFareType() { return $this->fareType; }
        public function hasFareType() : bool { return empty($this->fareType) === FALSE; }
        public function setFareType($fareType) : Ride { $this->fareType = $fareType; return $this; }

        public function getSeoUrl() { return $this->seoUrl; }
        public function hasSeoUrl() : bool { return empty($this->seoUrl) === FALSE; }
        public function setSeoUrl($seoUrl) : Ride { $this->seoUrl = $seoUrl; return $this; }

        public function getActive() { return $this->active; }
        public function hasActive() : bool { return empty($this->active) === FALSE; }
        public function setActive($active) : Ride { $this->active = $active; return $this; }

        public function getModified() { return $this->modified; }
        public function hasModified() : bool { return empty($this->modified) === FALSE; }
        public function setModified($modified) : Ride { $this->modified = $modified; return $this; }

        public function getAuthor() { return $this->author; }
        public function hasAuthor() : bool { return empty($this->author) === FALSE; }
        public function setAuthor($author) : Ride { $this->author = $author; return $this; }

	}
