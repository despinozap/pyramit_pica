<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
*	P U B L I C
*/

Route::get(
			'/',
			[
				'uses'	=>	'FrontController@home',
				'as'	=>	'front.home'
			]
);

Route::get(
			'/sig',
			[
				'uses'	=>	'FrontController@sig',
				'as'	=>	'front.sig'
			]
);

Route::get(
			'/project',
			[
				'uses'	=>	'FrontController@project',
				'as'	=>	'front.project'
			]
);

Route::get(
			'/gallery',
			[
				'uses'	=>	'FrontController@gallery',
				'as'	=>	'front.gallery'
			]
);

Route::get(
			'/repository',
			[
				'uses'	=>	'FrontController@repository',
				'as'	=>	'front.repository'
			]
);

Route::get(
			'/news',
			[
				'uses'	=>	'FrontController@news',
				'as'	=>	'front.news'
			]
);

Route::get(
			'/news/{id}',
			[
				'uses'	=>	'FrontController@showArticle',
				'as'	=>	'front.article'
			]
);

Route::post(
			'/article',
			[
				'uses'	=>	'FrontController@addCommentToArticle',
				'as'	=>	'front.commentArticle'
			]
);


Route::get(
			'/contact',
			[
				'uses'	=>	'FrontController@contact',
				'as'	=>	'front.contact'
			]
);

Route::post(
			'/contact/sendmail',
			[
				'uses'	=>	'FrontController@sendEmail',
				'as'	=>	'front.sendmail'
			]
);

Route::post(
			'/gallery/downloadZipAlbum',
			[
				'uses'	=>	'FrontController@downloadZipAlbum',
				'as'	=>	'front.downloadZipAlbum'
			]
);

Route::get(
			'/blocked',
			[
				'as'	=>	'front.blocked',
				function()
				{
					return view('front.blocked');
				}
			]
);


/*
*		A D M I N
*/

Route::group(['prefix' => 'panel', 'middleware' => ['auth', 'accesspermission']], function()
{
	Route::get(
				'/',
				[
					'uses' => 'FrontController@admin',
					'as' => 'panel.index'
				]
	);

	Route::get(
				'401',
				[
					'as' => 'panel.401',
					function()
					{
						return view('admin.401');
					}
				]
	);

	Route::get(
				'videos',
				[
					'as' => 'panel.videos',
					function()
					{
						return view('admin.videos');
					}
				]
	);

	Route::resource('categories', 'CategoriesController');

	Route::post(
				'categories/destroy',
				[
					'uses' => 'CategoriesController@destroy',
					'as' => 'categories.destroy'
				]
	);


	Route::resource('articles', 'ArticlesController');

	Route::post(
				'articles/destroy',
				[
					'uses' => 'ArticlesController@destroy',
					'as' => 'articles.destroy'
				]
	);

	Route::get(
				'articles/{id}/comments',
				[
					'uses' => 'ArticlesController@comments',
					'as' => 'articles.comments'
				]
	);

	Route::post(
				'articles/comments/destroy',
				[
					'uses' => 'ArticlesController@removeComment',
					'as' => 'articles.comments.destroy'
				]
	);

	Route::get(
				'comments',
				[
					'uses' => 'CommentsController@index',
					'as' => 'comments.index'
				]
	);

	Route::post(
				'comments',
				[
					'uses' => 'CommentsController@check',
					'as' => 'comments.check'
				]
	);

	Route::get(
				'comments/{id}',
				[
					'uses' => 'CommentsController@show',
					'as' => 'comments.show'
				]
	);

	Route::resource('documents', 'DocumentsController');

	Route::post(
				'documents/destroy',
				[
					'uses' => 'DocumentsController@destroy',
					'as' => 'documents.destroy'
				]
	);

	Route::resource('albums', 'AlbumsController');

	Route::post(
				'albums/destroy',
				[
					'uses' => 'AlbumsController@destroy',
					'as' => 'albums.destroy'
				]
	);

	Route::post(
				'albums/{id}/photoUpload',
				[
					'uses'	=>	'AlbumsController@photoUpload',
					'as'	=>	'albums.photoupload'
				]
	);

	Route::post(
				'albums/photoDestroy',
				[
					'uses'	=>	'AlbumsController@photoDestroy',
					'as'	=>	'albums.photodestroy'
				]
	);

	Route::resource('wells', 'WellsController');

	Route::post(
				'wells/destroy',
				[
					'uses' => 'WellsController@destroy',
					'as' => 'wells.destroy'
				]
	);

	Route::resource('users', 'UsersController');

	Route::post(
				'users/destroy',
				[
					'uses' => 'UsersController@destroy',
					'as' => 'users.destroy'
				]
	);

	Route::post(
				'users/changeState',
				[
					'uses' => 'UsersController@changeState',
					'as' => 'users.changeState'
				]
	);

	Route::get(
				'changePassword',
				[
					'as' => 'panel.changePassword',
					function()
					{
						return view('admin.changePassword');
					}
				]
	);

	Route::post(
				'changePassword',
				[
					'uses' => 'UsersController@changePassword',
					'as' => 'users.changePassword'
				]
	);

	Route::get(
				'configuration/contact',
				[
					'uses' => 'ConfigurationController@contact',
					'as' => 'configuration.contact'
				]
	);

	Route::put(
				'configuration/contact/{id}',
				[
					'uses' => 'ConfigurationController@updateContact',
					'as' => 'configuration.updateContact'
				]
	);

	Route::get(
				'configuration/logos',
				[
					'uses' => 'ConfigurationController@logos',
					'as' => 'configuration.logos'
				]
	);

	Route::put(
				'configuration/logos/{id}',
				[
					'uses' => 'ConfigurationController@updateLogo',
					'as' => 'configuration.updateLogo'
				]
	);

});


Auth::routes();
