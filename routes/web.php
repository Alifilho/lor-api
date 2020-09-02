<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->group(function () {
  Route::get('keywords', 'KeywordController@index');
  Route::get('keywords/{id}', 'KeywordController@show');
  Route::post('keywords', 'KeywordController@store');
  Route::put('keywords/{id}', 'KeywordController@update');
  Route::delete('keywords', 'KeywordController@destroy');

  Route::get('followers', 'FollowerController@index');
  Route::get('followers/{id}', 'FollowerController@show');
  Route::post('followers', 'FollowerController@store');
  Route::put('followers/{id}', 'FollowerController@update');
  Route::delete('followers', 'FollowerController@destroy');

  Route::get('spells', 'SpellController@index');
  Route::get('spells/{id}', 'SpellController@show');
  Route::post('spells', 'SpellController@store');
  Route::put('spells/{id}', 'SpellController@update');
  Route::delete('spells', 'SpellController@destroy');

  Route::get('champions', 'ChampionController@index');
  Route::get('champions/{id}', 'ChampionController@show');
  Route::post('champions', 'ChampionController@store');
  Route::put('champions/{id}', 'ChampionController@update');
  Route::delete('champions', 'ChampionController@destroy');
});
