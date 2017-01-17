<?php

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('/', 'HomeController@index');
$this->get('home', 'HomeController@index');
$this->post('posts/{post}/like', 'PostsController@like')->name('posts.like');
$this->resource('posts', 'PostsController');