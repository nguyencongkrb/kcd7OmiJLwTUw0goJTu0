<?php

use Illuminate\Database\Seeder;
use App\ProductType;
use App\ProductTypeTranslation;
use App\Attachment;
use App\Common;

class ProductTypesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		$categories = ['Sản phẩm nổi bật'];

		foreach ($categories as $key => $category) {
			$entry = ProductType::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'not_delete' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ProductTypeTranslation ([
				'product_type_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category,
				'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_keywords' => $category
			]));
		}

		/*
		for ($i=0; $i < 10; $i++) {
			$value = $generator->sentence($nbWords = 6);

			$entry = ProductType::create([
				'key' => Common::createKeyURL($value),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			ProductTypeTranslation::create([
				'product_type_id' => $entry->id,
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
