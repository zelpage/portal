<?php

	namespace ZelPage;

	class Group {
		/** @var null|int */
		private $id;
		/** @var string */
		private $name;
		/** @var string */
		private $description;
		/** @var null|int */
		private $forumId;
		/** @var null\string */
		private $slack;
		/** @var GroupLayer[] */
		private $layers = [];

		public function getId(): ?int {
			return $this->id;
		}

		public function setId(int $id): Group {
			$this->id = $id;
			return $this;
		}

		public function getName(): string {
			return $this->name;
		}

		public function setName(string $name): Group {
			$this->name = $name;
			return $this;
		}

		public function getDescription(): string {
			return $this->description;
		}

		public function setDescription(string $description): Group {
			$this->description = $description;
			return $this;
		}

		public function getForumId(): ?int {
			return $this->forumId;
		}

		public function setForumId(?int $forumId): Group {
			$this->forumId = $forumId;
			return $this;
		}

		public function getSlack(): ?string {
			return $this->slack;
		}

		public function setSlack(?string $slack): Group {
			$this->slack = $slack;
			return $this;
		}

		public function addLayer(GroupLayer $groupLayer): Group {
			$this->layers[$groupLayer->getLevel()] = $groupLayer;
			return $this;
		}

		/**
		 * @return GroupLayer[]
		 */
		public function getLayers(): array {
			return $this->layers;
		}
	}
