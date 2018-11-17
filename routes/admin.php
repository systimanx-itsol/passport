<?php

use Illuminate\Http\Request;




 Route::group(['middleware'=>'auth'],function(){
   Route::get('/home', 'HomeController@admin_home');

   Route::Resource('feedback','FeedbackController');

 });
