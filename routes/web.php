<?php
Route::get('Acl', function(){
    return view('Acl::Acl');
});
Route::post('Acl', function (){
    return true;
})->name('Acl');

Route::middleware(['web' , 'acl'])->group(function () {
    Route::get('Role', 'cyrixbiz\acl\controller\RoleController@index')->name('Role');
    //Route::get('/home');
});

