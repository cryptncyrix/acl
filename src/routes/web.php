<?php
Route::get('Acl', function(){
    return view('Acl::Acl');
});
Route::post('Acl', function (){
    return true;
})->name('Acl');

//Route::get('home', 'cyrixbiz\acl\controller\RoleController@index');
Route::middleware(['web' , 'acl'])->group(function () {


 //   Route::view('home', 'Acl::home/home');

    Route::get('home', function (){
       return view('Acl::home/index');
    })->name('home');

    /*
     * Role Controller
     */
    Route::get('role', 'cyrixbiz\acl\Http\Controllers\RoleController@index')->name('role.index');
    Route::get('role/create', 'cyrixbiz\acl\Http\Controllers\RoleController@create')->name('role.create');
    Route::post('role/store', 'cyrixbiz\acl\Http\Controllers\RoleController@store')->name('role.store');
    Route::get('role/show/{id}', 'cyrixbiz\acl\Http\Controllers\RoleController@show')->name('role.show');
    Route::get('role/edit/{id}', 'cyrixbiz\acl\Http\Controllers\RoleController@edit')->name('role.edit');
    Route::post('role/update', 'cyrixbiz\acl\Http\Controllers\RoleController@update')->name('role.update');
    Route::get('role/destroy/{id}', 'cyrixbiz\acl\Http\Controllers\RoleController@destroy')->name('role.destroy');

    /*
     * Resource Controller
     */
    Route::get('resource', 'cyrixbiz\acl\Http\Controllers\ResourceController@index')->name('resource.index');
    Route::get('resource/create', 'cyrixbiz\acl\Http\Controllers\ResourceController@create')->name('resource.create');
    Route::post('resource/store', 'cyrixbiz\acl\Http\Controllers\ResourceController@store')->name('resource.store');
    Route::get('resource/show/{id}', 'cyrixbiz\acl\Http\Controllers\ResourceController@show')->name('resource.show');
    Route::get('resource/edit/{id}', 'cyrixbiz\acl\Http\Controllers\ResourceController@edit')->name('resource.edit');
    Route::post('resource/update', 'cyrixbiz\acl\Http\Controllers\ResourceController@update')->name('resource.update');
    Route::get('resource/destroy/{id}', 'cyrixbiz\acl\Http\Controllers\ResourceController@destroy')->name('resource.destroy');

    /*
     * User Controller
     */
    Route::get('user', 'cyrixbiz\acl\Http\Controllers\UserController@index')->name('user.index');
    Route::get('user/create', 'cyrixbiz\acl\Http\Controllers\UserController@create')->name('user.create');
    Route::post('user/store', 'cyrixbiz\acl\Http\Controllers\UserController@store')->name('user.store');
    Route::get('user/show/{id}', 'cyrixbiz\acl\Http\Controllers\UserController@show')->name('user.show');
    Route::get('user/edit/{id}', 'cyrixbiz\acl\Http\Controllers\UserController@edit')->name('user.edit');
    Route::post('user/update', 'cyrixbiz\acl\Http\Controllers\UserController@update')->name('user.update');
    Route::get('user/destroy/{id}', 'cyrixbiz\acl\Http\Controllers\UserController@destroy')->name('user.destroy');

    /*
     * Acl Controller
     */
    Route::get('acl/getpermissions/{from}/{to}/{id}', 'cyrixbiz\acl\Http\Controllers\AclController@getPermissions')->name('acl.getPermissions');
    Route::post('acl/setpermissions', 'cyrixbiz\acl\Http\Controllers\AclController@setPermissions')->name('acl.setPermissions');
});

