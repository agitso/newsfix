<?php

namespace Newsfix\Core\ViewHelpers;

class RandomViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @return string
	 */
	public function render() {
		return ''.mt_rand(0, PHP_INT_MAX);
	}
}

?>