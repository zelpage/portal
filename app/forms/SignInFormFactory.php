<?php

	namespace ZelPage;

	use \Nette\SmartObject;
	use \Nette\Security\User;
	use \Nette\Utils\ArrayHash;
	use \Nette\Application\UI\Form;
	use \Nette\Security\AuthenticationException;

	class SignInFormFactory extends AnyFormFactory {
		use SmartObject;

		/** @var User */
		private $user;

		public function __construct(User $user) {
			$this->user = $user;
		}

		public function create(callable $onSignedIn): Form {
			$form = $this->createForm();
			$form->addText('username', 'Login')
				->setRequired('Please enter your username.')
				;
			$form->addPassword('password', 'Password')
				->setRequired('Please enter your password.')
				;
			$form->addCheckbox('remember', 'Remember me');
			$form->addSubmit('signin', 'Sign in');
			$form->onSuccess[] = function (Form $form, ArrayHash $values) use ($onSignedIn) {
				try {
					$this->user->setExpiration($values->remember ? '30 days' : '30 minutes');
					$this->user->login($values->username, $values->password);
				} catch (AuthenticationException $e) {
					$form->addError($e->getMessage());
					return;
				}

				$onSignedIn();
			};
			return $form;
		}

	}
