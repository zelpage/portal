<?php

	namespace ZelPage;

	use \Nette\SmartObject;
	use \Nette\Database\Context;
	use \Nette\Security\Identity;
	use \Nette\Security\IIdentity;
	use \Nette\Security\Passwords;
	use \Nette\Security\IAuthenticator;
	use \Nette\Security\AuthenticationException;
	use \Tracy\Debugger;

	class AuthenticationService implements IAuthenticator {
		use SmartObject;
		use LegacyAwareObject;

		/** @var UserService */
		private $userService;
		/** @var Context */
		private $db;

		public function __construct(UserService $userService, Context $db) {
			$this->userService = $userService;
			$this->db = $db;
		}

		public function authenticate(array $credentials): IIdentity {
			[$username, $password] = $credentials;

			$user = $this->userService->findUserByUsername($username);
			Debugger::barDump($user);

			if (is_null($user)) {
				throw new AuthenticationException('User does not exist.', self::IDENTITY_NOT_FOUND);
			} else if ($user->isMigratedFromMD5() && !Passwords::verify($password, $user->getPassword())) {
				throw new AuthenticationException('Password is not correct.', self::INVALID_CREDENTIAL);
			} else if (!$user->isMigratedFromMD5() && $user->getPassword() != md5($username)) {
				throw new AuthenticationException('Password is not correct.', self::INVALID_CREDENTIAL);
			} 
			
			if (!$user->isMigratedFromMD5() || !Passwords::needsRehash($user->getPassword())) {
				$this->db->table('users')->where('id', $user->getId())->update([
					'pass' => Passwords::hash($password),
					'is_migrated_from_md5' => TRUE,
				]);
			}

			$user->setPassword(' ** Sensitive Data ** ');

			return new Identity($user->getId(), [], NULL);
		}

	}
