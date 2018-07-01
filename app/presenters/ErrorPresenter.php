<?php

	namespace ZelPage;

	use \Nette\SmartObject;
	use \Nette\Application\Request;
	use \Nette\Application\IResponse;
	use \Nette\Application\IPresenter;
	use \Nette\Application\Responses\ForwardResponse;
	use \Nette\Application\Responses\CallbackResponse;
	use \Tracy\ILogger;
	use \Nette\Application\Helpers;
	use \Nette\Application\BadRequestException;

	class ErrorPresenter implements IPresenter {
		use SmartObject;

		/** @var ILogger */
		private $logger;

		public function __construct(ILogger $logger) {
			$this->logger = $logger;
		}

		/**
		* @return Nette\Application\IResponse
		*/
		public function run(Request $request) : Response {
			$e = $request->getParameter('exception');

			if ($e instanceof BadRequestException) {
				// $this->logger->log("HTTP code {$e->getCode()}: {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", 'access');
				list($module, ,$sep) = Helpers::splitName($request->getPresenterName());
				$errorPresenter = $module . $sep . 'Error4xx';
				return new ForwardResponse($request->setPresenterName($errorPresenter));
			}

			$this->logger->log($e, ILogger::EXCEPTION);
			return new CallbackResponse(function () {
				require __DIR__ . '/templates/Error/500.phtml';
			});
		}

	}
