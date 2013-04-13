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
			$article->setAbstract($item->description);
			$article->setDate(new \DateTime($item->pubDate));

			for($i=0; $i<mt_rand(1,5); $i++) {
				$article->addContent(new \Newsfix\Core\Domain\Model\Content('', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod'));
			}

			$articles[] = $article;
		}

		$this->view->assign('articles', $articles);
	}
}
?>
