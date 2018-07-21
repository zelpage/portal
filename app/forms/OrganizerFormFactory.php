<?php

	namespace ZelPage;

	use \Nette\Utils\Html;
	use \Nette\SmartObject;
	use \Nette\Utils\ArrayHash;
	use \Nette\Application\UI\Form;

	class OrganizerFormFactory extends AnyFormFactory {
		use SmartObject;

		/** @var CalendarService */
		private $service;

		public function __construct(CalendarService $service) {
			$this->service = $service;
		}

		public function create(callable $onOrganizerSaved, array $defaults, array $organizerTypes): OrganizerForm {
			$form = $this->createForm();
			$form->addGroup('Údaje o pořadateli');

			$form->addHidden('organizer_id');

			$form->addText('jmeno', 'Název')
				->setRequired('Vyplňte jméno pořadatele.');
			$form->addText('brand', 'Zkratka');
			$form->addText('taxId', 'IČO');
			$form->addTextarea('adr', 'Adresa')
				->setOption('description', Html::el('p')
					->setHtml('např.: Žabotlamí 19, 12345 Zababov II')
				);
			$form->addText('description', 'Dodatek');
			$form->addText('postOfficeBoxNumber', 'P.O.Box');
			$form->addText('streetAddress', 'ulice');
			$form->addText('postalCode', 'PSČ');
			$form->addText('addressLocality', 'obec');
			$form->addText('addressCountry', 'stát');
			$form->addText('telefon', 'telefon')
				->setOption('description', Html::el('p')
					->setHtml('např. 765432109, +49-123-4567890')
				);
			$form->addText('fax', 'fax')
				->setOption('description', Html::el('p')
					->setHtml('např. 765432109, +49-123-4567890')
				);
			$form->addText('email', 'e-mail')
				->setAttribute('placeholder', 'jan.novak@zelpage.cz');
			$form->addText('www', 'www')
				->setAttribute('placeholder', 'http://novak.zelpage.cz');
			$form->addText('FB', 'Facebook')
				->setAttribute('placeholder', 'https://facebook.com/novak');
			$form->addText('dopravce', 'číslo licence dopravce')
				->addRule(Form::MAX_LENGTH, 'Číslo dopravce má max. délku 6 znaků', 6)
				->setRequired(FALSE)
				;
			$form->addText('foundingDate', 'datum registrace')
				->setType('date')
				->setRequired(FALSE);
			$form->addText('dissolutionDate', 'datum rozpuštění')
				->setType('date')
				->setRequired(FALSE);
			$form->addCheckboxList('typ', 'typ pořadatele', $organizerTypes)
				->getSeparatorPrototype()->setName(NULL);
			$form->addCheckbox('active', 'Aktivní ve výběru');

			$form->addSubmit('ok', 'OK');
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
