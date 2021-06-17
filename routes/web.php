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

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', ['uses' => 'Admin\IndexController@show', 'as' => 'indexAdmin']);

    Route::prefix('/hero')->group(function () {
        Route::get('/', ['uses' => 'Admin\Hero\HeroController@index', 'as' => 'admin.hero'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Hero\HeroController@create', 'as' => 'hero.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Hero\HeroController@store', 'as' => 'hero.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Hero\HeroController@destroy', 'as' => 'hero.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Hero\HeroController@edit', 'as' => 'hero.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Hero\HeroController@update', 'as' => 'hero.update'])->middleware('isallowed:section-update');
        Route::get('/single/{id}', ['uses' => 'Admin\Hero\HeroController@show', 'as' => 'hero.single'])->middleware('isallowed:section-index');
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Hero\HeroItemController@create', 'as' => 'hero.item.create'])->middleware('isallowed:section-create');
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Hero\HeroItemController@store', 'as' => 'hero.item.store'])->middleware('isallowed:section-store');
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Hero\HeroItemController@destroy', 'as' => 'hero.item.delete'])->middleware('isallowed:section-delete');
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Hero\HeroItemController@edit', 'as' => 'hero.item.edit'])->middleware('isallowed:section-edit');
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Hero\HeroItemController@update', 'as' => 'hero.item.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/about')->group(function () {
        Route::get('/', ['uses' => 'Admin\About\AboutController@index', 'as' => 'admin.about'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\About\AboutController@create', 'as' => 'about.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\About\AboutController@store', 'as' => 'about.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\About\AboutController@destroy', 'as' => 'about.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\About\AboutController@edit', 'as' => 'about.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\About\AboutController@update', 'as' => 'about.update'])->middleware('isallowed:section-update');
        Route::get('/single/{id}', ['uses' => 'Admin\About\AboutController@show', 'as' => 'about.single'])->middleware('isallowed:section-index');
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\About\AboutItemController@create', 'as' => 'about.item.create'])->middleware('isallowed:section-create');
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\About\AboutItemController@store', 'as' => 'about.item.store'])->middleware('isallowed:section-store');
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\About\AboutItemController@destroy', 'as' => 'about.item.delete'])->middleware('isallowed:section-delete');
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\About\AboutItemController@edit', 'as' => 'about.item.edit'])->middleware('isallowed:section-edit');
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\About\AboutItemController@update', 'as' => 'about.item.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/client')->group(function () {
        Route::get('/', ['uses' => 'Admin\Client\ClientController@index', 'as' => 'admin.client'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Client\ClientController@create', 'as' => 'admin.client.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Client\ClientController@store', 'as' => 'admin.client.store'])->middleware('isallowed:section-create');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Client\ClientController@destroy', 'as' => 'admin.client.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Client\ClientController@edit', 'as' => 'admin.client.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Client\ClientController@update', 'as' => 'admin.client.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/feature')->group(function () {
        Route::get('/', ['uses' => 'Admin\Feature\FeatureController@index', 'as' => 'admin.feature'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Feature\FeatureController@create', 'as' => 'admin.feature.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Feature\FeatureController@store', 'as' => 'admin.feature.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Feature\FeatureController@destroy', 'as' => 'admin.feature.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Feature\FeatureController@edit', 'as' => 'admin.feature.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Feature\FeatureController@update', 'as' => 'admin.feature.update'])->middleware('isallowed:section-update');
        Route::get('/single/{id}', ['uses' => 'Admin\Feature\FeatureController@show', 'as' => 'admin.feature.single'])->middleware('isallowed:section-index');
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Feature\FeatureItemController@create', 'as' => 'admin.feature.item.create'])->middleware('isallowed:section-create');
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Feature\FeatureItemController@store', 'as' => 'admin.feature.item.store'])->middleware('isallowed:section-store');
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Feature\FeatureItemController@destroy', 'as' => 'admin.feature.item.delete'])->middleware('isallowed:section-delete');
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Feature\FeatureItemController@edit', 'as' => 'admin.feature.item.edit'])->middleware('isallowed:section-edit');
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Feature\FeatureItemController@update', 'as' => 'admin.feature.item.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/service')->group(function () {
        Route::get('/', ['uses' => 'Admin\Service\ServiceController@index', 'as' => 'admin.service'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Service\ServiceController@create', 'as' => 'admin.service.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Service\ServiceController@store', 'as' => 'admin.service.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Service\ServiceController@destroy', 'as' => 'admin.service.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Service\ServiceController@edit', 'as' => 'admin.service.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Service\ServiceController@update', 'as' => 'admin.service.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/cta')->group(function () {
        Route::get('/', ['uses' => 'Admin\CTA\CTAController@index', 'as' => 'admin.cta'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\CTA\CTAController@create', 'as' => 'admin.cta.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\CTA\CTAController@store', 'as' => 'admin.cta.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\CTA\CTAController@destroy', 'as' => 'admin.cta.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\CTA\CTAController@edit', 'as' => 'admin.cta.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\CTA\CTAController@update', 'as' => 'admin.cta.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/filter-portfolio')->group(function () {
        Route::get('/', ['uses' => 'Admin\Portfolio\FilterController@index', 'as' => 'admin.filter_portfolio'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Portfolio\FilterController@create', 'as' => 'admin.filter_portfolio.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Portfolio\FilterController@store', 'as' => 'admin.filter_portfolio.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Portfolio\FilterController@destroy', 'as' => 'admin.filter_portfolio.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Portfolio\FilterController@edit', 'as' => 'admin.filter_portfolio.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Portfolio\FilterController@update', 'as' => 'admin.filter_portfolio.update'])->middleware('isallowed:section-update');
        Route::get('/single/{id}', ['uses' => 'Admin\Portfolio\FilterController@show', 'as' => 'admin.filter_portfolio.single'])->middleware('isallowed:section-index');
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Portfolio\PortfolioController@create', 'as' => 'admin.filter_portfolio.item.create'])->middleware('isallowed:section-create');
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Portfolio\PortfolioController@store', 'as' => 'admin.filter_portfolio.item.store'])->middleware('isallowed:section-store');
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Portfolio\PortfolioController@destroy', 'as' => 'admin.filter_portfolio.item.delete'])->middleware('isallowed:section-delete');
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Portfolio\PortfolioController@edit', 'as' => 'admin.filter_portfolio.item.edit'])->middleware('isallowed:section-edit');
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Portfolio\PortfolioController@update', 'as' => 'admin.filter_portfolio.item.update'])->middleware('isallowed:section-update');
    });

    Route::get('/portfolio-filter/{singleId}/single/{id}', ['uses' => 'Admin\Portfolio\PortfolioController@show', 'as' => 'admin.portfolio_filter.single'])->middleware('isallowed:section-index');

    Route::prefix('/count')->group(function () {
        Route::get('/', ['uses' => 'Admin\Count\CountController@index', 'as' => 'admin.count'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Count\CountController@create', 'as' => 'admin.count.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Count\CountController@store', 'as' => 'admin.count.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Count\CountController@destroy', 'as' => 'admin.count.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Count\CountController@edit', 'as' => 'admin.count.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Count\CountController@update', 'as' => 'admin.count.update'])->middleware('isallowed:section-update');
        Route::get('/single/{id}', ['uses' => 'Admin\Count\CountController@show', 'as' => 'admin.count.single'])->middleware('isallowed:section-index');
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Count\CountItemController@create', 'as' => 'admin.count.item.create'])->middleware('isallowed:section-create');
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Count\CountItemController@store', 'as' => 'admin.count.item.store'])->middleware('isallowed:section-store');
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Count\CountItemController@destroy', 'as' => 'admin.count.item.delete'])->middleware('isallowed:section-delete');
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Count\CountItemController@edit', 'as' => 'admin.count.item.edit'])->middleware('isallowed:section-edit');
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Count\CountItemController@update', 'as' => 'admin.count.item.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/testimonial')->group(function () {
        Route::get('/', ['uses' => 'Admin\Testimonial\TestimonialController@index', 'as' => 'admin.testimonial'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Testimonial\TestimonialController@create', 'as' => 'admin.testimonial.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Testimonial\TestimonialController@store', 'as' => 'admin.testimonial.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Testimonial\TestimonialController@destroy', 'as' => 'admin.testimonial.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Testimonial\TestimonialController@edit', 'as' => 'admin.testimonial.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Testimonial\TestimonialController@update', 'as' => 'admin.testimonial.update'])->middleware('isallowed:section-update');
        Route::get('/single/{id}', ['uses' => 'Admin\Testimonial\TestimonialController@show', 'as' => 'admin.testimonial.single'])->middleware('isallowed:section-index');
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Testimonial\TestimonialItemController@create', 'as' => 'admin.testimonial.item.create'])->middleware('isallowed:section-create');
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Testimonial\TestimonialItemController@store', 'as' => 'admin.testimonial.item.store'])->middleware('isallowed:section-store');
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Testimonial\TestimonialItemController@destroy', 'as' => 'admin.testimonial.item.delete'])->middleware('isallowed:section-delete');
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Testimonial\TestimonialItemController@edit', 'as' => 'admin.testimonial.item.edit'])->middleware('isallowed:section-edit');
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Testimonial\TestimonialItemController@update', 'as' => 'admin.testimonial.item.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/team')->group(function () {
        Route::get('/', ['uses' => 'Admin\Team\TeamController@index', 'as' => 'admin.team'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Team\TeamController@create', 'as' => 'admin.team.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Team\TeamController@store', 'as' => 'admin.team.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Team\TeamController@destroy', 'as' => 'admin.team.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Team\TeamController@edit', 'as' => 'admin.team.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Team\TeamController@update', 'as' => 'admin.team.update'])->middleware('isallowed:section-update');
        Route::get('/single/{id}', ['uses' => 'Admin\Team\TeamController@show', 'as' => 'admin.team.single'])->middleware('isallowed:section-index');
        Route::get('/{singleId}/item/create', ['uses' => 'Admin\Team\TeamSocialController@create', 'as' => 'admin.team.item.create'])->middleware('isallowed:section-create');
        Route::post('/{singleId}/item/create', ['uses' => 'Admin\Team\TeamSocialController@store', 'as' => 'admin.team.item.store'])->middleware('isallowed:section-store');
        Route::delete('/{singleId}/item/delete/{id}', ['uses' => 'Admin\Team\TeamSocialController@destroy', 'as' => 'admin.team.item.delete'])->middleware('isallowed:section-delete');
        Route::get('/{singleId}/item/update/{id}', ['uses' => 'Admin\Team\TeamSocialController@edit', 'as' => 'admin.team.item.edit'])->middleware('isallowed:section-edit');
        Route::put('/{singleId}/item/update/{id}', ['uses' => 'Admin\Team\TeamSocialController@update', 'as' => 'admin.team.item.update'])->middleware('isallowed:section-update');
    });

    Route::prefix('/contact')->group(function () {
        Route::get('/', ['uses' => 'Admin\Contact\ContactController@index', 'as' => 'admin.contact'])->middleware('isallowed:section-index');
        Route::get('/create', ['uses' => 'Admin\Contact\ContactController@create', 'as' => 'admin.contact.create'])->middleware('isallowed:section-create');
        Route::post('/create', ['uses' => 'Admin\Contact\ContactController@store', 'as' => 'admin.contact.store'])->middleware('isallowed:section-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\Contact\ContactController@destroy', 'as' => 'admin.contact.delete'])->middleware('isallowed:section-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\Contact\ContactController@edit', 'as' => 'admin.contact.edit'])->middleware('isallowed:section-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\Contact\ContactController@update', 'as' => 'admin.contact.update'])->middleware('isallowed:section-update');

        Route::prefix('/map')->group(function () {
            Route::get('/', ['uses' => 'Admin\Contact\MapController@index', 'as' => 'admin.map'])->middleware('isallowed:section-index');
            Route::get('/create', ['uses' => 'Admin\Contact\MapController@create', 'as' => 'admin.map.create'])->middleware('isallowed:section-create');
            Route::post('/create', ['uses' => 'Admin\Contact\MapController@store', 'as' => 'admin.map.store'])->middleware('isallowed:section-store');
            Route::delete('/delete/{id}', ['uses' => 'Admin\Contact\MapController@destroy', 'as' => 'admin.map.delete'])->middleware('isallowed:section-delete');
            Route::get('/update/{id}', ['uses' => 'Admin\Contact\MapController@edit', 'as' => 'admin.map.edit'])->middleware('isallowed:section-edit');
            Route::put('/update/{id}', ['uses' => 'Admin\Contact\MapController@update', 'as' => 'admin.map.update'])->middleware('isallowed:section-update');
        });

        Route::prefix('/social')->group(function () {
            Route::get('/', ['uses' => 'Admin\Social\SocialController@index', 'as' => 'admin.social'])->middleware('isallowed:section-index');
            Route::get('/create', ['uses' => 'Admin\Social\SocialController@create', 'as' => 'admin.social.create'])->middleware('isallowed:section-create');
            Route::post('/create', ['uses' => 'Admin\Social\SocialController@store', 'as' => 'admin.social.store'])->middleware('isallowed:section-store');
            Route::delete('/delete/{id}', ['uses' => 'Admin\Social\SocialController@destroy', 'as' => 'admin.social.delete'])->middleware('isallowed:section-delete');
            Route::get('/update/{id}', ['uses' => 'Admin\Social\SocialController@edit', 'as' => 'admin.social.edit'])->middleware('isallowed:section-edit');
            Route::put('/update/{id}', ['uses' => 'Admin\Social\SocialController@update', 'as' => 'admin.social.update'])->middleware('isallowed:section-update');
        });
    });

    Route::prefix('/user')->group(function () {
        Route::get('/', ['uses' => 'Admin\User\UserController@index', 'as' => 'admin.user'])->middleware('isallowed:user-index');
        Route::get('/create', ['uses' => 'Admin\User\UserController@create', 'as' => 'admin.user.create'])->middleware('isallowed:user-create');
        Route::post('/create', ['uses' => 'Admin\User\UserController@store', 'as' => 'admin.user.store'])->middleware('isallowed:user-store');
        Route::delete('/delete/{id}', ['uses' => 'Admin\User\UserController@destroy', 'as' => 'admin.user.delete'])->middleware('isallowed:user-delete');
        Route::get('/update/{id}', ['uses' => 'Admin\User\UserController@edit', 'as' => 'admin.user.edit'])->middleware('isallowed:user-edit');
        Route::put('/update/{id}', ['uses' => 'Admin\User\UserController@update', 'as' => 'admin.user.update'])->middleware('isallowed:user-update');
    });
});
