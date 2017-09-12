<?php
namespace App\Presenters;

use Illuminate\Pagination\BootstrapThreePresenter;

/*
<ul class="product-pagi-nav pull-right list-inline">
	<li><a href="#" class="active">1</a></li>
	<li><a href="#">2</a></li>
	<li><a href="#">3</a></li>
	<li><a href="#" class="next"><span class="lnr lnr-chevron-right"></span></a></li>
</ul>
*/

class CustomPaginationPresenter extends BootstrapThreePresenter
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
				'<ul class="product-pagi-nav pull-right list-inline">%s %s %s</ul>',
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

		return '<li><a href="'.htmlentities($url).'"'.$rel.'>'.$page.'</a></li> ';
	}

	/**
	 * Get HTML wrapper for disabled text.
	 *
	 * @param  string  $text
	 * @return string
	 */
	protected function getDisabledTextWrapper($text)
	{
		return '<li><a href="javascript:void(0);">'.$text.'</a></li> ';
	}

	/**
	 * Get HTML wrapper for active text.
	 *
	 * @param  string  $text
	 * @return string
	 */
	protected function getActivePageWrapper($text)
	{
		return '<li><a href="javascript:void(0);" class="active">'.$text.'</a></li> ';
	}
}