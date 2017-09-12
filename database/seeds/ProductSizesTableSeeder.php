<?php

use Illuminate\Database\Seeder;
use App\ProductSize;
use App\ProductSizeTranslation;
use App\Attachment;
use App\Common;

class ProductSizesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		$categories = [];

		foreach ($categories as $key => $category) {
			$entry = ProductSize::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'not_delete' => 0,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ProductSizeTranslation ([
				'product_size_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category,
				'summary' => $category,
				'meta_description' => $category,
				'meta_keywords' => $category
			]));
		}

		/*
		for ($i=0; $i < 10; $i++) {
			$value = $generator->unique()->word;

			$entry = ProductSize::create([
				'key' => Common::createKeyURL($value),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			ProductSizeTranslation::create([
				'product_size_id' => $entry->id,
				'locale' => 'vi',
				'name' => $value,
				'summary' => $value,
				'meta_description' => $value,
				'meta_keywords' => $value
			]);
		}
		*/
	}
}
