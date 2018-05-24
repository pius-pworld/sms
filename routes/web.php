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

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


Route::get('/','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout')->name('logout');
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset');

Route::group(
[
    'prefix' => 'product_brands',
], function () {

    Route::get('/', 'ProductBrandsController@index')
         ->name('product_brands.product_brand.index');

    Route::get('/create','ProductBrandsController@create')
         ->name('product_brands.product_brand.create');

    Route::get('/show/{productBrand}','ProductBrandsController@show')
         ->name('product_brands.product_brand.show')
         ->where('id', '[0-9]+');

    Route::get('/{productBrand}/edit','ProductBrandsController@edit')
         ->name('product_brands.product_brand.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProductBrandsController@store')
         ->name('product_brands.product_brand.store');
               
    Route::put('product_brand/{productBrand}', 'ProductBrandsController@update')
         ->name('product_brands.product_brand.update')
         ->where('id', '[0-9]+');

    Route::delete('/product_brand/{productBrand}','ProductBrandsController@destroy')
         ->name('product_brands.product_brand.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'product_categories',
], function () {

    Route::get('/', 'ProductCategoriesController@index')
         ->name('product_categories.product_category.index');

    Route::get('/create','ProductCategoriesController@create')
         ->name('product_categories.product_category.create');

    Route::get('/show/{productCategory}','ProductCategoriesController@show')
         ->name('product_categories.product_category.show')
         ->where('id', '[0-9]+');

    Route::get('/{productCategory}/edit','ProductCategoriesController@edit')
         ->name('product_categories.product_category.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProductCategoriesController@store')
         ->name('product_categories.product_category.store');
               
    Route::put('product_category/{productCategory}', 'ProductCategoriesController@update')
         ->name('product_categories.product_category.update')
         ->where('id', '[0-9]+');

    Route::delete('/product_category/{productCategory}','ProductCategoriesController@destroy')
         ->name('product_categories.product_category.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'products',
], function () {

    Route::get('/', 'ProductsController@index')
         ->name('products.product.index');

    Route::get('/create','ProductsController@create')
         ->name('products.product.create');

    Route::get('/show/{product}','ProductsController@show')
         ->name('products.product.show')
         ->where('id', '[0-9]+');

    Route::get('/{product}/edit','ProductsController@edit')
         ->name('products.product.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProductsController@store')
         ->name('products.product.store');
               
    Route::put('product/{product}', 'ProductsController@update')
         ->name('products.product.update')
         ->where('id', '[0-9]+');

    Route::delete('/product/{product}','ProductsController@destroy')
         ->name('products.product.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'countries',
], function () {

    Route::get('/', 'CountriesController@index')
         ->name('countries.country.index');

    Route::get('/create','CountriesController@create')
         ->name('countries.country.create');

    Route::get('/show/{country}','CountriesController@show')
         ->name('countries.country.show')
         ->where('id', '[0-9]+');

    Route::get('/{country}/edit','CountriesController@edit')
         ->name('countries.country.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'CountriesController@store')
         ->name('countries.country.store');
               
    Route::put('country/{country}', 'CountriesController@update')
         ->name('countries.country.update')
         ->where('id', '[0-9]+');

    Route::delete('/country/{country}','CountriesController@destroy')
         ->name('countries.country.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'divisions',
], function () {

    Route::get('/', 'DivisionsController@index')
         ->name('divisions.division.index');

    Route::get('/create','DivisionsController@create')
         ->name('divisions.division.create');

    Route::get('/show/{division}','DivisionsController@show')
         ->name('divisions.division.show')
         ->where('id', '[0-9]+');

    Route::get('/{division}/edit','DivisionsController@edit')
         ->name('divisions.division.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'DivisionsController@store')
         ->name('divisions.division.store');
               
    Route::put('division/{division}', 'DivisionsController@update')
         ->name('divisions.division.update')
         ->where('id', '[0-9]+');

    Route::delete('/division/{division}','DivisionsController@destroy')
         ->name('divisions.division.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'districts',
], function () {

    Route::get('/', 'DistrictsController@index')
         ->name('districts.district.index');

    Route::get('/create','DistrictsController@create')
         ->name('districts.district.create');

    Route::get('/show/{district}','DistrictsController@show')
         ->name('districts.district.show')
         ->where('id', '[0-9]+');

    Route::get('/{district}/edit','DistrictsController@edit')
         ->name('districts.district.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'DistrictsController@store')
         ->name('districts.district.store');
               
    Route::put('district/{district}', 'DistrictsController@update')
         ->name('districts.district.update')
         ->where('id', '[0-9]+');

    Route::delete('/district/{district}','DistrictsController@destroy')
         ->name('districts.district.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'upazilas',
], function () {

    Route::get('/', 'UpazilasController@index')
         ->name('upazilas.upazila.index');

    Route::get('/create','UpazilasController@create')
         ->name('upazilas.upazila.create');

    Route::get('/show/{upazila}','UpazilasController@show')
         ->name('upazilas.upazila.show')
         ->where('id', '[0-9]+');

    Route::get('/{upazila}/edit','UpazilasController@edit')
         ->name('upazilas.upazila.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UpazilasController@store')
         ->name('upazilas.upazila.store');
               
    Route::put('upazila/{upazila}', 'UpazilasController@update')
         ->name('upazilas.upazila.update')
         ->where('id', '[0-9]+');

    Route::delete('/upazila/{upazila}','UpazilasController@destroy')
         ->name('upazilas.upazila.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'unions',
], function () {

    Route::get('/', 'UnionsController@index')
         ->name('unions.union.index');

    Route::get('/create','UnionsController@create')
         ->name('unions.union.create');

    Route::get('/show/{union}','UnionsController@show')
         ->name('unions.union.show')
         ->where('id', '[0-9]+');

    Route::get('/{union}/edit','UnionsController@edit')
         ->name('unions.union.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UnionsController@store')
         ->name('unions.union.store');
               
    Route::put('union/{union}', 'UnionsController@update')
         ->name('unions.union.update')
         ->where('id', '[0-9]+');

    Route::delete('/union/{union}','UnionsController@destroy')
         ->name('unions.union.destroy')
         ->where('id', '[0-9]+');

});


Route::get('/menuList','MenuController@menuList')->name('menuList');


Route::get('/getModuleList','ModuleController@getModuleList')->name('getModuleList');
// module changer
Route::get('/moduleChanger/{id}','ModuleController@moduleChanger')->name('moduleChanger');

Route::post('/dashboard', function () {
    return view('pages.dashboard');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(
[
    'prefix' => 'posts',
], function () {

    Route::get('/', 'PostsController@index')
         ->name('posts.post.index');

    Route::get('/create','PostsController@create')
         ->name('posts.post.create');

    Route::get('/show/{post}','PostsController@show')
         ->name('posts.post.show')
         ->where('id', '[0-9]+');

    Route::get('/{post}/edit','PostsController@edit')
         ->name('posts.post.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PostsController@store')
         ->name('posts.post.store');
               
    Route::put('post/{post}', 'PostsController@update')
         ->name('posts.post.update')
         ->where('id', '[0-9]+');

    Route::delete('/post/{post}','PostsController@destroy')
         ->name('posts.post.destroy')
         ->where('id', '[0-9]+');

});
