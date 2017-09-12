<?php

use Illuminate\Database\Seeder;
use App\ProductCategory;
use App\ProductCategoryTranslation;
use App\Attachment;
use App\Common;

class ProductCategoriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		$categories = ['Quà tặng nữ', 'Quà tặng nam', 'Quà tặng trẻ em', 'Quà tặng theo mùa', 'Tất cả quà tặng'];

		foreach ($categories as $key => $category) {
			$entry = ProductCategory::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'not_delete' => 0,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ProductCategoryTranslation ([
				'product_category_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category,
				'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_keywords' => $category
			]));
			$entry->attachments()->save( new Attachment ([
				'path' => Common::createKeyURL($category) . '.jpg',
				'priority' => 0,
				'published' => 1
			]));

			/*
			for ($i=0; $i < 5; $i++) {
				$value = $category . '-'. $i;

				$entryLevel1 = ProductCategory::create([
					'key' => Common::createKeyURL($value),
					'parent_id' => $entry->id,
					'priority' => 0,
					'published' => 1,
					'created_by' => 1,
					'updated_by' => 1
				]);
				ProductCategoryTranslation::create([
					'product_category_id' => $entryLevel1->id,
					'locale' => 'vi',
					'name' => $value,
					'summary' => $value,
					'meta_description' => $value,
					'meta_keywords' => $value
				]);
			}
			*/
		}
		
		// for test
		/*
		for ($i=0; $i < 10; $i++) {
			$value = $generator->sentence($nbWords = 6);

			$entry = ProductCategory::create([
				'key' => Common::createKeyURL($value),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 0,
				'created_by' => 1,
				'updated_by' => 1
			]);
			ProductCategoryTranslation::create([
				'product_category_id' => $entry->id,
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
