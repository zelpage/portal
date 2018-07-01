<?php

	namespace ZelPage;

	use \Nette\Application\UI\Form;
	use \Nette\ComponentModel\IContainer;
	use \Nette\Utils\Html;

	class OrganizerForm extends Form {

		/** @var callable[] */
		public $onOrganizerSaved;

		public function __construct(IContainer $parent = NULL, $name = NULL) {
			parent::__construct($parent, $name);

			$this->addGroup('Údaje o pořadateli');

			$this->addHidden('organizer_id');

			$this->addText('jmeno', 'Název')
				->setRequired('Vyplňte jméno pořadatele.');
			$this->addText('brand', 'Zkratka');
			$this->addText('taxId', 'IČO');
			$this->addTextarea('adr', 'Adresa')
				->setOption('description', Html::el('p')
					->setHtml('např.: Žabotlamí 19, 12345 Zababov II')
				);
			$this->addText('description', 'Dodatek');
			$this->addText('postOfficeBoxNumber', 'P.O.Box');
			$this->addText('streetAddress', 'ulice');
			$this->addText('postalCode', 'PSČ');
			$this->addText('addressLocality', 'obec');
			$this->addText('addressCountry', 'stát');
			$this->addText('telefon', 'telefon')
				->setOption('description', Html::el('p')
					->setHtml('např. 765432109, +49-123-4567890')
				);
			$this->addText('fax', 'fax')
				->setOption('description', Html::el('p')
					->setHtml('např. 765432109, +49-123-4567890')
				);
			$this->addText('email', 'e-mail')
				->setAttribute('placeholder', 'jan.novak@zelpage.cz');
			$this->addText('www', 'www')
				->setAttribute('placeholder', 'http://novak.zelpage.cz');
			$this->addText('FB', 'Facebook')
				->setAttribute('placeholder', 'https://facebook.com/novak');
			$this->addText('dopravce', 'číslo licence dopravce')
				->addRule(Form::MAX_LENGTH, 'Číslo dopravce má max. délku 6 znaků', 6)
				->setRequired(FALSE)
			;
			$this->addText('foundingDate', 'datum registrace')
				->setType('date')
				->setRequired(FALSE);
			$this->addText('dissolutionDate', 'datum rozpuštění')
				->setType('date')
				->setRequired(FALSE);
			$this->addCheckboxList('typ', 'typ pořadatele')
				->getSeparatorPrototype()->setName(NULL);
			$this->addCheckbox('active', 'Aktivní ve výběru');

			$this->addSubmit('ok', 'OK');
		}

	}