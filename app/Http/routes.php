<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'uses' => 'QuoteController@getSiteIndex',
    'as' => 'public.index'
]);

Route::get('/devis/{quote_id}&{end}', [
    'uses' => 'QuoteController@getSingleQuote',
    'as' => 'public.single'
]);

Route::get('/a-propos', function(){
   return view('frontend.other.about') ;
})->name('about');

Route::get('/contact', [
    'uses' => 'ContactMessageController@getContactIndex',
    'as' => 'contact'
]);

Route::post('/contact/mail', [
   'uses' => 'ContactMessageController@postSendMessage',
   'as' => 'contact.send'
]);

Route::get('/admin/connexion', [
    'uses' => 'AdminController@getLogin',
    'as' => 'admin.login'
]);

Route::post('/admin/connexion', [
    'uses' => 'AdminController@postLogin',
    'as' => 'admin.login'
]);

Route::group([
    'prefix' => '/admin',
    'middleware' => 'auth'
    ], function(){
       Route::get('/', [
           'uses' => 'AdminController@getIndex',
           'as' => 'admin.index'
        ]);
        
        Route::get('/deconnexion', [
            'uses' => 'AdminController@getLogout',
            'as' => 'admin.logout'
        ]);
        
        Route::get('/devis', [
            'uses' => 'QuoteController@getQuoteIndex',
            'as' => 'admin.quotes.index'
        ]);
        
        Route::get('/devis/client/{customer_name}', [
           'uses' => 'QuoteController@getQuotesForCustomer', 
           'as' => 'admin.quotes.customer'
        ]);
        
        Route::get('/categories', [
           'uses' => 'CategoryController@getCategoryIndex',
           'as' => 'admin.quotes.categories'
        ]);
        
        Route::get('/devis/{quote_id}&{end}', [
           'uses' => 'QuoteController@getSingleQuote',
           'as' => 'admin.quotes.quote'
        ]);
        
        Route::get('/devis/creer', [
           'uses' => 'QuoteController@getCreateQuote',
           'as' => 'admin.quote.create_quote'
        ]);
        
        Route::post('/admin/devis/creer', [
            'uses' => 'QuoteController@postCreateQuote',
            'as' => 'admin.quotes.create'
        ]);
        
        Route::post('/categorie/creer', [
           'uses' => 'CategoryController@postCreateCategory',
           'as' => 'admin.category.create'
        ]);
        
        Route::post('/categorie/maj', [
           'uses' => 'CategoryController@postUpdateCategory',
           'as' => 'admin.category.update'
        ]);
        
        Route::get('/categorie/{category_id}/supprimer', [
           'uses' => 'CategoryController@getDeleteCategory',
           'as' => 'admin.category.delete'
        ]);
        
        Route::get('/devis/{quote_id}/editer', [
           'uses' => 'QuoteController@getUpdateQuote',
           'as' => 'admin.quote.edit'
        ]);
        
        Route::post('/devis/maj', [
           'uses' => 'QuoteController@postUpdateQuote',
           'as' => 'admin.quote.update'
        ]);
        
        Route::get('/devis/{quote_id}/supprimer', [
           'uses' => 'QuoteController@getDeleteQuote',
           'as' => 'admin.quote.delete'
        ]);
        
        Route::get('/contact/messages', [
            'uses' => 'ContactMessageController@getContactMessageIndex',
            'as' => 'admin.contact.index'
        ]);
        
        Route::get('/contact/message/{message_id}/supprimer', [
           'uses' => 'ContactMessageController@getDeleteMessage',
           'as' => 'admin.contact.delete'
        ]);
    });