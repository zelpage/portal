<?php

	namespace ZelPage;

	use \Nette\Database\Context;
	use \Nette\SmartObject;
	use \Nette\Utils\Strings;

	class CalendarService {
		use SmartObject;

		/** @var Context */
		private $db;

		public function __construct(Context $db) {
			$this->db = $db;
		}

		public function addOrganizer(Organizer $org) {
			$row = $this->db->table('kalendar_spolky')->insert([
				'jmeno' => $org->getName(),
				'brand' => $org->hasBrand() ? $org->getBrand() : NULL,
				'adresa'=> $org->hasAddress() ? $org->getAddress() : NULL,
				'description' => $org->hasDescription() ? $org->getDescription() : NULL,
				'postOfficeBoxNumber' => $org->hasPostOfficeBoxNumber() ? $org->getPostOfficeBoxNumber() : NULL,
				'streetAddress' => $org->hasStreetAddress() ? $org->getStreetAddress() : NULL,
				'postalCode' => $org->hasPostalCode() ? $org->getPostalCode() : NULL,
				'addressLocality' => $org->hasAddressLocality() ? $org->getAddressLocality() : NULL,
				'addressCountry' => $org->hasAddressCountry() ? $org->getAddressCountry() : NULL,
				'telefon' => $org->hasPhone() ? $org->getPhone() : NULL,
				'fax' => $org->hasFax() ? $org->getFax() : NULL,
				'email' => $org->hasEmail() ? $org->getEmail() : NULL,
				'www' => $org->hasWww() ? $org->getWww() : NULL,
				'FB' => $org->hasFacebook() ? $org->getFacebook() : NULL,
				'dopravce' => $org->hasCarrierNumber() ? $org->getCarrierNumber() : NULL,
				'taxId' => $org->hasTaxId() ? $org->getTaxId() : NULL,
				'foundingDate' => $org->hasFoundingDate() ? $org->getFoundingDate() : NULL,
				'dissolutionDate' => $org->hasDissolutionDate() ? $org->getDissolutionDate() : NULL,
				'typ' => self::zipOrganizerTypes($org->getTypes()),
				'seo_url' => Strings::webalize($org->getName()),
				'active' => $org->isActive(),
			]);

			return $org->setId($row->id);
		}

		public function deleteOrganizer(int $id) {
			$this->db->table('kalendar_spolky')->where('id', $id)->delete();
		}

		public function editOrganizer(Organizer $org) : Organizer {
			$this->db->table('kalendar_spolky')->where('id', $org->getId())->update([
				'jmeno' => $org->getName(),
				'brand' => $org->hasBrand() ? $org->getBrand() : NULL,
				'adresa'=> $org->hasAddress() ? $org->getAddress() : NULL,
				'description' => $org->hasDescription() ? $org->getDescription() : NULL,
				'postOfficeBoxNumber' => $org->hasPostOfficeBoxNumber() ? $org->getPostOfficeBoxNumber() : NULL,
				'streetAddress' => $org->hasStreetAddress() ? $org->getStreetAddress() : NULL,
				'postalCode' => $org->hasPostalCode() ? $org->getPostalCode() : NULL,
				'addressLocality' => $org->hasAddressLocality() ? $org->getAddressLocality() : NULL,
				'addressCountry' => $org->hasAddressCountry() ? $org->getAddressCountry() : NULL,
				'telefon' => $org->hasPhone() ? $org->getPhone() : NULL,
				'fax' => $org->hasFax() ? $org->getFax() : NULL,
				'email' => $org->hasEmail() ? $org->getEmail() : NULL,
				'www' => $org->hasWww() ? $org->getWww() : NULL,
				'FB' => $org->hasFacebook() ? $org->getFacebook() : NULL,
				'dopravce' => $org->hasCarrierNumber() ? $org->getCarrierNumber() : NULL,
				'taxId' => $org->hasTaxId() ? $org->getTaxId() : NULL,
				'foundingDate' => $org->hasFoundingDate() ? $org->getFoundingDate() : NULL,
				'dissolutionDate' => $org->hasDissolutionDate() ? $org->getDissolutionDate() : NULL,
				'typ' => self::zipOrganizerTypes($org->getTypes()),
				'seo_url' => Strings::webalize($org->getName()),
				'active' => $org->isActive(),
			]);

			return $org;
		}

		/**
		 * @param int $id
		 * @return null|Organizer
		 */
		public function findOrganizerByID(int $id) {
			$o = $this->db->table('kalendar_spolky')->where('id', $id)->fetch();

			return ($o === FALSE) ? NULL : self::mapToOrganizer($o);
		}

		/**
		 * @return Organizer[]
		 */
		public function findOrganizers() : array {
			$orgs = [];
			foreach ($this->db->table('kalendar_spolky')->order('jmeno') as $o) {
				$org = self::mapToOrganizer($o);
				$orgs[$org->getId()] = $org;
			}
			return $orgs;
		}

		/**
		 * @param int $typeId
		 * @return Organizer[]
		 */
		public function findOrganizersOfType(int $typeId) : array {
			$orgs = [];
			foreach ($this->db->table('kalendar_spolky')->where('typ & ?', $typeId)->order('jmeno') as $o) {
				$org = self::mapToOrganizer($o);
				$orgs[$org->getId()] = $org;
			}
			return $orgs;
		}

		private static function mapToOrganizer($org) : Organizer {
			$o = (new Organizer())
				->setId($org->id)
				->setName($org->jmeno)
				->setType($org->typ)
				->setTypes(self::expandOrganizerTypes($org->typ))
				->setActive($org->active)
				->setSeoUrl($org->seo_url)
				;

			if (empty($org->brand) === FALSE) { $o->setBrand($org->brand); }
			if (empty($org->www) === FALSE) { $o->setWww($org->www); }
			if (empty($org->adresa) === FALSE) { $o->setAddress($org->adresa); }
			if (empty($org->description) === FALSE) { $o->setDescription($org->description); }
			if (empty($org->postOfficeBoxNumber) === FALSE) { $o->setPostOfficeBoxNumber($org->postOfficeBoxNumber); }
			if (empty($org->streetAddress) === FALSE) { $o->setStreetAddress($org->streetAddress); }
			if (empty($org->postalCode) === FALSE) { $o->setPostalCode($org->postalCode); }
			if (empty($org->addressLocality) === FALSE) { $o->setAddressLocality($org->addressLocality); }
			if (empty($org->addressCountry) === FALSE) { $o->setAddressCountry($org->addressCountry); }
			if (empty($org->telefon) === FALSE) { $o->setPhone($org->telefon); }
			if (empty($org->fax) === FALSE) { $o->setFax($org->fax); }
			if (empty($org->email) === FALSE) { $o->setEmail($org->email); }
			if (empty($org->FB) === FALSE) { $o->setFacebook($org->FB); }
			if (empty($org->dopravce) === FALSE) { $o->setCarrierNumber($org->dopravce); }
			if (empty($org->taxId) === FALSE) { $o->setTaxId($org->taxId); }
			if (empty($org->foundingDate) === FALSE) { $o->setFoundingDate($org->foundingDate); }
			if (empty($org->dissolutionDate) === FALSE) { $o->setDissolutionDate($org->dissolutionDate); }
			if (empty($org->adresa) === FALSE) { $o->setAddress($org->adresa); }
			if (empty($org->modified) === FALSE) { $o->setModified($org->modified); }

			return $o;
		}

		private static function expandOrganizerTypes(int $type) : array {
			$types = [];
			foreach ([1, 2, 4, 8, 16, 32] as $i) {
				if ($type & $i) { $types[] = $i; }
			}
			return $types;
		}

		private static function zipOrganizerTypes(array $types) : int {
			$type = 0;
			foreach ($types as $t) { $type |= $t; }
			return $type;
		}

	}