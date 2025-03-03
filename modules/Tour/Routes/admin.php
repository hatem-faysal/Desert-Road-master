<?php
use Illuminate\Support\Facades\Route;

Route::get('/multilocation/{id}','MultiLocationController@index')->name('multilocation.admin.index');
Route::post('/multilocation/update/{id}','MultiLocationController@update')->name('multilocation.admin.update');
Route::get('/multilocation/destroy/{id}','MultiLocationController@destroy')->name('multilocation.admin.destroy');
//   DELETE          admin/tags/{tag} .............................................. admin.tags.destroy › Admin\TagsController@destroy



Route::get('/multi-room/{id}','MultiRoomController@index')->name('multiroom.admin.index');
Route::post('/multi-room/update/{id}','MultiRoomController@update')->name('multiroom.admin.update');
Route::get('/multi-room/destroy/{id}','MultiRoomController@destroy')->name('multiroom.admin.destroy');



Route::get('/','TourController@index')->name('tour.admin.index');
Route::get('/create','TourController@create')->name('tour.admin.create');
Route::get('/edit/{id}','TourController@edit')->name('tour.admin.edit');
Route::post('/store/{id}','TourController@store')->name('tour.admin.store');
Route::get('/getForSelect2','TourController@getForSelect2')->name('tour.admin.getForSelect2');
Route::post('/bulkEdit','TourController@bulkEdit')->name('tour.admin.bulkEdit');
Route::get('/recovery','TourController@recovery')->name('tour.admin.recovery');
Route::get('/getForSelect2','TourController@getForSelect2')->name('tour.admin.getForSelect2');

Route::get('/category','CategoryController@index')->name('tour.admin.category.index');
Route::get('/category/edit/{id}','CategoryController@edit')->name('tour.admin.category.edit');
Route::post('/category/store/{id}','CategoryController@store')->name('tour.admin.category.store');
Route::get('/category/getForSelect2','CategoryController@getForSelect2')->name('tour.admin.category.category.getForSelect2');
Route::post('/category/bulkEdit','CategoryController@bulkEdit')->name('tour.admin.category.bulkEdit');

Route::group(['prefix'=>'attribute'],function(){
    Route::get('/','AttributeController@index')->name('tour.admin.attribute.index');
    Route::get('/edit/{id}','AttributeController@edit')->name('tour.admin.attribute.edit');
    Route::post('/store/{id}','AttributeController@store')->name('tour.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('tour.admin.attribute.editAttrBulk');


    Route::get('/terms/{attr_id}','AttributeController@terms')->name('tour.admin.attribute.term.index');
    Route::get('/term_edit/{id}','AttributeController@term_edit')->name('tour.admin.attribute.term.edit');
    Route::post('/term_store/{id}','AttributeController@term_store')->name('tour.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('tour.admin.attribute.term.editTermBulk');
});


Route::group(['prefix'=>'availability'],function(){
    Route::get('/','AvailabilityController@index')->name('tour.admin.availability.index');
    Route::get('/loadDates','AvailabilityController@loadDates')->name('tour.admin.availability.loadDates');
    Route::post('/store','AvailabilityController@store')->name('tour.admin.availability.store');
});


Route::get('/booking','BookingController@index')->name('tour.admin.booking.index');
