<?php

	namespace ZelPage;

	use \Tracy\Debugger;

	class HomepagePresenter extends BasePresenter {

		/** @var UserService */
		private $userService;
		/** @var NewsService */
		private $newsService;
		/** @var GalleryService */
		private $galleryService;

		/** @var News[] */
		private $news = [];
		/** @var GalleryPicture[] */
		private $pictures = [];

		public function __construct(
			UserService $userService,
			NewsService $newsService,
			GalleryService $galleryService
		) {
			parent::__construct();

			$this->userService = $userService;
			$this->newsService = $newsService;
			$this->galleryService = $galleryService;
		}

		public function actionDefault() {
			$this->news = $this->newsService->findLatestNews();
			$this->pictures = $this->galleryService->getLatestPictures();

			Debugger::barDump($this->news);
			Debugger::barDump($this->pictures);
			Debugger::barDump($this->userService->findGroups());
		}

	}
