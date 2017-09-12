<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductTranslation;
use App\ProductCategory;
use App\Producer;
use App\ProductColor;
use App\ProductSize;
use App\ProductType;
use App\Tag;
use App\Attachment;
use App\Common;

class ProductsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		for ($i=0; $i < 30; $i++) {
			$name = $generator->sentence($nbWords = 6);
			$producer = Producer::pluck('id')->toArray();
			$categories = ProductCategory::pluck('id')->toArray();
			$tags = Tag::pluck('id')->toArray();
			$types = ProductType::pluck('id')->toArray();
			$colors = ProductColor::pluck('id')->toArray();
			$sizes = ProductSize::pluck('id')->toArray();
			$products = Product::pluck('id')->toArray();

			$entry = Product::create([
				'key' => Common::createKeyURL($name),
				'code' => $generator->unique()->randomNumber($nbDigits = NULL),
				'model' => $generator->numerify('SKU-######'),
				'custom_size' => $generator->word,
				'producer_id' => $generator->randomElement($producer),
				'origin' => $generator->sentence($nbWords = 2),
				'unit' => $generator->word,
				'price' => $generator->numberBetween($min = 1500000, $max = 2000000),
				'sale_price' => $generator->numberBetween($min = 1000000, $max = 1500000),
				'sale_ratio' => 0,
				'warranty' => $generator->sentence($nbWords = 2),
				'priority' => 0,
				'published' => 1,
				'created_by' => '1'
			]);
			$entry->translations()->save( new ProductTranslation ([
				'product_id' => $entry->id,
				'locale' => 'vi',
				'name' => $name,
				'summary' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'description' => $generator->realText($maxNbChars = 500, $indexSize = 2),
				'additional_information' => $generator->realText($maxNbChars = 500, $indexSize = 2),
				'meta_description' => $generator->realText($maxNbChars = 200, $indexSize = 2),
				'meta_keywords' => $generator->realText($maxNbChars = 200, $indexSize = 2)
			]));

			$entry->attachments()->save( new Attachment ([
				'path' => 'product.png',
				'priority' => 0,
				'published' => 1
			]));
			
			$entry->productCategories()->attach($generator->randomElement($categories));
			$entry->tags()->attach($generator->randomElement($tags));
			$entry->productTypes()->attach($generator->randomElement($types));
			
			$entry->productColors()->attach($generator->randomElement($colors));
			$entry->productSizes()->attach($generator->randomElement($sizes));

			$entry->relatedProducts()->attach($generator->randomElement($products));
			$entry->relatedProducts()->attach($generator->randomElement($products));
			$entry->relatedProducts()->attach($generator->randomElement($products));
			$entry->relatedProducts()->attach($generator->randomElement($products));
			$entry->relatedProducts()->attach($generator->randomElement($products));
			$entry->relatedProducts()->attach($generator->randomElement($products));
			$entry->relatedProducts()->attach($generator->randomElement($products));
		}
	}
}
