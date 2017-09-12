<?php

use Illuminate\Database\Seeder;
use App\ArticleType;
use App\ArticleTypeTranslation;
use App\Attachment;
use App\Common;

class ArticleTypesTableSeeder extends Seeder
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
			$entry = ArticleType::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'not_delete' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new ArticleTypeTranslation ([
				'article_type_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category,
				'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_keywords' => $category
			]));
		}

		// for test
		/*
		for ($i=0; $i < 10; $i++) {
			$value = $generator->sentence($nbWords = 6);

			$entry = ArticleType::create([
				'key' => Common::createKeyURL($value),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 0,
				'created_by' => 1,
				'updated_by' => 1
			]);
			ArticleTypeTranslation::create([
				'article_type_id' => $entry->id,
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
