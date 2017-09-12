<?php

use Illuminate\Database\Seeder;
use App\Banner;
use App\BannerTranslation;
use App\BannerCategory;
use App\Attachment;
use App\Common;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generator = \Faker\Factory::create('vi_VN');
        //$categories = BannerCategory::pluck('id')->toArray();
        $categories = BannerCategory::all();

		foreach ($categories as $key => $category) {
			for ($i=0; $i < 3; $i++) { 
				$name = $generator->sentence($nbWords = 6);
			
				$entry = Banner::create([
					'key' => Common::createKeyURL($name),
					'banner_category_id' => $category->id,
					'priority' => 0,
					'published' => 1,
					'created_by' => '1'
				]);

				$entry->translations()->save( new BannerTranslation ([
					'banner_id' => $entry->id,
					'locale' => 'vi',
					'name' => $name,
					'summary' => $generator->realText($maxNbChars = 100, $indexSize = 2),
					'content' => $generator->realText($maxNbChars = 100, $indexSize = 2),
					'link' => ''
				]));

				$entry->attachments()->save( new Attachment ([
					'path' => $category->key.'.jpg',
					'priority' => 0,
					'published' => 1
				]));
			}
		}
    }
}
