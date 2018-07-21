<?php

	namespace ZelPage;

	use \Nette\SmartObject;
	use \Nette\Application\UI\Form;

	abstract class AnyFormFactory {
		use SmartObject;

		public function createForm(): Form {
			$form = new Form;
			return $form;
		}
	}
