<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>config('news.news_route_prefix')],function(){
    Route::get('/'.config('news.news_category_route_prefix').'/{slug}', 'CategoryNewsController@index')->name('news.category.index');
    Route::get('/'.config('news.news_tag_route_prefix').'/{slug}', 'TagNewsController@index')->name('news.tag.index');
    Route::get('/','NewsController@index')->name('news.index');// News Page
    Route::get('/{slug}','NewsController@detail')->name('news.detail');// Detail
});

Route::group(['prefix'=>config('news.blogs_route_prefix')],function(){
    Route::get('/'.config('news.news_category_route_prefix').'/{slug}', 'CategoryNewsController@index_blog')->name('news.category.index');
    Route::get('/'.config('news.news_tag_route_prefix').'/{slug}', 'TagNewsController@index')->name('news.tag.index');
    Route::get('/','NewsController@index_blog')->name('news.index');// News Page
    Route::get('/{slug}','NewsController@detail_blog')->name('news.detail');// Detail
});

Route::prefix('vendor/'.config('news.news_route_prefix'))->name('news.vendor.')->middleware(['auth','verified'])->group(function(){
    Route::get('/','VendorNewsController@index')->name('index');
    Route::get('/create','VendorNewsController@create')->name('create');
    Route::get('/edit/{id}', 'VendorNewsController@edit')->name('edit');
    Route::post('/bulkEdit','VendorNewsController@bulkEdit')->name('bulkEdit');
    Route::post('/store/{id}','VendorNewsController@store')->name('store');
});
