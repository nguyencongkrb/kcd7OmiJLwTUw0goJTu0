<?php
namespace App\Presenters;

use Illuminate\Pagination\BootstrapThreePresenter;

/*
<div class="post-pagi-nav">
	<a href="#" class="current-page">1</a>
	<a href="#">2</a>
	<a href="#">3</a>
</div>
*/

class CustomPaginationBlogPresenter extends BootstrapThreePresenter
{
   /**
	 * Convert the URL window into Bootstrap HTML.
	 *
	 * @return string
	 */
	public function render()
	{
		if ($this->hasPages()) {
			return sprintf(
				'<div class="post-pagi-nav">%s %s %s</div>',
				$this->getPreviousButton(),
				$this->getLinks(),
				$this->getNextButton()
			);
		}

		return '';
	}

	/**
	 * Get HTML wrapper for an available page link.
	 *
	 * @param  string  $url
	 * @param  int  $page
	 * @param  string|null  $rel
	 * @return string
	 */
	protected function getAvailablePageWrapper($url, $page, $rel = null)
	{
		$rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

		return '<a href="'.htmlentities($url).'"'.$rel.'>'.$page.'</a> ';
	}

	/**
	 * Get HTML wrapper for disabled text.
	 *
	 * @param  string  $text
	 * @return string
	 */
	protected function getDisabledTextWrapper($text)
	{
		return '<a href="javascript:void(0);">'.$text.'</a> ';
	}

	/**
	 * Get HTML wrapper for active text.
	 *
	 * @param  string  $text
	 * @return string
	 */
	protected function getActivePageWrapper($text)
	{
		return '<a href="javascript:void(0);" class="current-page">'.$text.'</a> ';
	}
}