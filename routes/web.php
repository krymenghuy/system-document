<?php
// use App\Http\Controllers\FrontendS\AuthController;
use Illuminate\Support\Facades\Route;
// use app/Http/Controllers/frontend/AuthController.php;
Route::group(['prefix' => '/admin'], function () {
    Auth::routes(['register' => true, 'logout' => 'false']);
    Route::post('/logout', 'App\Http\Controllers\Auth\LogoutController@index')->name('logout');
});
// backend or admin
Route::group(['namespace' => 'App\Http\controllers\Backends', 'prefix' => '/admin'], function () {

    Route::get('/', 'HomeController@index')->name('admin.home');

    Route::get('/documents', 'DocumentController@index')->name('admin.documents');
    Route::get('/documents/create', 'DocumentController@create')->name('admin.documents.create');
    Route::post('/documents/store', 'DocumentController@store')->name('admin.documents.store');
    Route::get('/documents/{document_id}/show', 'DocumentController@show')->name('admin.documents.show');
    Route::get('/documents/{document_id}/edit', 'DocumentController@edit')->name('admin.documents.edit');
    Route::post('/documents/{document_id}/update', 'DocumentController@update')->name('admin.documents.update');
    Route::get('/documents/{document_id}/delete', 'DocumentController@delete')->name('admin.documents.delete');
    Route::delete('/documents/{document_id}/delete', 'DocumentController@destroy')->name('admin.documents.destroy');
    Route::get('/documents/{document_id}/download', 'DocumentController@download')->name('admin.documents.download');
    Route::post('/documents/{document_id}/evaluations', 'DocumentController@evaluations')->name('admin.documents.evaluations');

    Route::get('/document-category', 'DocumentCategoryController@index')->name('admin.document_category');
    Route::get('/document-category/create', 'DocumentCategoryController@create')->name('admin.document_category.create');
    Route::post('/document-category/store', 'DocumentCategoryController@store')->name('admin.document_category.store');
    Route::get('/document-category/{document_category_id}/edit', 'DocumentCategoryController@edit')->name('admin.document_category.edit');
    Route::post('/document-category/{document_category_id}/update', 'DocumentCategoryController@update')->name('admin.document_category.update');
    Route::get('/document-category/{document_category_id}/delete', 'DocumentCategoryController@delete')->name('admin.document_category.delete');

    // role
    Route::get('/role', 'RoleController@index')->name('admin.role');
    Route::get('/role/{role_id}/edit', 'RoleController@edit')->name('admin.role.edit');
    Route::post('/role/{role_id}/update', 'RoleController@update')->name('admin.role.update');
    Route::get('/role/{role_id}/delete', 'RoleController@delete')->name('admin.role.delete');
    Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
    Route::post('/role/store', 'RoleController@store')->name('admin.role.store');

    //user
    Route::get('/user', 'UserController@index')->name('admin.user');
    Route::get('/user/{user_id}/edit', 'UserController@edit')->name('admin.user.edit');
    Route::post('/user/{user_id}/update', 'UserController@update')->name('admin.user.update');
    Route::get('/user/{user_id}/delete', 'UserController@delete')->name('admin.user.delete');
    Route::get('/user/create', 'UserController@create')->name('admin.user.create');
    Route::post('/user/store', 'UserController@store')->name('admin.user.store');

    // role permission
    Route::get('/role/{role_id}/permission', 'RoleController@permission')->name('admin.role.permission');
    Route::get('/role/{role_id}/permission/update', 'RoleController@updatePermission')->name('admin.role.permission.update');


    // permission
    Route::get('permission', 'PermissionController@index')->name('admin.permission');
    Route::get('permission/create', 'PermissionController@create')->name('admin.permission.create');
    Route::post('permission/store', 'PermissionController@store')->name('admin.permission.store');
    Route::get('permission/{permission_id}/edit', 'PermissionController@edit')->name('admin.permission.edit');
    Route::post('permission/{permission_id}/update', 'PermissionController@update')->name('admin.permission.update');
    Route::get('permission/{permission_id}/delete', 'PermissionController@delete')->name('admin.permission.delete');
    Route::get('permission/{permission_id}/download', 'PermissionController@download')->name('admin.permission.download');


    // Route::post('/document/category/{document_category_id}/upload', 'documentCategoryController@uploadFile')->name('admin.document_category.(upload.file)');
    // Route::post('upload', [FileUploadController::class, 'uploadFile'])->name('upload.file');

    Route::get('/admin.no_permission', function () {
        return view('backends.no_permission');
    })->name('admin.no_permission');

      // company
      Route::get('/company','CompanyController@index')->name('admin.company');
      Route::get('/company/edit','CompanyController@edit')->name('admin.company.edit');
      Route::post('/company/update','CompanyController@update')->name('admin.company.update');
  

});

// frontend
Route::group(['namespace' => 'App\Http\controllers\Frontends'], function () {

    Route::get('/', 'HomeController@index')->name('user.name');
    // auth
    route::post('/user/auth/login', 'AuthController@login')->name('user.auth.login');
    route::post('/user/auth/login', 'AuthController@login')->name('user.auth.login');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

route::fallback(function () {
    return redirect()->route('admin.home');
});
