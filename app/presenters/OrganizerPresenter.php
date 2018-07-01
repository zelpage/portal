<?php

	namespace ZelPage;

	use \ZelPage\BasePresenter;
	use \Nette\InvalidArgumentException;

	class OrganizerPresenter extends BasePresenter {

		private $organizerTypes;

		/** @var null|Organizer */
		private $organizer = NULL;
		/** @var Organizer[] */
		private $organizers = [];

		/** @var CalendarService */
		private $calendarService;
		/** @var OrganizerFormFactory */
		private $organizerFormFactory;

		public function __construct(CalendarService $calendarService, OrganizerFormFactory $organizerFormFactory) {
			$this->calendarService = $calendarService;
			$this->organizerFormFactory = $organizerFormFactory;
		}

		protected function startup() {
			parent::startup();

			$this->organizerTypes = [
				1 => 'jízdy',
				2 => 'modelářské akce',
				4 => 'výstavy',
				8 => 'konference',
				16 => 'držitel vozidel',
				32 => 'provozovatel dráhy',
			];
		}

		public function actionDefault(int $id = NULL) {
			if (is_null($id)) {
				$this->organizers = $this->calendarService->findOrganizers();
			} else {
				$this->organizers = $this->calendarService->findOrganizersOfType($id);
			}
		}

		public function renderDefault() {
			$this->template->organizers = $this->organizers;
			$this->template->organizerTypes = $this->organizerTypes;
		}

		public function actionDelete(int $id) {
			$this->calendarService->deleteOrganizer($id);

			$this->redirect('default');
		}

		public function actionEdit(int $id) {
			$this->organizer = $this->calendarService->findOrganizerByID($id);

			if (is_null($this->organizer)) {
				throw new InvalidArgumentException("Cannot find organizer $id.");
			}
		}

		public function createComponentOrganizerForm() {
			$editing = is_null($this->organizer) === FALSE;

			$defaults = [
				'organizer_id' => $editing ? $this->organizer->getId() : NULL,
				'jmeno' => $editing ? $this->organizer->getName() : NULL,
				'brand' => $editing && $this->organizer->hasBrand() ? $this->organizer->getBrand() : NULL,
				'taxId' => $editing && $this->organizer->hasTaxId() ? $this->organizer->getTaxId() : NULL,
				'adr' => $editing && $this->organizer->hasAddress() ? $this->organizer->getAddress() : NULL,
				'description' => $editing && $this->organizer->hasDescription() ? $this->organizer->getDescription() : NULL,
				'postOfficeBoxNumber' => $editing && $this->organizer->hasPostOfficeBoxNumber() ? $this->organizer->getPostOfficeBoxNumber() : NULL,
				'streetAddress' => $editing && $this->organizer->hasStreetAddress() ? $this->organizer->getStreetAddress() : NULL,
				'postalCode' => $editing && $this->organizer->hasPostalCode() ? $this->organizer->getPostalCode() : NULL,
				'addressLocality' => $editing && $this->organizer->hasAddressLocality() ? $this->organizer->getAddressLocality() : NULL,
				'addressCountry' => $editing && $this->organizer->hasAddressCountry() ? $this->organizer->getAddressCountry() : NULL,
				'telefon' => $editing && $this->organizer->hasPhone() ? $this->organizer->getPhone() : NULL,
				'fax' => $editing && $this->organizer->hasFax() ? $this->organizer->getFax() : NULL,
				'email' => $editing && $this->organizer->hasEmail() ? $this->organizer->getEmail() : NULL,
				'www' => $editing && $this->organizer->hasWww() ? $this->organizer->getWww() : NULL,
				'FB' => $editing && $this->organizer->hasFacebook() ? $this->organizer->getFacebook() : NULL,
				'dopravce' => $editing && $this->organizer->hasCarrierNumber() ? $this->organizer->getCarrierNumber() : NULL,
				'foundingDate' => $editing && $this->organizer->hasFoundingDate() ? $this->organizer->getFoundingDate() : NULL,
				'dissolutionDate' => $editing && $this->organizer->hasDissolutionDate() ? $this->organizer->getDissolutionDate() : NULL,
				'typ' => $editing ? $this->organizer->getTypes() : [],
				'active' => $editing ? $this->organizer->isActive() : 0,
			];

			return $this->organizerFormFactory->create(
				function (Organizer $organizer) { $this->redirect('default'); },
				$defaults,
				$this->organizerTypes
			);
		}

	}