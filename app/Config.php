<?php

namespace App;

class Config extends BaseModel
{
	public $timestamps = false;

	public static function getValueByKey($key = '')
	{
		return self::findByKey($key)->first()->value;
	}

	public function getJSONLD(){
		return '{
			"@context": "http://schema.org",
				"@type": "LocalBusiness",
				"address": {
				"@type": "PostalAddress",
					"addressLocality": "'. $this->getValueByKey('headquarter_address_locality') .'",
					"addressRegion": "'. $this->getValueByKey('headquarter_address_region') .'",
					"streetAddress": "'. $this->getValueByKey('headquarter_address_street') . ', '. $this->getValueByKey('headquarter_address_ward') . ', ' . $this->getValueByKey('headquarter_address_district') .'"
			},
			"description": "'. $this->getValueByKey('meta_description') .'",
			"name": "'. $this->getValueByKey('site_name') .'",
			"openingHours": "'. $this->getValueByKey('opening_hours') .'",
			"telephone": "'. $this->getValueByKey('headquarter_phone_number') .'",
			"currenciesAccepted": "'. $this->getValueByKey('currencies_accepted') .'",
			"url": "'. url()->route('home') .'"
		}';
	}
}
