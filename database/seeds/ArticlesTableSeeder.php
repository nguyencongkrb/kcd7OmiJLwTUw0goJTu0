<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\ArticleTranslation;
use App\ArticleCategory;
use App\ArticleType;
use App\Attachment;
use App\Common;

class ArticlesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		// not_delete
		$articles = [];
		foreach ($articles as $key => $article) {
			$entry = Article::create([
				'key' => Common::createKeyURL($article),
				'priority' => 0,
				'published' => 1,
				'created_by' => '1',
				'not_delete' => 1,
				'published_by' => '1',
				'published_at' => $generator->dateTimeThisYear($max = 'now')
			]);

			$entry->translations()->save( new ArticleTranslation ([
				'article_id' => $entry->id,
				'locale' => 'vi',
				'name' => $article,
				'summary' => '',
				'content' => file_get_contents(base_path().'/database/seeds/files/'. $entry->key . '.html'),
				'meta_description' => '',
				'meta_keywords' => ''
			]));
		}

		$categories = ArticleCategory::pluck('id')->toArray();
		$types = ArticleType::pluck('id')->toArray();

		for ($i=0; $i < 10; $i++) {
			$name = $generator->sentence($nbWords = 6);
			
			$entry = Article::create([
				'key' => Common::createKeyURL($name),
				'priority' => 0,
				'published' => 1,
				'created_by' => '1',
				'published_by' => '1',
				'published_at' => $generator->dateTimeThisYear($max = 'now')
			]);

			$entry->translations()->save( new ArticleTranslation ([
				'article_id' => $entry->id,
				'locale' => 'vi',
				'name' => $name,
				'summary' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'content' => $generator->realText($maxNbChars = 500, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'meta_keywords' => $generator->realText($maxNbChars = 200, $indexSize = 2)
			]));

			$entry->attachments()->save( new Attachment ([
				'path' => 'blog-item.jpg',
				'priority' => 0,
				'published' => 1
			]));

			$entry->articleCategories()->attach($generator->randomElement($categories));
			$entry->articleTypes()->attach($generator->randomElement($types));
		}
	}
}
