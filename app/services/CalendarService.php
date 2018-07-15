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

        public function addEvent(Event $event): Event {
            $row = $this->db->table('kalendar_jizdy')->insert([
                'name' => $event->getName(),
                'nature' => $event->hasNature() ? $event->getNature() : NULL,
                'fromDate' => $event->hasFromDate() ? $event->getFromDate() : NULL,
                'tillDate' => $event->hasTillDate() ? $event->getTillDate() : NULL,
                'descriptionCz' => $event->hasDescriptionCz() ? $event->getDescriptionCz() : NULL,
                'descriptionSk' => $event->hasDescriptionSk() ? $event->getDescriptionSk() : NULL,
                'descriptionDe' => $event->hasDescriptionDe() ? $event->getDescriptionDe() : NULL,
                'descriptionEn' => $event->hasDescriptionEn() ? $event->getDescriptionEn() : NULL,
                'descriptionPl' => $event->hasDescriptionPl() ? $event->getDescriptionPl() : NULL,
                'venue' => $event->hasVenue() ? $event->getVenue() : NULL,
                'status' => $event->hasStatus() ? $event->getStatus() : NULL,
                'eventType' => $event->haseventType() ? $event->geteventType() : NULL,
                'region' => $event->hasRegion() ? $event->getRegion() : NULL,
                'country' => $event->hasCountry() ? $event->getCountry() : NULL,
                'seoUrl' => $event->hasSeoUrl() ? $event->getSeoUrl() : NULL,
                'active' => $event->hasActive() ? $event->getActive() : NULL,
                'author' => $event->hasAuthor() ? $event->getAuthor() : NULL,
            ]);

            return $event->setId($row->id);
        }

        public function addRide(Ride $ride): Ride {
            $row = $this->db->table('kalendar_modely')->insert([
                'name' => $ride->getName(),
                'idCd' => $ride->hasIdCd() ? $ride->getIdCd() : NULL,
                'fromDate' => $ride->hasFromDate() ? $ride->getFromDate() : NULL,
                'tillDate' => $ride->hasTillDate() ? $ride->getTillDate() : NULL,
                'name' => $ride->hasName() ? $ride->getName() : NULL,
                'coaches' => $ride->hasCoaches() ? $ride->getCoaches() : NULL,
                'descriptionCz' => $ride->hasDescriptionCz() ? $ride->getDescriptionCz() : NULL,
                'descriptionSk' => $ride->hasDescriptionSk() ? $ride->getDescriptionSk() : NULL,
                'descriptionDe' => $ride->hasDescriptionDe() ? $ride->getDescriptionDe() : NULL,
                'descriptionEn' => $ride->hasDescriptionEn() ? $ride->getDescriptionEn() : NULL,
                'descriptionPl' => $ride->hasDescriptionPl() ? $ride->getDescriptionPl() : NULL,
                'route' => $ride->hasRoute() ? $ride->getRoute() : NULL,
                'status' => $ride->hasStatus() ? $ride->getStatus() : NULL,
                'traction' => $ride->hasTraction() ? $ride->getTraction() : NULL,
                'eventType' => $ride->haseventType() ? $ride->geteventType() : NULL,
                'fareType' => $ride->hasFareType() ? $ride->getFareType() : NULL,
                'seoUrl' => $ride->hasSeoUrl() ? $ride->getSeoUrl() : NULL,
                'active' => $ride->hasActive() ? $ride->getActive() : NULL,
                'author' => $ride->hasAuthor() ? $ride->getAuthor() : NULL,
            ]);

            return $ride->setId($row->id);
        }

		public function deleteOrganizer(int $id) {
			$this->db->table('kalendar_spolky')->where('id', $id)->delete();
		}

		public function deleteVehicle(int $id) {
			$this->db->table('kalendar_vozidla')->where('id', $id)->delete();
		}

        public function deleteEvent(int $id) {
            $this->db->table('kalendar_jizdy')->where('id', $id)->delete();
        }

        public function deleteRide(int $id) {
            $this->db->table('kalendar_modely')->where('id', $id)->delete();
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

        public function editEvent(Event $e): Event {
            //seo_url - zakodovat i datum od a id
            $this->db->table('kalendar_jizdy')->where('id', $e->getId())->update([
                'jmeno' => $e->hasName() ? $e->getName() : NULL,
                'od' => $e->hasFromDate() ? $e->getFromDate() : NULL,
                'do' => $e->hasTillDate() ? $e->getTillDate() : NULL,
                'p_cz' => $e->hasDescriptionCz() ? $e->getDescriptionCz() : NULL,
                'p_sk' => $e->hasDescriptionSk() ? $e->getDescriptionSk() : NULL,
                'p_de' => $e->hasDescriptionDe() ? $e->getDescriptionDe() : NULL,
                'p_en' => $e->hasDescriptionEn() ? $e->getDescriptionEn() : NULL,
                'p_pl' => $e->hasDescriptionPl() ? $e->getDescriptionPl() : NULL,
                'misto' => $e->hasVenue() ? $e->getVenue() : NULL,
                'status' => $e->hasStatus() ? $e->getStatus() : NULL,
                'typ' => $e->haseventType() ? $e->geteventType() : NULL,
                'regk' => $e->hasRegion() ? $e->getRegion() : NULL,
                'regz' => $e->hasCountry() ? $e->getCountry() : NULL,
                'seo_url' => $e->hasName() ? Strings::webalize($e->getName()) : NULL,
                'zobraz' => $e->hasActive() ? $e->getActive() : NULL,
                'modif' => $e->hasModified() ? $e->getModified() : NULL,
                'signer' => $e->hasAuthor() ? $e->getAuthor() : NULL,
                'druh' => $e->hasNature() ? $e->getNature() : NULL,
            ]);

            return $e;
        }

        public function editRide(Ride $r): Ride {
		    //seo_url - zakodovat i datum od a id
            $this->db->table('kalendar_modely')->where('id', $r->getId())->update([
                'jmeno' => $r->hasName() ? $r->getName() : NULL,
                'od' => $r->hasFromDate() ? $r->getFromDate() : NULL,
                'do' => $r->hasTillDate() ? $r->getTillDate() : NULL,
                'nostalgieCD' => $r->hasIdCd() ? $r->getIdCd() : NULL,
                'vozy' => $r->hasCoaches() ? $r->getCoaches() : NULL,
                'p_cz' => $r->hasDescriptionCz() ? $r->getDescriptionCz() : NULL,
                'p_sk' => $r->hasDescriptionSk() ? $r->getDescriptionSk() : NULL,
                'p_de' => $r->hasDescriptionDe() ? $r->getDescriptionDe() : NULL,
                'p_en' => $r->hasDescriptionEn() ? $r->getDescriptionEn() : NULL,
                'p_pl' => $r->hasDescriptionPl() ? $r->getDescriptionPl() : NULL,
                'trasa' => $r->hasRoute() ? $r->getRoute() : NULL,
                'status' => $r->hasStatus() ? $r->getStatus() : NULL,
                'trakce' => $r->hasTraction() ? $r->getTraction() : NULL,
                'typ' => $r->haseventType() ? $r->geteventType() : NULL,
                'jizdne' => $r->hasFareType() ? $r->getFareType() : NULL,
                'seo_url' => $r->hasName() ? Strings::webalize($r->getName()) : NULL,
                'zobraz' => $r->hasActive() ? $r->getActive() : NULL,
                'modif' => $r->hasModified() ? $r->getModified() : NULL,
                'signer' => $r->hasAuthor() ? $r->getAuthor() : NULL,
            ]);

            return $r;
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

        public function findEventByID(int $id) {
            $e = $this->db->table('kalendar_modely')->where('id', $id)->fetch();

            return ($e === FALSE) ? NULL : self::mapToEvent($e);
        }

        public function findRideByID(int $id) {
            $r = $this->db->table('kalendar_jizdy')->where('id', $id)->fetch();

            return ($r === FALSE) ? NULL : self::mapToRide($r);
        }

		/**
		 * @return Organizer[]
		 */
		public function findOrganizers() : array {
			$orgs = [];
			foreach ($this->db->table('kalendar_spolky')->order('jmeno') as $o) {
				$org = self::mapToOrganizer($o);
				$orgs[$org->getId()] = $org;<<
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

        /** @return Event[] */
        public function findEvents(): array {
            $events = [];
            foreach ($this->db->table('kalendar_modely')->order('jmeno') as $e) {
                $event = self::mapToEvent($e);
                $events[$event->getId()] = $event;
            }
            return $events;
        }

        /** @return Vehicle[] */
        public function findRides(): array {
            $rides = [];
            foreach ($this->db->table('kalendar_jizdy')->order('jmeno') as $r) {
                $ride = self::mapToRide($r);
                $rides[$ride->getId()] = $ride;
            }
            return $rides;
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

        private static function mapToEvent($row): Event {
            $e = (new Event())
                ->setId($row->id)
                ;

            if (empty($row->jmeno) === FALSE) { $e->setName($row->jmeno); }
            if (empty($row->od) === FALSE) { $e->setFromDate($row->od); }
            if (empty($row->do) === FALSE) { $e->setTillDate($row->do); }
            if (empty($row->p_cz) === FALSE) { $e->setDescriptionCz($row->p_cz); }
            if (empty($row->p_sk) === FALSE) { $e->setDescriptionSk($row->p_sk); }
            if (empty($row->p_de) === FALSE) { $e->setDescriptionDe($row->p_de); }
            if (empty($row->p_en) === FALSE) { $e->setDescriptionEn($row->p_en); }
            if (empty($row->p_pl) === FALSE) { $e->setDescriptionPl($row->p_pl); }
            if (empty($row->misto) === FALSE) { $e->setVenue($row->misto); }
            if (empty($row->status) === FALSE) { $e->setStatus($row->status); }
            if (empty($row->typ) === FALSE) { $e->seteventType($row->typ); }
            if (empty($row->regk) === FALSE) { $e->setRegion($row->regk); }
            if (empty($row->regz) === FALSE) { $e->setCountry($row->regz); }
            if (empty($row->seo_url) === FALSE) { $e->setSeoUrl($row->seo_url); }
            if (empty($row->zobraz) === FALSE) { $e->setActive($row->zobraz); }
            if (empty($row->modif) === FALSE) { $e->setModified($row->modif); }
            if (empty($row->signer) === FALSE) { $e->setAuthor($row->signer); }
            if (empty($row->druh) === FALSE) { $e->setNature($row->druh); }

            return $e;
        }

        private static function mapToRide($row): Ride {
            $r = (new Ride())
                ->setId($row->id)
                ;

            if (empty($row->jmeno) === FALSE) { $r->setName($row->jmeno); }
            if (empty($row->id) === FALSE) { $r->setId($row->id); }
            if (empty($row->nostalgieCD) === FALSE) { $r->setIdCd($row->nostalgieCD); }
            if (empty($row->od) === FALSE) { $r->setFromDate($row->od); }
            if (empty($row->do) === FALSE) { $r->setTillDate($row->do); }
            if (empty($row->jmeno) === FALSE) { $r->setName($row->jmeno); }
            if (empty($row->vozy) === FALSE) { $r->setCoaches($row->vozy); }
            if (empty($row->p_cz) === FALSE) { $r->setDescriptionCz($row->p_cz); }
            if (empty($row->p_sk) === FALSE) { $r->setDescriptionSk($row->p_sk); }
            if (empty($row->p_de) === FALSE) { $r->setDescriptionDe($row->p_de); }
            if (empty($row->p_en) === FALSE) { $r->setDescriptionEn($row->p_en); }
            if (empty($row->p_pl) === FALSE) { $r->setDescriptionPl($row->p_pl); }
            if (empty($row->trasa) === FALSE) { $r->setRoute($row->trasa); }
            if (empty($row->status) === FALSE) { $r->setStatus($row->status); }
            if (empty($row->trakce) === FALSE) { $r->setTraction($row->trakce); }
            if (empty($row->typ) === FALSE) { $r->seteventType($row->typ); }
            if (empty($row->jizdne) === FALSE) { $r->setFareType($row->jizdne); }
            if (empty($row->seo_url) === FALSE) { $r->setSeoUrl($row->seo_url); }
            if (empty($row->zobraz) === FALSE) { $r->setActive($row->zobraz); }
            if (empty($row->modif) === FALSE) { $r->setModified($row->modif); }
            if (empty($row->signer) === FALSE) { $r->setAuthor($row->signer); }

            return $r;
        }

	}
