<?php

	namespace ZelPage;

	class GroupLayer {
		/** @var int */
		private $id;
		/** @var string */
		private $name;
		/** @var int */
		private $level;

		public function getId(): int {
			return $this->id;
		}

		public function setId(int $id): GroupLayer {
			$this->id = $id;
			return $this;
		}

		public function getName(): string {
			return $this->name;
		}

		public function setName(string $name): GroupLayer {
			$this->name = $name;
			return $this;
		}

		public function getLevel(): int {
			return $this->level;
		}

		public function setLevel(int $level): GroupLayer {
			$this->level = $level;
			return $this;
		}
	}
