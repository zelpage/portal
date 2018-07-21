<?php

	namespace ZelPage;

	class User {
		/** @var null|int */
		private $id;
		/** @var null|string */
		private $login;
		/** @var null|string */
		private $password;
		/** @var bool */
		private $migratedFromMD5 = FALSE;
		/** @var null|string */
		private $name;
		/** @var null|string */
		private $abbr;
		/** @var null|string */
		private $nickname;
		/** @var null|string */
		private $email;

		public function getId(): ?int { return $this->id; }

		public function setId(?int $id): User {
			$this->id = $id;
			return $this;
		}

		public function getLogin(): ?string { return $this->login; }

		public function setLogin(?string $login): User {
			$this->login = $login;
			return $this;
		}

		public function getPassword(): ?string { return $this->password; }

		public function setPassword(string $password): User {
			$this->password = $password;
			return $this;
		}

		public function isMigratedFromMD5(): bool { return $this->migratedFromMD5; }

		public function setMigratedFromMD5(bool $migratedFromMD5): User {
			$this->migratedFromMD5 = $migratedFromMD5;
			return $this;
		}

		public function getName(): ?string { return $this->name; }

		public function setName(?string $name): User {
			$this->name = $name;
			return $this;
		}

		public function getAbbr(): ?string { return $this->abbr; }

		public function setAbbr(?string $abbr): User {
			$this->abbr = $abbr;
			return $this;
		}

		public function getNickname(): ?string { return $this->nickname; }

		public function setNickname(?string $nickname): User {
			$this->nickname = $nickname;
			return $this;
		}

		public function getEmail(): ?string { return $this->email; }

		public function setEmail(?string $email): User {
			$this->email = $email;
			return $this;
		}
	}
