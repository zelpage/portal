<?php

	namespace ZelPage;

	use \Nette\Utils\DateTime;
	use \Nette\Application\UI\Form;
	use \Nette\Application\UI\ITemplate;
	use \Nette\Application\UI\Presenter;

	abstract class BasePresenter extends Presenter {

		/** @var SignInFormFactory */
		private $signInFormFactory;

		public function actionSignout() {
			$this->getUser()->logout();
			$this->redirect('default');
		}

		public function injectSignInFormFactory(SignInFormFactory $signInFormFactory) {
			$this->signInFormFactory = $signInFormFactory;
		}

		protected function createTemplate(): ITemplate {
			$template = parent::createTemplate();
			$template->today = new DateTime();
			return $template;
		}

		protected function createComponentSignInForm(string $name): Form {
			return $this->signInFormFactory->create(
				function () {
					$this->redirect('this');
				}
			);
		}

	}
