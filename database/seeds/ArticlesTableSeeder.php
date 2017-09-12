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
		$articles = ['Giới thiệu', 'Các câu hỏi thường gặp', 'Điều khoản sử dụng'];
		$category = ArticleCategory::findByKey('ve-chung-toi')->first();
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
				'summary' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'content' => $generator->realText($maxNbChars = 500, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'meta_keywords' => $generator->realText($maxNbChars = 200, $indexSize = 2)
			]));

			$entry->articleCategories()->attach($category->id);
		}

		$articles = ['Phương thức đặt hàng', 'Phương thức thanh toán', 'Phương thức giao hàng'];
		$category = ArticleCategory::findByKey('huong-dan')->first();
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
				'summary' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'content' => $generator->realText($maxNbChars = 500, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'meta_keywords' => $generator->realText($maxNbChars = 200, $indexSize = 2)
			]));

			$entry->articleCategories()->attach($category->id);
		}

		$articles = ['Chính sách bảo mật', 'Chính sách đổi trả', 'Chính sách bảo hành'];
		$category = ArticleCategory::findByKey('chinh-sach')->first();
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
				'summary' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'content' => $generator->realText($maxNbChars = 500, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'meta_keywords' => $generator->realText($maxNbChars = 200, $indexSize = 2)
			]));

			$entry->articleCategories()->attach($category->id);
		}

		$category = ArticleCategory::findByKey('kien-thuc-qua-tang')->first();

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
				'path' => 'blog-item.png',
				'priority' => 0,
				'published' => 1
			]));

			$entry->articleCategories()->attach($category->id);
		}

		$category = ArticleCategory::findByKey('chuong-trinh')->first();

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
				'path' => 'blog-item.png',
				'priority' => 0,
				'published' => 1
			]));

			$entry->articleCategories()->attach($category->id);
		}
	}
}
