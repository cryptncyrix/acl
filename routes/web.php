<?php
Route::get('Acl', function(){
    return view('Acl::Acl');
});
Route::post('Acl', function (){
    return true;
})->name('Acl');
?>