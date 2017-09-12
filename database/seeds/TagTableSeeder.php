<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\TagTranslation;
use App\Attachment;
use App\Common;

class TagTableSeeder extends Seeder
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
			$entry = Tag::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'not_delete' => 0,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new TagTranslation ([
				'tag_id' => $entry->id,
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

			$entry = Tag::create([
				'key' => Common::createKeyURL($value),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 0,
				'created_by' => 1,
				'updated_by' => 1
			]);
			TagTranslation::create([
				'tag_id' => $entry->id,
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
