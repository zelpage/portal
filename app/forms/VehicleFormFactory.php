<?php

	namespace ZelPage;

	use \Nette\SmartObject;
	use \Nette\Utils\ArrayHash;
	use \Nette\Application\UI\Form;

	class VehicleFormFactory {
		use SmartObject;

		/** @var CalendarService */
		private $calendarService;

		public function __construct(CalendarService $calendarService) {
			$this->calendarService = $calendarService;
		}

		public function create(callable $onVehicleSaved, array $vehicleTypes, array $defaults): Form {
			$form = new Form;

			$form->addGroup('Údaje o vozidle');
			$form->addHidden('vehicle_id');
			$form->addText('name', 'Jméno');
			$form
				->addCheckboxList('type', 'typ vozidla', $vehicleTypes)
				->setRequired(TRUE)
				->getSeparatorPrototype()->setName(NULL);
			$form
				->addCheckbox('active', 'Aktivní ve výběru');
			$form->addText('link_atlas', 'odkaz na Atlaslokomotiv.cz');
			$form->addText('link_gallery', 'odkaz na galerii');
			$form->addText('uic_code', 'UIC kód');
			$form
				->addText('uic_country', 'UIC země')
				->setType('number');
			$form->setDefaults($defaults);
			$form->onSuccess[] = function (Form $form, ArrayHash $values) use ($onVehicleSaved) {
				$v = (new Vehicle())
					->setId($values->vehicle_id)
					->setType($values->type)
					->setName($values->name)
					->setActive($values->active)
					->setLinkAtlas($values->link_atlas)
					->setLinkGallery($values->link_gallery)
					->setUicCode($values->uic_code)
					->setUicCountry($values->uic_country)
					;

				$vehicle = (empty($values->vehicle_id)) ?
					$this->calendarService->addVehicle($v) :
					$this->calendarService->editVehicle($v);

				$onVehicleSaved($vehicle);
			};
			$form->addSubmit('ok', 'OK');
			return $form;
		}
		
	}
