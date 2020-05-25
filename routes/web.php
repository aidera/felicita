<?php

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

Route::get('/', 'MainController@index_redirect')->name('index_redirect');
Route::get('/ua', 'MainController@index')->name('index');
Route::get('/ru', 'MainController@index')->name('index');
Route::get('/ua/menu/{itemlink}', 'ItemController@item')->name('item');
Route::get('/ru/menu/{itemlink}', 'ItemController@item')->name('item');
Route::get('/ua/cart', 'CartController@index')->name('cart');
Route::get('/ru/cart', 'CartController@index')->name('cart');
Route::get('/ua/about', 'AboutController@index')->name('about');
Route::get('/ru/about', 'AboutController@index')->name('about');
Route::get('/ua/delivery', 'DeliveryController@index')->name('delivery');
Route::get('/ru/delivery', 'DeliveryController@index')->name('delivery');
Route::get('/ua/privacy-policy', 'PrivacyPolicyController@index')->name('privacy-policy');
Route::get('/ru/privacy-policy', 'PrivacyPolicyController@index')->name('privacy-policy');
Route::get('/ua/terms-of-use', 'TermsOfUseController@index')->name('terms-of-use');
Route::get('/ru/terms-of-use', 'TermsOfUseController@index')->name('terms-of-use');
Route::get('/ua/sitemap', 'SitemapController@index')->name('sitemap');
Route::get('/ru/sitemap', 'SitemapController@index')->name('sitemap');
Route::get('/ua/thankyou', 'OrderController@thankyou')->name('order-thankyou');
Route::get('/ru/thankyou', 'OrderController@thankyou')->name('order-thankyou');
Route::get('/sitemap-example', 'SitemapController@example')->name('sitemap-example');
Route::post('/cart/add', 'CartController@add')->name('cart-add');
Route::post('/cart/plus', 'CartController@plus')->name('cart-plus');
Route::post('/cart/minus', 'CartController@minus')->name('cart-minus');
Route::post('/cart/remove', 'CartController@remove')->name('cart-remove');
Route::post('/cart/check', 'CartController@check')->name('cart-check');
Route::post('/promocode/check', 'PromocodeController@check')->name('promocode-check');
Route::post('/order/send', 'OrderController@send')->name('order-send');

// Route::get('/mail-user', function () {
//   return view('mail.order-user');
// });
