<?php

	namespace ZelPage;

	use Tracy\Debugger;

	class HomepagePresenter extends BasePresenter {

		/** @var NewsService */
		private $newsService;

		/** @var News[] */
		private $news = [];

		public function __construct(NewsService $newsService) {
			$this->newsService = $newsService;
		}

		public function actionDefault() {
			$this->news = $this->newsService->findLatestNews();

			Debugger::barDump($this->news);
		}

	}
