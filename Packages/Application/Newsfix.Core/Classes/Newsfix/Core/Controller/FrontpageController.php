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
		$articles = array();

		$rss = file_get_contents('http://www.dr.dk/nyheder/service/feeds/allenyheder');

		$xml = new \SimpleXMLElement($rss);
		$xml = $xml->channel;

		foreach($xml->item as $item) {
			$article = new \Newsfix\Core\Domain\Model\Article();
			$article->setTitle($item->title);
			$articles[] = $article;
		}

		$this->view->assign('articles', $articles);




	}
}
?>
