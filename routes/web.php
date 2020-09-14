<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
    'as' => 'admin.',
	'middleware' => ['auth']
	],
	function(){
		Route::get('/',['as' => 'home','uses' => 'Departments@index']); 
		
		Route::get('/Departments/',['as' => 'Departments.index','uses' => 'Departments@index']); 
		Route::get('/Departments/add',['as' => 'Departments.addPage','uses' => 'Departments@addForm']); 
		Route::post('/Departments/add',['as' => 'Departments.add','uses' => 'Departments@add']); 
		Route::get('/Departments/{idDepartment}/edit',['as' => 'Departments.editForm','uses' => 'Departments@editForm']); 
		Route::post('/Departments/{idDepartment}/edit',['as' => 'Departments.edit','uses' => 'Departments@edit']); 
		Route::get('/Departments/{idDepartment}/delete',['as' => 'Departments.delete','uses' => 'Departments@delete']);

		// USERS
		Route::get('/Users/',['as' => 'Users.index','uses' => 'Users@index']);
		Route::get('/Users/add',['as' => 'Users.addForm','uses' => 'Users@addForm']); 
		Route::post('/Users/add',['as' => 'Users.add','uses' => 'Users@add']);  
		Route::get('/Users/{idUser}/edit',['as' => 'Users.editForm','uses' => 'Users@editForm']); 
		Route::post('/Users/{idUser}/edit',['as' => 'Users.edit','uses' => 'Users@edit']);  
		Route::post('/Users/delete',['as' => 'Users.delete','uses' => 'Users@UserDelete']);	
		// USERS AJAX 
		Route::get('/Users/AjaxGetList',['as' => 'Users.index.AjaxGetList','uses' => 'Users@AjaxGetList']); 
		Route::post('/Users/getUserInfo',['as' => 'Users.getUserInfo','uses' => 'Users@getUserInfo']); 
		
		// Departments
		Route::get('/Departments/',['as' => 'Departments.index','uses' => 'Departments@index']);
		Route::get('/Departments/add',['as' => 'Departments.addForm','uses' => 'Departments@addForm']); 
		Route::post('/Departments/add',['as' => 'Departments.add','uses' => 'Departments@add']);  
		Route::get('/Departments/{idDepartment}/edit',['as' => 'Departments.editForm','uses' => 'Departments@editForm']); 
		Route::post('/Departments/{idDepartment}/edit',['as' => 'Departments.edit','uses' => 'Departments@edit']);  
		Route::post('/Departments/delete',['as' => 'Departments.delete','uses' => 'Departments@DepartmentDelete']);	
		// Departments AJAX 
		Route::post('/Departments/AjaxGetDepartmentUser',['as' => 'Departments.index.AjaxGetDepartmentUser','uses' => 'Departments@AjaxGetDepartmentUser']); 
		Route::get('/Departments/AjaxGetList',['as' => 'Departments.index.AjaxGetList','uses' => 'Departments@AjaxGetList']); 
		Route::post('/Departments/getDepartmentInfo',['as' => 'Departments.getDepartmentInfo','uses' => 'Departments@getDepartmentInfo']);  
		
	}
);

Route::get('/', ['middleware' => ['auth'], 'as' => 'Users.index','uses' => 'App\Http\Controllers\Admin\Users@index']); 
Route::get('/home', ['middleware' => ['auth'], 'as' => 'Users.index','uses' => 'App\Http\Controllers\Admin\Users@index']); 

