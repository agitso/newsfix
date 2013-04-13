<?php
namespace Newsfix\Core\Controller;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
abstract class AbstractController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @var \TYPO3\Flow\Resource\ResourceManager
	 * @Flow\Inject
	 */
	protected $resourceManager;

	/**
	 * @var \TYPO3\Flow\Resource\Publishing\ResourcePublisher
	 * @Flow\Inject
	 */
	protected $resourcePublisher;

	/**
	 * @param \TYPO3\Flow\Mvc\View\ViewInterface $view
	 */
	protected function initializeView(\TYPO3\Flow\Mvc\View\ViewInterface $view) {
		parent::initializeView($view);

		$this->view->assignMultiple(array(
			'css'=>$this->generateCss(),
			'js'=>$this->generateConcatenatedJavascript()
		));
	}

	/**
	 * @return string
	 */
	public function generateCss() {
		$css = new \Assetic\Asset\AssetCollection(array(
			new \Assetic\Asset\GlobAsset(FLOW_PATH_PACKAGES . 'Application/Newsfix.Core/Resources/Public/css/*.scss')
		), array(new \Assetic\Filter\Sass\SassFilter()));

		$cache = new \Assetic\Asset\AssetCache($css, new \Assetic\Cache\FilesystemCache(FLOW_PATH_PACKAGES . 'Application/Newsfix.Core/Resources/Public/css/build/cache/'));

		$path = 'Public/css/build/main.' . $cache->getLastModified() . '.css';
		$target = FLOW_PATH_PACKAGES . 'Application/Newsfix.Core/Resources/' . $path;

		if (!file_exists($target)) {
			file_put_contents($target, $cache->dump());
		}

		return 'resource://Newsfix.Core/' . $path;
	}

	/**
	 * @return string
	 */
	public function generateConcatenatedJavascript() {
		$js = new \Assetic\Asset\AssetCollection(array(
			new \Assetic\Asset\FileAsset('resource://Newsfix.Core/Public/js/vendor/jquery-1.9.1.min.js'),
			new \Assetic\Asset\FileAsset('resource://Newsfix.Core/Public/js/vendor/bootstrap.min.js'),
			new \Assetic\Asset\FileAsset('resource://Newsfix.Core/Public/js/vendor/jquery.masonry.min.js'),
			new \Assetic\Asset\FileAsset('resource://Newsfix.Core/Public/js/main.js')
		));

		$cache = new \Assetic\Asset\AssetCache($js, new \Assetic\Cache\FilesystemCache(FLOW_PATH_PACKAGES . 'Application/Newsfix.Core/Resources/Public/js/build/cache/'));

		$path = 'Public/js/build/main.' . $cache->getLastModified() . '.js';
		$target = FLOW_PATH_PACKAGES . 'Application/Newsfix.Core/Resources/' . $path;

		if (!file_exists($target)) {
			file_put_contents($target, $cache->dump());
		}

		return 'resource://Newsfix.Core/' . $path;
	}
}
?>
