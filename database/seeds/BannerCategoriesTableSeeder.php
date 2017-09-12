<?php

use Illuminate\Database\Seeder;
use App\BannerCategory;
use App\BannerCategoryTranslation;
use App\Attachment;
use App\Common;

class BannerCategoriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		$categories = ['Banner Trang Chủ', 'Banner Đăng Nhập'];

		foreach ($categories as $key => $category) {
			$entry = BannerCategory::create([
				'key' => Common::createKeyURL($category),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'not_delete' => 1,
				'created_by' => 1
			]);
			$entry->translations()->save( new BannerCategoryTranslation ([
				'banner_category_id' => $entry->id,
				'locale' => 'vi',
				'name' => $category,
				'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 100, $indexSize = 2),
				'meta_keywords' => $category
			]));
		}
	}
}
