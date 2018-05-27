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
Route::group(
[
    'prefix' => 'abcs',
], function () {

    Route::get('/', 'AbcsController@index')
         ->name('abcs.abc.index');

    Route::get('/create','AbcsController@create')
         ->name('abcs.abc.create');

    Route::get('/show/{abc}','AbcsController@show')
         ->name('abcs.abc.show')
         ->where('id', '[0-9]+');

    Route::get('/{abc}/edit','AbcsController@edit')
         ->name('abcs.abc.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'AbcsController@store')
         ->name('abcs.abc.store');
               
    Route::put('abc/{abc}', 'AbcsController@update')
         ->name('abcs.abc.update')
         ->where('id', '[0-9]+');

    Route::delete('/abc/{abc}','AbcsController@destroy')
         ->name('abcs.abc.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'zones',
], function () {

    Route::get('/', 'ZonesController@index')
         ->name('zones.zone.index');

    Route::get('/create','ZonesController@create')
         ->name('zones.zone.create');

    Route::get('/show/{zone}','ZonesController@show')
         ->name('zones.zone.show')
         ->where('id', '[0-9]+');

    Route::get('/{zone}/edit','ZonesController@edit')
         ->name('zones.zone.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ZonesController@store')
         ->name('zones.zone.store');
               
    Route::put('zone/{zone}', 'ZonesController@update')
         ->name('zones.zone.update')
         ->where('id', '[0-9]+');

    Route::delete('/zone/{zone}','ZonesController@destroy')
         ->name('zones.zone.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'departments',
], function () {

    Route::get('/', 'DepartmentsController@index')
         ->name('departments.department.index');

    Route::get('/create','DepartmentsController@create')
         ->name('departments.department.create');

    Route::get('/show/{department}','DepartmentsController@show')
         ->name('departments.department.show')
         ->where('id', '[0-9]+');

    Route::get('/{department}/edit','DepartmentsController@edit')
         ->name('departments.department.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'DepartmentsController@store')
         ->name('departments.department.store');
               
    Route::put('department/{department}', 'DepartmentsController@update')
         ->name('departments.department.update')
         ->where('id', '[0-9]+');

    Route::delete('/department/{department}','DepartmentsController@destroy')
         ->name('departments.department.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'regions',
], function () {

    Route::get('/', 'RegionsController@index')
         ->name('regions.region.index');

    Route::get('/create','RegionsController@create')
         ->name('regions.region.create');

    Route::get('/show/{region}','RegionsController@show')
         ->name('regions.region.show')
         ->where('id', '[0-9]+');

    Route::get('/{region}/edit','RegionsController@edit')
         ->name('regions.region.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RegionsController@store')
         ->name('regions.region.store');
               
    Route::put('region/{region}', 'RegionsController@update')
         ->name('regions.region.update')
         ->where('id', '[0-9]+');

    Route::delete('/region/{region}','RegionsController@destroy')
         ->name('regions.region.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'territories',
], function () {

    Route::get('/', 'TerritoriesController@index')
         ->name('territories.territorie.index');

    Route::get('/create','TerritoriesController@create')
         ->name('territories.territorie.create');

    Route::get('/show/{territorie}','TerritoriesController@show')
         ->name('territories.territorie.show')
         ->where('id', '[0-9]+');

    Route::get('/{territorie}/edit','TerritoriesController@edit')
         ->name('territories.territorie.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'TerritoriesController@store')
         ->name('territories.territorie.store');
               
    Route::put('territorie/{territorie}', 'TerritoriesController@update')
         ->name('territories.territorie.update')
         ->where('id', '[0-9]+');

    Route::delete('/territorie/{territorie}','TerritoriesController@destroy')
         ->name('territories.territorie.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'distribution_houses',
], function () {

    Route::get('/', 'DistributionHousesController@index')
         ->name('distribution_houses.distribution_house.index');

    Route::get('/create','DistributionHousesController@create')
         ->name('distribution_houses.distribution_house.create');

    Route::get('/show/{distributionHouse}','DistributionHousesController@show')
         ->name('distribution_houses.distribution_house.show')
         ->where('id', '[0-9]+');

    Route::get('/{distributionHouse}/edit','DistributionHousesController@edit')
         ->name('distribution_houses.distribution_house.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'DistributionHousesController@store')
         ->name('distribution_houses.distribution_house.store');
               
    Route::put('distribution_house/{distributionHouse}', 'DistributionHousesController@update')
         ->name('distribution_houses.distribution_house.update')
         ->where('id', '[0-9]+');

    Route::delete('/distribution_house/{distributionHouse}','DistributionHousesController@destroy')
         ->name('distribution_houses.distribution_house.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'territories',
], function () {

    Route::get('/', 'TerritoriesController@index')
         ->name('territories.territory.index');

    Route::get('/create','TerritoriesController@create')
         ->name('territories.territory.create');

    Route::get('/show/{territory}','TerritoriesController@show')
         ->name('territories.territory.show')
         ->where('id', '[0-9]+');

    Route::get('/{territory}/edit','TerritoriesController@edit')
         ->name('territories.territory.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'TerritoriesController@store')
         ->name('territories.territory.store');
               
    Route::put('territory/{territory}', 'TerritoriesController@update')
         ->name('territories.territory.update')
         ->where('id', '[0-9]+');

    Route::delete('/territory/{territory}','TerritoriesController@destroy')
         ->name('territories.territory.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'users',
], function () {

    Route::get('/', 'UsersController@index')
         ->name('users.user.index');

    Route::get('/create','UsersController@create')
         ->name('users.user.create');

    Route::get('/show/{user}','UsersController@show')
         ->name('users.user.show')
         ->where('id', '[0-9]+');

    Route::get('/{user}/edit','UsersController@edit')
         ->name('users.user.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UsersController@store')
         ->name('users.user.store');
               
    Route::put('user/{user}', 'UsersController@update')
         ->name('users.user.update')
         ->where('id', '[0-9]+');

    Route::delete('/user/{user}','UsersController@destroy')
         ->name('users.user.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'categories',
], function () {

    Route::get('/', 'CategoriesController@index')
         ->name('categories.category.index');

    Route::get('/create','CategoriesController@create')
         ->name('categories.category.create');

    Route::get('/show/{category}','CategoriesController@show')
         ->name('categories.category.show')
         ->where('id', '[0-9]+');

    Route::get('/{category}/edit','CategoriesController@edit')
         ->name('categories.category.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'CategoriesController@store')
         ->name('categories.category.store');
               
    Route::put('category/{category}', 'CategoriesController@update')
         ->name('categories.category.update')
         ->where('id', '[0-9]+');

    Route::delete('/category/{category}','CategoriesController@destroy')
         ->name('categories.category.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'product_types',
], function () {

    Route::get('/', 'ProductTypesController@index')
         ->name('product_types.product_type.index');

    Route::get('/create','ProductTypesController@create')
         ->name('product_types.product_type.create');

    Route::get('/show/{productType}','ProductTypesController@show')
         ->name('product_types.product_type.show')
         ->where('id', '[0-9]+');

    Route::get('/{productType}/edit','ProductTypesController@edit')
         ->name('product_types.product_type.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProductTypesController@store')
         ->name('product_types.product_type.store');
               
    Route::put('product_type/{productType}', 'ProductTypesController@update')
         ->name('product_types.product_type.update')
         ->where('id', '[0-9]+');

    Route::delete('/product_type/{productType}','ProductTypesController@destroy')
         ->name('product_types.product_type.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'skues',
], function () {

    Route::get('/', 'SkuesController@index')
         ->name('skues.skue.index');

    Route::get('/create','SkuesController@create')
         ->name('skues.skue.create');

    Route::get('/show/{skue}','SkuesController@show')
         ->name('skues.skue.show')
         ->where('id', '[0-9]+');

    Route::get('/{skue}/edit','SkuesController@edit')
         ->name('skues.skue.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'SkuesController@store')
         ->name('skues.skue.store');
               
    Route::put('skue/{skue}', 'SkuesController@update')
         ->name('skues.skue.update')
         ->where('id', '[0-9]+');

    Route::delete('/skue/{skue}','SkuesController@destroy')
         ->name('skues.skue.destroy')
         ->where('id', '[0-9]+');

});
