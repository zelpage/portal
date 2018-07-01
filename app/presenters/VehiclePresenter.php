<?php

	namespace ZelPage;

	use \Nette\Application\UI\Form;

	class VehiclePresenter extends BasePresenter {

		private $vehicle;
		private $vehicleTypes;

		/** @var CalendarService */
		private $calendarService;
		/** @var VehicleFormFactory */
		private $vehicleFormFactory;

		/** @var Vehicle[] */
		private $vehicles = [];

		public function __construct(CalendarService $calendarService, VehicleFormFactory $vehicleFormFactory) {
			$this->calendarService = $calendarService;
			$this->vehicleFormFactory = $vehicleFormFactory;
		}

		protected function startup() {
			parent::startup();

			$this->vehicleTypes = [
				1 => 'parní',
				2 => 'motoráček',
				4 => 'diesel',
				8 => 'elektrický',
				16 => 'parník',
				32 => 'motorová loď',
				1024 => 'metro',
				2048 => 'tramvaj',
				4096 => 'trolejbus',
				8192 => 'autobus',
				16384 => 'přípojný vůz',
			];
		}

		public function actionDefault() {
			$this->vehicles = $this->calendarService->findVehicles();
		}

		public function renderDefault() {
			$this->template->vehicles = $this->vehicles;
		}

		public function actionEdit(int $id) {
			$this->vehicle = $this->calendarService->findVehicleByID($id);

			if (is_null($this->vehicle)) {
				throw new InvalidArgumentException("Cannot find vehicle $id.");
			}
		}

		public function actionDelete(int $id) {
			$this->calendarService->deleteVehicle($id);

			$this->redirect('default');
		}

		protected function createComponentVehicleForm(): Form {
			$editing = is_null($this->vehicle) === FALSE;

			$form = $this->vehicleFormFactory->create(
				function (Vehicle $vehicle) { $this->redirect('default'); },
				$this->vehicleTypes,
				[
					'vehicle_id' => $editing ? $this->vehicle->getId() : NULL,
					'type' => $editing ? $this->vehicle->getType() : NULL,
					'name' => $editing ? $this->vehicle->getName() : NULL,
					'active' => $editing ? $this->vehicle->isActive() : 0,
					'link_atlas' => $editing ? $this->vehicle->getLinkAtlas() : NULL,
					'link_gallery' => $editing ? $this->vehicle->getLinkGallery() : NULL,
					'uic_code' => $editing ? $this->vehicle->getUicCode() : NULL,
					'uic_country' => $editing ? $this->vehicle->getUicCountry() : NULL,
				]
			);
			return $form;
		}

	}
