<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Config;

class Product extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'description', 'additional_information', 'meta_description', 'meta_keywords'];
	protected $dates = ['deleted_at'];

	public function productCategories()
	{
		return $this->belongsToMany('App\ProductCategory');
	}

	public function productTypes()
	{
		return $this->belongsToMany('App\ProductType');
	}

	public function producer()
	{
		return $this->belongsTo('App\Producer');
	}

	public function productColors()
	{
		return $this->belongsToMany('App\ProductColor');
	}

	public function productSizes()
	{
		return $this->belongsToMany('App\ProductSize');
	}

	public function relatedProducts()
	{
		return $this->belongsToMany('App\Product', 'related_products', 'product_id', 'related_product_id');
	}

	public function tags()
	{
		return $this->morphToMany('App\Tag', 'taggable');
	}

	public function getAvailability()
	{
		$result = 'Sẵn có';
		switch ($this->availability) {
			case 'instock':
				$result = 'Có hàng';
				break;
			case 'outofstock':
				$result = 'Hết hàng';
				break;
			case 'preorder':
				$result = 'Sắp có hàng';
				break;
			case 'availablefororder':
				$result = 'Có hàng trong 1-2 tuần';
				break;
			default:
				break;
		}
		return $result;
	}
	
	public function getVisibleRelatedProducts()
	{
		return $this->relatedProducts()->where('published', 1)->orderBy('priority')->get();
	}

	public function getLink()
	{
		$firstCategory = $this->productCategories()->first();
		if ($firstCategory) {
			return route('product', ['categorykey' => $firstCategory->key, 'producerkey' => $this->producer->key, 'key' => $this->key]);
		}
		return '';
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->orderBy('priority')->get();
	}

	public function getVisibleColors()
	{
		return $this->productColors()->where('published', 1)->orderBy('priority')->get();
	}

	public function getVisibleSizes()
	{
		return $this->productSizes()->where('published', 1)->orderBy('priority')->get();
	}

	public function getLatestPrice(){

		//TODO: sale off with time

		$price = $this->price;

		if ($this->sale_price) {
			return $this->sale_price;
		}

		if($this->sale_ratio){
			$price = $this->price * (1 - $this->sale_ratio);
		}
		return round($price);
	}

	public function getSaleRatio(){

		if ($this->sale_price) {
			return abs(round((($this->sale_price - $this->price) / $this->price) * 100));
		}

		return $this->sale_ratio;
	}

	public function getJSONLD(){
		return '{
		  "@context": "http://schema.org",
		  "@type": "Product",
		  "aggregateRating": {
			"@type": "AggregateRating",
			"ratingValue": "3.5",
			"reviewCount": "2"
		  },
		  "description": "' . $this->summary . '",
		  "name": "' . $this->name . '",
		  "offers": {
			"@type": "Offer",
			"availability": "http://schema.org/InStock",
			"price": "' . $this->getLatestPrice() . '",
			"priceCurrency": "VNĐ",
			"seller": {
				"@type": "Organization",
				"name": "'. Config::getValueByKey('site_name') .'"
    		}
		  },
		  "review": []
		}';
	}
}
