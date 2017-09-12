<?php

use Illuminate\Database\Seeder;
use App\Producer;
use App\ProducerTranslation;
use App\Attachment;
use App\Common;

class ProducersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$generator = \Faker\Factory::create('vi_VN');

		for ($i=0; $i < 10; $i++) {
			$value = $generator->sentence($nbWords = 2);

			$entry = Producer::create([
				'key' => Common::createKeyURL($value),
				'parent_id' => 0,
				'priority' => 0,
				'published' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			ProducerTranslation::create([
				'producer_id' => $entry->id,
				'locale' => 'vi',
				'name' => $value,
				'summary' => $value,
				'meta_description' => $value,
				'meta_keywords' => $value
			]);
			$entry->attachments()->save( new Attachment ([
				'path' => 'producer.png',
				'priority' => 0,
				'published' => 1
			]));
		}
	}
}
