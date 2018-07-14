<?php

	namespace ZelPage;

	use \Nette\Database\Context;
	use \Nette\SmartObject;
	use \Nette\Utils\Strings;

	class CalendarService {
		use SmartObject;
		use LegacyAwareObject;

		/** @var Context */
		private $db;

		public function __construct(Context $db) {
			$this->db = $db;
		}

		public function addOrganizer(Organizer $org): Organizer {
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
				'typ' => self::zipTypes($org->getTypes()),
				'seo_url' => Strings::webalize($org->getName()),
				'active' => $org->isActive(),
			]);

			return $org->setId($row->id);
		}

		public function addVehicle(Vehicle $v): Vehicle {
			$row = $this->db->table('kalendar_vozidla')->insert([
				'typ' => self::zipTypes($v->getType()),
				'jmeno' => $v->getName(),
				'link_atlas' => $v->getLinkAtlas(),
				'link_galerie' => $v->getLinkGallery(),
				'active' => $v->isActive(),
				'uiccode' => $v->getUicCode(),
				'zeme' => $v->getUicCountry(),
			]);

			return $v->setId($row->id);
		}

		public function deleteOrganizer(int $id) {
			$this->db->table('kalendar_spolky')->where('id', $id)->delete();
		}

		public function deleteVehicle(int $id) {
			$this->db->table('kalendar_vozidla')->where('id', $id)->delete();
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
				'typ' => self::zipTypes($org->getTypes()),
				'seo_url' => Strings::webalize($org->getName()),
				'active' => $org->isActive(),
			]);

			return $org;
		}

		public function editVehicle(Vehicle $v): Vehicle {
			$this->db->table('kalendar_spolky')->where('id', $v->getId())->update([
				'typ' => self::zipTypes($v->getType()),
				'jmeno' => $v->hasName() ? $v->getName() : NULL,
				'seo_url' => $v->hasName() ? Strings::webalize($v->getName()) : NULL,
				'link_atlas' => $v->hasLinkAtlas() ? $v->getLinkAtlas() : NULL,
				'link_galerie' => $v->hasLinkGallery() ? $v->getLinkGallery() : NULL,
				'active' => $v->isActive(),
				'uiccode' => $v->hasUicCode() ? $v->getUicCode() : NULL,
				'zeme' => $v->hasUicCountry() ? $v->getUicCountry() : NULL,
			]);

			return $v;
		}

		/** @return Country[] */
		public function findCountries(): array {
			$countries = [];
			foreach ($this->db->table('reg_zeme')->order('id') as $row) {
				$c = self::mapToCountry($row);
				$countries[$c->getId()] = $c;
			}
			return $countries;
		}

		/**
		 * @param int $id
		 * @return null|Organizer
		 */
		public function findOrganizerByID(int $id) {
			$o = $this->db->table('kalendar_spolky')->where('id', $id)->fetch();

			return ($o === FALSE) ? NULL : self::mapToOrganizer($o);
		}

		public function findVehicleByID(int $id): ?Vehicle {
			$v = $this->db->table('kalendar_vozidla')->where('id', $id)->fetch();

			return ($v === FALSE) ? NULL : self::mapToVehicle($v);
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

		/** @return Vehicle[] */
		public function findVehicles(): array {
			$vehicles = [];
			foreach ($this->db->table('kalendar_vozidla')->order('jmeno') as $v) {
				$vehicle = self::mapToVehicle($v);
				$vehicles[$vehicle->getId()] = $vehicle;
			}
			return $vehicles;
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

		/** @return CalendarType[] */
		public function findTypesOfConference(): array { return $this->findTypes('konf'); }

		/** @return CalendarType[] */
		public function findTypesOfFare(): array { return $this->findTypes('jizdne'); }

		/** @return CalendarType[] */
		public function findTypesOfRailEvent(): array { return $this->findTypes('zelakce'); }

		/** @return CalendarType[] */
		public function findTypesOfScaleKitExhibition(): array { return $this->findTypes('modvys'); }

		/** @return CalendarType[] */
		public function findTypesOfScaleKitSubject(): array { return $this->findTypes('modsubj'); }

		/** @return CalendarType[] */
		public function findTypesOfStatus(): array { return $this->findTypes('status'); }

		/** @return CalendarType[] */
		public function findTypesOfTraction(): array { return $this->findTypes('trakce'); }

		/**
		 * @param string $type
		 * @return CalendarType[]
		 */
		private function findTypes(string $type): array {
			$types = [];
			foreach ($this->db->table('kalendar_typy')->where('typ = ?', $type)->order('typ_id') as $row) {
				$t = self::mapToType($row);
				$types[] = $t;
			}
			return $types;
		}

		private static function mapToCountry($row): Country {
			$c = (new Country())
				->setId($row->id)
				->setName($row->jmeno)
				;

			if (empty($row->seo_url) === FALSE) { $c->setSeoHandle($row->seo_url); }
			if (empty($row->zkratka) === FALSE) { $c->setAbbr($row->zkratka); }
			if (empty($row->uiccode) === FALSE) { $c->setUicCode($row->uiccode); }
			if (empty($row->en_name) === FALSE) { $c->setNameEn($row->en_name); }
			if (empty($row->de_name) === FALSE) { $c->setNameDe($row->de_name); }
			if (empty($row->fr_name) === FALSE) { $c->setNameFr($row->fr_name); }
			if (empty($row->orig_name) === FALSE) { $c->setNameOrig($row->orig_name); }
			if (empty($row->part) === FALSE) { $c->setContinent($row->part); }

			return $c;
		}

		private static function mapToOrganizer($org) : Organizer {
			$o = (new Organizer())
				->setId($org->id)
				->setName($org->jmeno)
				->setType($org->typ)
				->setTypes(self::expandTypes($org->typ))
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

		private static function mapToType($row): CalendarType {
			$t = (new CalendarType())
				->setId($row->id)
				->setFlag($row->typ_id)
				;

			if (empty($row->typ) === FALSE) { $t->setType($row->typ); }
			if (empty($row->obrazek) === FALSE) { $t->setImageUrl($row->obrazek); }
			if (empty($row->obr_w) === FALSE) { $t->setImageWidth($row->obr_w); }
			if (empty($row->obr_h) === FALSE) { $t->setImageHeight($row->obr_h); }
			if (empty($row->p_lang) === FALSE) { $t->setAbbr($row->p_lang); }
			if (empty($row->p_short) === FALSE) { $t->setShortName($row->p_short); }
			if (empty($row->p_long) === FALSE) { $t->setLongName($row->p_long); }

			return $t;
		}

		private static function mapToVehicle($row): Vehicle {
			$v = (new Vehicle())
				->setId($row->id)
				;

			if (empty($row->jmeno) === FALSE) { $v->setName($row->jmeno); }
			if (empty($row->typ) === FALSE) { $v->setType(self::expandTypes($row->typ)); }
			if (empty($row->seo_url) === FALSE) { $v->setSeoUrl($row->seo_url); }
			if (empty($row->link_atlas) === FALSE) { $v->setLinkAtlas($row->link_atlas); }
			if (empty($row->link_galerie) === FALSE) { $v->setLinkGallery($row->link_galerie); }
			if (empty($row->active) === FALSE) { $v->setActive(boolval($row->active)); }
			if (empty($row->modified) === FALSE) { $v->setModified($row->modified); }
			if (empty($row->uiccode) === FALSE) { $v->setUicCode($row->uiccode); }
			if (empty($row->zeme) === FALSE) { $v->setUicCountry(intval($row->zeme)); }
			if (empty($row->cat) === FALSE) { $v->setCat($row->cat); }

			return $v;
		}

	}
