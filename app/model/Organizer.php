<?php

	namespace ZelPage;

	class Organizer {
		/** @var null|int */
		private $id;
		/** @var null|string */
		private $name;
		/** @var null|string */
		private $brand;
		/** @var null|string */
		private $taxId;
		/** @var null|string */
		private $address;
		/** @var null|string */
		private $description;
		/** @var null|int */
		private $postOfficeBoxNumber;
		/** @var null|string */
		private $streetAddress;
		/** @var null|string */
		private $postalCode;
		/** @var null|string */
		private $addressLocality;
		/** @var null|string */
		private $addressCountry;
		/** @var null|string */
		private $phone;
		/** @var null|string */
		private $fax;
		/** @var null|string */
		private $email;
		/** @var null|string */
		private $www;
		/** @var null|string */
		private $facebook;
		/** @var null|string */
		private $carrierNumber;
		/** @var mixed */
		private $foundingDate;
		/** @var mixed */
		private $dissolutionDate;
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
		public function setId($id) : Organizer { $this->id = $id; return $this; }

		/** @return null|string */
		public function getName() { return $this->name; }
		public function setName(string $name) : Organizer { $this->name = $name; return $this; }

		public function getBrand() { return $this->brand; }
		public function hasBrand() : bool { return empty($this->brand) === FALSE; }
		public function setBrand($brand) : Organizer { $this->brand = $brand; return $this; }

		public function getTaxId() { return $this->taxId; }
		public function hasTaxId() : bool { return empty($this->taxId) === FALSE; }
		public function setTaxId($taxId) : Organizer { $this->taxId = $taxId; return $this; }

		public function getAddress() { return $this->address; }
		public function hasAddress() : bool { return empty($this->address) === FALSE; }
		public function setAddress($address) : Organizer { $this->address = $address; return $this; }

		public function getDescription() { return $this->description; }
		public function hasDescription() : bool { return empty($this->description) === FALSE; }
		public function setDescription($description) : Organizer { $this->description = $description; return $this; }

		public function getPostOfficeBoxNumber() { return $this->postOfficeBoxNumber; }
		public function hasPostOfficeBoxNumber() : bool { return empty($this->postOfficeBoxNumber) === FALSE; }
		public function setPostOfficeBoxNumber($postOfficeBoxNumber) : Organizer { $this->postOfficeBoxNumber = $postOfficeBoxNumber; return $this; }

		public function getStreetAddress() { return $this->streetAddress; }
		public function hasStreetAddress() : bool { return empty($this->streetAddress) === FALSE; }
		public function setStreetAddress($streetAddress) : Organizer { $this->streetAddress = $streetAddress; return $this; }

		public function getPostalCode() { return $this->postalCode; }
		public function hasPostalCode() { return empty($this->postalCode) === FALSE; }
		public function setPostalCode($postalCode) : Organizer { $this->postalCode = $postalCode; return $this; }

		public function getAddressLocality() { return $this->addressLocality; }
		public function hasAddressLocality() : bool { return empty($this->addressLocality) === FALSE; }
		public function setAddressLocality($addressLocality) : Organizer { $this->addressLocality = $addressLocality; return $this; }

		public function getAddressCountry() { return $this->addressCountry; }
		public function hasAddressCountry() : bool { return empty($this->addressCountry) === FALSE; }
		public function setAddressCountry($addressCountry) : Organizer { $this->addressCountry = $addressCountry; return $this; }

		public function getPhone() { return $this->phone; }
		public function hasPhone() : bool { return empty($this->phone) === FALSE; }
		public function setPhone($phone) : Organizer { $this->phone = $phone; return $this; }

		public function getFax() { return $this->fax; }
		public function hasFax() : bool { return empty($this->fax) === FALSE; }
		public function setFax($fax) : Organizer { $this->fax = $fax; return $this; }

		public function getEmail() { return $this->email; }
		public function hasEmail() : bool { return empty($this->email) === FALSE; }
		public function setEmail($email) : Organizer { $this->email = $email; return $this; }

		public function getWww() { return $this->www; }
		public function hasWww() : bool { return empty($this->www) === FALSE; }
		public function setWww($www) : Organizer { $this->www = $www; return $this; }

		public function getFacebook() { return $this->facebook; }
		public function hasFacebook() : bool { return empty($this->facebook) === FALSE; }
		public function setFacebook($facebook) : Organizer { $this->facebook = $facebook; return $this; }

		public function getCarrierNumber() { return $this->carrierNumber; }
		public function hasCarrierNumber() : bool { return empty($this->carrierNumber) === FALSE; }
		public function setCarrierNumber($carrierNumber) : Organizer { $this->carrierNumber = $carrierNumber; return $this; }

		public function getFoundingDate() { return $this->foundingDate; }
		public function hasFoundingDate() : bool { return empty($this->foundingDate) === FALSE; }
		public function setFoundingDate($foundingDate) : Organizer { $this->foundingDate = $foundingDate; return $this; }

		public function getDissolutionDate() { return $this->dissolutionDate; }
		public function hasDissolutionDate() : bool { return empty($this->dissolutionDate) === FALSE; }
		public function setDissolutionDate($dissolutionDate) { $this->dissolutionDate = $dissolutionDate; return $this; }

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
