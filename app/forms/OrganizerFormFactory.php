<?php

	namespace ZelPage;

	use \Nette\SmartObject;
	use \Nette\Utils\ArrayHash;

	class OrganizerFormFactory {
		use SmartObject;

		/** @var CalendarService */
		private $service;

		public function __construct(CalendarService $service) {
			$this->service = $service;
		}

		public function create(callable $onOrganizerSaved, array $defaults, array $organizerTypes) : OrganizerForm {
			$form = new OrganizerForm;
			$form->getComponent('typ')->setItems($organizerTypes);
			$form->setDefaults($defaults);
			$form->onSuccess[] = function (OrganizerForm $form, ArrayHash $values) use ($onOrganizerSaved) {
				$organizer = (new Organizer())
				->setName($values->jmeno)
				->setBrand($values->brand)
				->setTaxId($values->taxId)
				->setAddress($values->adr)
				->setDescription($values->description)
				->setPostOfficeBoxNumber($values->postOfficeBoxNumber)
				->setStreetAddress($values->streetAddress)
				->setPostalCode($values->postalCode)
				->setAddressLocality($values->addressLocality)
				->setAddressCountry($values->addressCountry)
				->setPhone($values->telefon)
				->setFax($values->fax)
				->setEmail($values->email)
				->setWww($values->www)
				->setFacebook($values->FB)
				->setCarrierNumber($values->dopravce)
				->setFoundingDate($values->foundingDate)
				->setDissolutionDate($values->dissolutionDate)
				->setTypes($values->typ)
				->setActive($values->active)
				;

				$organizer =
					empty($values->organizer_id) ?
						$this->service->addOrganizer($organizer) :
						$this->service->editOrganizer($organizer->setId($values->organizer_id));

				$onOrganizerSaved($organizer);
			};

			return $form;
		}

	}