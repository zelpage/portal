<?php

	namespace ZelPage;

	class GalleryCategory {
		/** @var null|string */
		private $id;

		public function getId(): ?string { return $this->id; }

		public function setId(?string $id ): GalleryCategory {
			$this->id = $id;
			return $this;
		}
	}
