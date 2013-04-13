<?php

namespace Newsfix\Core\Domain\Model;

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Article {

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $abstract;

	/**
	 * @var int
	 */
	protected $ordering;

	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @var int
	 */
	protected $imageHeight;

	/**
	 * @var \Doctrine\Common\Collections\Collection<\Newsfix\Core\Domain\Model\Content>
	 * @ORM\OneToMany(mappedBy="article")
	 * @ORM\OrderBy({"ordering" = "ASC"})
	 */
	protected $content;

	public function __construct() {
		$this->content = new \Doctrine\Common\Collections\ArrayCollection();
		$this->ordering = 0;
		$this->imageHeight = mt_rand(200,500);
	}

	/**
	 * @param string $abstract
	 */
	public function setAbstract($abstract) {
		$this->abstract = $abstract;
	}

	/**
	 * @return string
	 */
	public function getAbstract() {
		return $this->abstract;
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
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param \DateTime $date
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * @return \DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param \Newsfix\Core\Domain\Model\Content $content
	 */
	public function addContent($content) {
		$content->setArticle($this);
		$content->setOrdering($this->ordering);
		$this->ordering++;
		$this->content->add($content);
	}

	/**
	 * @return int
	 */
	public function getImageHeight() {
		return $this->imageHeight;
	}

	/**
	 * @return string
	 */
	public function getImage() {
		return 'http://lorempixel.com/440/' . $this->getImageHeight() . '?v='.mt_rand(200, 500);
	}

	/**
	 * @return int
	 */
	public function getLikes() {
		return mt_rand(0,100);
	}

	/**
	 * @return bool
	 */
	public function getLiked() {
		return mt_rand(0,1) === 1;
	}

}