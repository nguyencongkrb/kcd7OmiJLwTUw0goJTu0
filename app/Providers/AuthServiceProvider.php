<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\ArticleCategory;
use App\Policies\ArticleCategoryPolicy;
use App\ArticleType;
use App\Policies\ArticleTypePolicy;
use App\Tag;
use App\Policies\TagPolicy;
use App\Article;
use App\Policies\ArticlePolicy;
use App\Product;
use App\Policies\ProductPolicy;
use App\ProductCategory;
use App\Policies\ProductCategoryPolicy;
use App\ProductType;
use App\Policies\ProductTypePolicy;
use App\ProductColor;
use App\Policies\ProductColorPolicy;
use App\ProductSize;
use App\Policies\ProductSizePolicy;
use App\Producer;
use App\Policies\ProducerPolicy;
use App\BannerCategory;
use App\Policies\BannerCategoryPolicy;
use App\Banner;
use App\Policies\BannerPolicy;
use App\User;
use App\Policies\UserPolicy;
use App\Config;
use App\Policies\ConfigPolicy;
use App\Testimonial;
use App\Policies\TestimonialPolicy;
use App\AdditionalValue;
use App\Policies\AdditionalValuePolicy;
use App\AdditionalCategory;
use App\Policies\AdditionalCategoryPolicy;
use App\PromotionCode;
use App\Policies\PromotionCodePolicy;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		ArticleCategory::class => ArticleCategoryPolicy::class,
		ArticleType::class => ArticleTypePolicy::class,
		Tag::class => TagPolicy::class,
		Article::class => ArticlePolicy::class,
		Product::class => ProductPolicy::class,
		ProductCategory::class => ProductCategoryPolicy::class,
		ProductType::class => ProductTypePolicy::class,
		ProductColor::class => ProductColorPolicy::class,
		ProductSize::class => ProductSizePolicy::class,
		Producer::class => ProducerPolicy::class,
		BannerCategory::class => BannerCategoryPolicy::class,
		Banner::class => BannerPolicy::class,
		User::class => UserPolicy::class,
		Config::class => ConfigPolicy::class,
		Testimonial::class => TestimonialPolicy::class,
		AdditionalValue::class => AdditionalValuePolicy::class,
		AdditionalCategory::class => AdditionalCategoryPolicy::class,
		PromotionCode::class => PromotionCodePolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		//
	}
}
