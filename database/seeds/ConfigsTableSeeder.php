<?php

use Illuminate\Database\Seeder;
use App\Config;

class ConfigsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Config::create([
			'key' => 'site_name',
			'text' => 'Tên trang web',
			'value' => 'SunLife'
		]);
		Config::create([
			'key' => 'website_maintenance',
			'text' => 'Bảo trì website(0/1)',
			'value' => '0'
		]);
		Config::create([
			'key' => 'website_maintenance_message',
			'text' => 'Thông báo bảo trì',
			'value' => 'Website - Đang trong giai đoạn cập nhật, quý khách vui lòng truy cập sau.'
		]);
		Config::create([
			'key' => 'site_title',
			'text' => 'Tiêu đề trang web',
			'value' => 'SunLife'
		]);
		Config::create([
			'key' => 'meta_description',
			'text' => 'Meta Description',
			'value' => 'SunLife'
		]);
		Config::create([
			'key' => 'meta_keywords',
			'text' => 'Meta Keywords',
			'value' => 'SunLife'
		]);
		Config::create([
			'key' => 'headquarter_address_street',
			'text' => 'Tên đường',
			'value' => '347 Hòa Hảo'
		]);
		Config::create([
			'key' => 'headquarter_address_ward',
			'text' => 'Phường',
			'value' => 'P. 5'
		]);
		Config::create([
			'key' => 'headquarter_address_district',
			'text' => 'Quận/Huyện',
			'value' => 'Quận 10'
		]);
		Config::create([
			'key' => 'headquarter_address_locality',
			'text' => 'Miền',
			'value' => 'Hồ Chí Minh'
		]);
		Config::create([
			'key' => 'headquarter_address_region',
			'text' => 'Vùng',
			'value' => 'Hồ Chí Minh'
		]);
		Config::create([
			'key' => 'headquarter_address_map',
			'text' => 'Google Map',
			'value' => ''
		]);
		
		Config::create([
			'key' => 'headquarter_phone_number',
			'text' => 'Số điện thoại trụ sở chính',
			'value' => '090 685 56 54'
		]);
		Config::create([
			'key' => 'headquarter_phone_number_2',
			'text' => 'Số điện thoại trụ sở chính 2',
			'value' => ''
		]);
		Config::create([
			'key' => 'headquarter_fax_number',
			'text' => 'Số fax trụ sở chính',
			'value' => ''
		]);
		Config::create([
			'key' => 'hot_line',
			'text' => 'Hotline',
			'value' => '090 685 56 54'
		]);
		Config::create([
			'key' => 'hot_line_2',
			'text' => 'Hotline 2',
			'value' => ''
		]);
		Config::create([
			'key' => 'opening_hours',
			'text' => 'Giờ hoạt động',
			'value' => 'Mo-Su'
		]);
		Config::create([
			'key' => 'currencies_accepted',
			'text' => 'Đơn vị tiền tệ',
			'value' => 'VNĐ'
		]);
		Config::create([
			'key' => 'default_shipping_fee',
			'text' => 'Phí vận chuyển mặc định',
			'value' => '0'
		]);
		Config::create([
			'key' => 'address_sender_mail',
			'text' => 'Địa chỉ gửi email',
			'value' => 'info@sunlife.vn'
		]);
		Config::create([
			'key' => 'display_name_send_mail',
			'text' => 'Tên hiển thị trên email liên hệ',
			'value' => 'SunLife'
		]);
		Config::create([
			'key' => 'address_received_mail',
			'text' => 'Địa chỉ nhận email liên hệ',
			'value' => 'info@sunlife.vn'
		]);
		Config::create([
			'key' => 'rows_per_page_article',
			'text' => 'Số bài viết hiển thị trên một trang',
			'value' => '20'
		]);
		Config::create([
			'key' => 'rows_per_page_product',
			'text' => 'Số sản phẩm hiển thị trên một trang',
			'value' => '20'
		]);
		Config::create([
			'key' => 'skype_support',
			'text' => 'Hỗ trợ qua Skype',
			'value' => 'skypeid'
		]);
		Config::create([
			'key' => 'facebook_page',
			'text' => 'Địa chỉ Facebook',
			'value' => 'https://facebook.com/toanphat247'
		]);
		Config::create([
			'key' => 'plus_google',
			'text' => 'Google plus',
			'value' => 'https://plus.google.com'
		]);
		Config::create([
			'key' => 'youtube_channel',
			'text' => 'Youtube Channel',
			'value' => 'https://youtube.com'
		]);
		Config::create([
			'key' => 'zalo_offical',
			'text' => 'Zalo Offical',
			'value' => 'https://zaloapp.com'
		]);
		Config::create([
			'key' => 'twitter_page',
			'text' => 'Twitter',
			'value' => 'https://twitter.com'
		]);
		Config::create([
			'key' => 'linkedin_page',
			'text' => 'Linkedin',
			'value' => 'https://www.linkedin.com'
		]);
		Config::create([
			'key' => 'instagram_page',
			'text' => 'Instagram',
			'value' => 'https://www.instagram.com'
		]);
		Config::create([
			'key' => 'pinterest_page',
			'text' => 'Pinterest',
			'value' => 'https://www.pinterest.com'
		]);	
		Config::create([
			'key' => 'rss',
			'text' => 'RSS',
			'value' => ''
		]);		
		Config::create([
			'key' => 'facebook_app_id',
			'text' => 'Facebook App ID',
			'value' => ''
		]);
		Config::create([
			'key' => 'facebook_fanpage_id',
			'text' => 'Facebook Fanpage ID',
			'value' => ''
		]);
		Config::create([
			'key' => 'embed_script_head',
			'text' => 'Script head',
			'value' => ''
		]);		
		Config::create([
			'key' => 'embed_script_body_top',
			'text' => 'Script body top',
			'value' => ''
		]);
		Config::create([
			'key' => 'embed_script_body_bottom',
			'text' => 'Script body bottom',
			'value' => ''
		]);
	}
}
