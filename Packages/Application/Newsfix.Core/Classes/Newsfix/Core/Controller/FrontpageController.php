<?php
namespace Newsfix\Core\Controller;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class FrontpageController extends AbstractController {

	/**
	 * @var \Newsfix\Core\Domain\Repository\ArticleRepository
	 * @Flow\Inject
	 */
	protected $articleRepository;

	/**
	 * @return string
	 */
	public function indexAction() {
		$this->view->assign('articles', $this->articleRepository->findAll());
	}
}
?>
