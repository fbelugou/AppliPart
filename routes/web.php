<?php

Route::get('/', ['as' => 'home', function(){
  return view('welcome');
}]);

Route::get('contact',[])
Route::post('contact',['uses'=>'GestionController'])
