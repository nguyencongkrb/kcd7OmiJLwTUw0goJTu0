<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class CustomFilter implements FilterInterface
{
	private $width;
	private $height;
	private $fit;

	/**
	 * Creates new instance of filter
	 *
	 * @param integer $size
	 */
	public function __construct()
	{
		//$this->size = is_numeric($size) ? intval($size) : self::DEFAULT_SIZE;

		$this->width = request()->input('w', 0);
		$this->height = request()->input('h', 0);
		$this->fit = request()->input('fit', 0);
	}

	/**
	 * Applies filter effects to given image
	 *
	 * @param  Intervention\Image\Image $image
	 * @return Intervention\Image\Image
	 */
	public function applyFilter(\Intervention\Image\Image $image)
	{
		if ($this->width > 0 && $this->height > 0) {
			if ($this->fit == 1) {
				$image->fit($this->width, $this->height, function ($constraint) {
					$constraint->upsize();
				});
			}
			else{
				$image->resize($this->width, $this->height, function ($constraint) {
					$constraint->upsize();
				});
			}
		}
		elseif($this->width > 0 && $this->height <= 0){
			if ($this->fit == 1) {
				$image->fit($this->width, $this->width, function ($constraint) {
					$constraint->upsize();
				});
			}
			else{
				$image->resize($this->width, null, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				});
			}
		}
		elseif($this->width <= 0 && $this->height > 0){
			if ($this->fit == 1) {
				$image->fit($this->height, $this->height, function ($constraint) {
					$constraint->upsize();
				});
			}
			else{
				$image->resize(null, $this->height, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				});
			}
		}

		return $image;
	}
}