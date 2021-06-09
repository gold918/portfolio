<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], '/', ['uses' => 'IndexController@execute', 'as' => 'index']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/', ['uses' => 'Admin\IndexController@show', 'as' => 'indexAdmin']);

    Route::prefix('/hero')->group(function () {
        Route::get('/', ['uses' => 'Admin\Hero\HeroController@index', 'as' => 'admin.hero']);
        Route::get('/create', ['uses' => 'Admin\Hero\HeroController@create', 'as' => 'hero.create']);
        Route::post('/create', ['uses' => 'Admin\Hero\HeroController@store', 'as' => 'hero.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Hero\HeroController@destroy', 'as' => 'hero.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Hero\HeroController@edit', 'as' => 'hero.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Hero\HeroController@update', 'as' => 'hero.update']);
        Route::get('/single/{id}', ['uses' => 'Admin\Hero\HeroController@show', 'as' => 'hero.single']);
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Hero\HeroItemController@create', 'as' => 'hero.item.create']);
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Hero\HeroItemController@store', 'as' => 'hero.item.store']);
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Hero\HeroItemController@destroy', 'as' => 'hero.item.delete']);
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Hero\HeroItemController@edit', 'as' => 'hero.item.edit']);
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Hero\HeroItemController@update', 'as' => 'hero.item.update']);
    });

    Route::prefix('/about')->group(function () {
        Route::get('/', ['uses' => 'Admin\About\AboutController@index', 'as' => 'admin.about']);
        Route::get('/create', ['uses' => 'Admin\About\AboutController@create', 'as' => 'about.create']);
        Route::post('/create', ['uses' => 'Admin\About\AboutController@store', 'as' => 'about.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\About\AboutController@destroy', 'as' => 'about.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\About\AboutController@edit', 'as' => 'about.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\About\AboutController@update', 'as' => 'about.update']);
        Route::get('/single/{id}', ['uses' => 'Admin\About\AboutController@show', 'as' => 'about.single']);
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\About\AboutItemController@create', 'as' => 'about.item.create']);
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\About\AboutItemController@store', 'as' => 'about.item.store']);
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\About\AboutItemController@destroy', 'as' => 'about.item.delete']);
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\About\AboutItemController@edit', 'as' => 'about.item.edit']);
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\About\AboutItemController@update', 'as' => 'about.item.update']);
    });

    Route::prefix('/client')->group(function () {
        Route::get('/', ['uses' => 'Admin\Client\ClientController@index', 'as' => 'admin.client']);
        Route::get('/create', ['uses' => 'Admin\Client\ClientController@create', 'as' => 'admin.client.create']);
        Route::post('/create', ['uses' => 'Admin\Client\ClientController@store', 'as' => 'admin.client.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Client\ClientController@destroy', 'as' => 'admin.client.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Client\ClientController@edit', 'as' => 'admin.client.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Client\ClientController@update', 'as' => 'admin.client.update']);
    });

    Route::prefix('/feature')->group(function () {
        Route::get('/', ['uses' => 'Admin\Feature\FeatureController@index', 'as' => 'admin.feature']);
        Route::get('/create', ['uses' => 'Admin\Feature\FeatureController@create', 'as' => 'admin.feature.create']);
        Route::post('/create', ['uses' => 'Admin\Feature\FeatureController@store', 'as' => 'admin.feature.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Feature\FeatureController@destroy', 'as' => 'admin.feature.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Feature\FeatureController@edit', 'as' => 'admin.feature.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Feature\FeatureController@update', 'as' => 'admin.feature.update']);
        Route::get('/single/{id}', ['uses' => 'Admin\Feature\FeatureController@show', 'as' => 'admin.feature.single']);
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Feature\FeatureItemController@create', 'as' => 'admin.feature.item.create']);
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Feature\FeatureItemController@store', 'as' => 'admin.feature.item.store']);
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Feature\FeatureItemController@destroy', 'as' => 'admin.feature.item.delete']);
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Feature\FeatureItemController@edit', 'as' => 'admin.feature.item.edit']);
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Feature\FeatureItemController@update', 'as' => 'admin.feature.item.update']);
    });

    Route::prefix('/service')->group(function () {
        Route::get('/', ['uses' => 'Admin\Service\ServiceController@index', 'as' => 'admin.service']);
        Route::get('/create', ['uses' => 'Admin\Service\ServiceController@create', 'as' => 'admin.service.create']);
        Route::post('/create', ['uses' => 'Admin\Service\ServiceController@store', 'as' => 'admin.service.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Service\ServiceController@destroy', 'as' => 'admin.service.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Service\ServiceController@edit', 'as' => 'admin.service.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Service\ServiceController@update', 'as' => 'admin.service.update']);
    });

    Route::prefix('/cta')->group(function () {
        Route::get('/', ['uses' => 'Admin\CTA\CTAController@index', 'as' => 'admin.cta']);
        Route::get('/create', ['uses' => 'Admin\CTA\CTAController@create', 'as' => 'admin.cta.create']);
        Route::post('/create', ['uses' => 'Admin\CTA\CTAController@store', 'as' => 'admin.cta.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\CTA\CTAController@destroy', 'as' => 'admin.cta.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\CTA\CTAController@edit', 'as' => 'admin.cta.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\CTA\CTAController@update', 'as' => 'admin.cta.update']);
    });

    Route::prefix('/filter-portfolio')->group(function () {
        Route::get('/', ['uses' => 'Admin\Portfolio\FilterController@index', 'as' => 'admin.filter_portfolio']);
        Route::get('/create', ['uses' => 'Admin\Portfolio\FilterController@create', 'as' => 'admin.filter_portfolio.create']);
        Route::post('/create', ['uses' => 'Admin\Portfolio\FilterController@store', 'as' => 'admin.filter_portfolio.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Portfolio\FilterController@destroy', 'as' => 'admin.filter_portfolio.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Portfolio\FilterController@edit', 'as' => 'admin.filter_portfolio.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Portfolio\FilterController@update', 'as' => 'admin.filter_portfolio.update']);
        Route::get('/single/{id}', ['uses' => 'Admin\Portfolio\FilterController@show', 'as' => 'admin.filter_portfolio.single']);
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Portfolio\PortfolioController@create', 'as' => 'admin.filter_portfolio.item.create']);
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Portfolio\PortfolioController@store', 'as' => 'admin.filter_portfolio.item.store']);
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Portfolio\PortfolioController@destroy', 'as' => 'admin.filter_portfolio.item.delete']);
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Portfolio\PortfolioController@edit', 'as' => 'admin.filter_portfolio.item.edit']);
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Portfolio\PortfolioController@update', 'as' => 'admin.filter_portfolio.item.update']);
    });

    Route::get('/portfolio-filter/{singleId}/single/{id}', ['uses' => 'Admin\Portfolio\PortfolioController@show', 'as' => 'admin.portfolio_filter.single']);

    Route::prefix('/count')->group(function () {
        Route::get('/', ['uses' => 'Admin\Count\CountController@index', 'as' => 'admin.count']);
        Route::get('/create', ['uses' => 'Admin\Count\CountController@create', 'as' => 'admin.count.create']);
        Route::post('/create', ['uses' => 'Admin\Count\CountController@store', 'as' => 'admin.count.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Count\CountController@destroy', 'as' => 'admin.count.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Count\CountController@edit', 'as' => 'admin.count.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Count\CountController@update', 'as' => 'admin.count.update']);
        Route::get('/single/{id}', ['uses' => 'Admin\Count\CountController@show', 'as' => 'admin.count.single']);
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Count\CountItemController@create', 'as' => 'admin.count.item.create']);
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Count\CountItemController@store', 'as' => 'admin.count.item.store']);
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Count\CountItemController@destroy', 'as' => 'admin.count.item.delete']);
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Count\CountItemController@edit', 'as' => 'admin.count.item.edit']);
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Count\CountItemController@update', 'as' => 'admin.count.item.update']);
    });

    Route::prefix('/testimonial')->group(function () {
        Route::get('/', ['uses' => 'Admin\Testimonial\TestimonialController@index', 'as' => 'admin.testimonial']);
        Route::get('/create', ['uses' => 'Admin\Testimonial\TestimonialController@create', 'as' => 'admin.testimonial.create']);
        Route::post('/create', ['uses' => 'Admin\Testimonial\TestimonialController@store', 'as' => 'admin.testimonial.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Testimonial\TestimonialController@destroy', 'as' => 'admin.testimonial.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Testimonial\TestimonialController@edit', 'as' => 'admin.testimonial.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Testimonial\TestimonialController@update', 'as' => 'admin.testimonial.update']);
        Route::get('/single/{id}', ['uses' => 'Admin\Testimonial\TestimonialController@show', 'as' => 'admin.testimonial.single']);
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Testimonial\TestimonialItemController@create', 'as' => 'admin.testimonial.item.create']);
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Testimonial\TestimonialItemController@store', 'as' => 'admin.testimonial.item.store']);
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Testimonial\TestimonialItemController@destroy', 'as' => 'admin.testimonial.item.delete']);
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Testimonial\TestimonialItemController@edit', 'as' => 'admin.testimonial.item.edit']);
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Testimonial\TestimonialItemController@update', 'as' => 'admin.testimonial.item.update']);
    });

    Route::prefix('/team')->group(function () {
        Route::get('/', ['uses' => 'Admin\Team\TeamController@index', 'as' => 'admin.team']);
        Route::get('/create', ['uses' => 'Admin\Team\TeamController@create', 'as' => 'admin.team.create']);
        Route::post('/create', ['uses' => 'Admin\Team\TeamController@store', 'as' => 'admin.team.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Team\TeamController@destroy', 'as' => 'admin.team.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Team\TeamController@edit', 'as' => 'admin.team.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Team\TeamController@update', 'as' => 'admin.team.update']);
        Route::get('/single/{id}', ['uses' => 'Admin\Team\TeamController@show', 'as' => 'admin.team.single']);
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Team\TeamSocialController@create', 'as' => 'admin.team.item.create']);
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Team\TeamSocialController@store', 'as' => 'admin.team.item.store']);
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Team\TeamSocialController@destroy', 'as' => 'admin.team.item.delete']);
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Team\TeamSocialController@edit', 'as' => 'admin.team.item.edit']);
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Team\TeamSocialController@update', 'as' => 'admin.team.item.update']);
    });

    Route::prefix('/contact')->group(function () {
        Route::get('/', ['uses' => 'Admin\Contact\ContactController@index', 'as' => 'admin.contact']);
        Route::get('/create', ['uses' => 'Admin\Contact\ContactController@create', 'as' => 'admin.contact.create']);
        Route::post('/create', ['uses' => 'Admin\Contact\ContactController@store', 'as' => 'admin.contact.store']);
        Route::delete('/delete/{id}', ['uses' => 'Admin\Contact\ContactController@destroy', 'as' => 'admin.contact.delete']);
        Route::get('/update/{id}', ['uses' => 'Admin\Contact\ContactController@edit', 'as' => 'admin.contact.edit']);
        Route::put('/update/{id}', ['uses' => 'Admin\Contact\ContactController@update', 'as' => 'admin.contact.update']);

        Route::prefix('/map')->group(function () {
            Route::get('/', ['uses' => 'Admin\Contact\MapController@index', 'as' => 'admin.map']);
            Route::get('/create', ['uses' => 'Admin\Contact\MapController@create', 'as' => 'admin.map.create']);
            Route::post('/create', ['uses' => 'Admin\Contact\MapController@store', 'as' => 'admin.map.store']);
            Route::delete('/delete/{id}', ['uses' => 'Admin\Contact\MapController@destroy', 'as' => 'admin.map.delete']);
            Route::get('/update/{id}', ['uses' => 'Admin\Contact\MapController@edit', 'as' => 'admin.map.edit']);
            Route::put('/update/{id}', ['uses' => 'Admin\Contact\MapController@update', 'as' => 'admin.map.update']);
        });

        Route::prefix('/social')->group(function () {
            Route::get('/', ['uses' => 'Admin\Social\SocialController@index', 'as' => 'admin.social']);
            Route::get('/create', ['uses' => 'Admin\Social\SocialController@create', 'as' => 'admin.social.create']);
            Route::post('/create', ['uses' => 'Admin\Social\SocialController@store', 'as' => 'admin.social.store']);
            Route::delete('/delete/{id}', ['uses' => 'Admin\Social\SocialController@destroy', 'as' => 'admin.social.delete']);
            Route::get('/update/{id}', ['uses' => 'Admin\Social\SocialController@edit', 'as' => 'admin.social.edit']);
            Route::put('/update/{id}', ['uses' => 'Admin\Social\SocialController@update', 'as' => 'admin.social.update']);
        });
    });
});
