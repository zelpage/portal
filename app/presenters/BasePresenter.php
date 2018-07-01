<?php

	namespace ZelPage;

	use \Nette\Application\UI\Presenter;
	use \Nette\Utils\DateTime;

	abstract class BasePresenter extends Presenter {

		protected function createTemplate() {
			$template = parent::createTemplate();
			$template->today = new DateTime();
			return $template;
		}

	}
