<?php
Route::get('Acl', function(){
    return view('Acl::Acl');
});
Route::post('Acl', function (){
    return true;
})->name('Acl');

Route::middleware(['web' , 'acl'])->group(function () {
    /*
     * Role Controller
     */
    Route::get('role', 'cyrixbiz\acl\controller\RoleController@index')->name('role.index');
    Route::get('role/create', 'cyrixbiz\acl\controller\RoleController@create')->name('role.create');
    Route::post('role/store', 'cyrixbiz\acl\controller\RoleController@store')->name('role.store');
    Route::get('role/show/{id}', 'cyrixbiz\acl\controller\RoleController@show')->name('role.show');
    Route::get('role/edit/{id}', 'cyrixbiz\acl\controller\RoleController@edit')->name('role.edit');
    Route::post('role/update', 'cyrixbiz\acl\controller\RoleController@update')->name('role.update');
    Route::get('role/destroy/{id}', 'cyrixbiz\acl\controller\RoleController@destroy')->name('role.destroy');

    /*
     * Resource Controller
     */
    Route::get('resource', 'cyrixbiz\acl\controller\ResourceController@index')->name('resource.index');
    Route::get('resource/create', 'cyrixbiz\acl\controller\ResourceController@create')->name('resource.create');
    Route::post('resource/store', 'cyrixbiz\acl\controller\ResourceController@store')->name('resource.store');
    Route::get('resource/show/{id}', 'cyrixbiz\acl\controller\ResourceController@show')->name('resource.show');
    Route::get('resource/edit/{id}', 'cyrixbiz\acl\controller\ResourceController@edit')->name('resource.edit');
    Route::post('resource/update', 'cyrixbiz\acl\controller\ResourceController@update')->name('resource.update');
    Route::get('resource/destroy/{id}', 'cyrixbiz\acl\controller\ResourceController@destroy')->name('resource.destroy');

    /*
     * User Controller
     */
    Route::get('user', 'cyrixbiz\acl\controller\UserController@index')->name('user.index');
    Route::get('user/create', 'cyrixbiz\acl\controller\UserController@create')->name('user.create');
    Route::post('user/store', 'cyrixbiz\acl\controller\UserController@store')->name('user.store');
    Route::get('user/show/{id}', 'cyrixbiz\acl\controller\UserController@show')->name('user.show');
    Route::get('user/edit/{id}', 'cyrixbiz\acl\controller\UserController@edit')->name('user.edit');
    Route::post('user/update', 'cyrixbiz\acl\controller\UserController@update')->name('user.update');
    Route::get('user/destroy/{id}', 'cyrixbiz\acl\controller\UserController@destroy')->name('user.destroy');

    /*
     * Acl Controller
     */
    Route::get('acl/getpermissions/{from}/{to}/{id}', 'cyrixbiz\acl\controller\AclController@getPermissions')->name('acl.getPermissions');
    Route::post('acl/setpermissions', 'cyrixbiz\acl\controller\AclController@setPermissions')->name('acl.setPermissions');

    //Route::get('/home');
});

