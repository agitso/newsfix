<?php

namespace Newsfix\Core\Domain\Model;

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Content {

	/**
	 * @var \Newsfix\Core\Domain\Model\Article
	 * @ORM\ManyToOne(inversedBy="posts")
	 */
	protected $article;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var int
	 */
	protected $ordering;

	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $content;

	/**
	 * @param string $title
	 * @param string $content
	 */
	public function __construct($title, $content) {
		$this->title = $title;
		$this->content = $content;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param \Newsfix\Core\Domain\Model\Article $article
	 */
	public function setArticle($article) {
		$this->article = $article;
	}

	/**
	 * @param int $ordering
	 */
	public function setOrdering($ordering) {
		$this->ordering = $ordering;
	}






}