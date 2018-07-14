<?php

	namespace ZelPage;

	use \Tracy\Debugger;

	class HomepagePresenter extends BasePresenter {

		/** @var NewsService */
		private $newsService;
		/** @var GalleryService */
		private $galleryService;

		/** @var News[] */
		private $news = [];
		/** @var GalleryPicture[] */
		private $pictures = [];

		public function __construct(NewsService $newsService, GalleryService $galleryService) {
			$this->newsService = $newsService;
			$this->galleryService = $galleryService;
		}

		public function actionDefault() {
			$this->news = $this->newsService->findLatestNews();
			$this->pictures = $this->galleryService->getLatestPictures();

			Debugger::barDump($this->news);
			Debugger::barDump($this->pictures);
		}

	}
