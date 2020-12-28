<?php
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('item','Itemscontroller');
// Route::get('/item','Itemscontroller@create');
// Route::post('/item','Itemscontroller@store');
// Route::get('/index','Itemscontroller@index');
// Route::get('/store/{id}','Itemscontroller@show');

// Route::resource('item','Itemscontroller');

Route::get('/',[ProductController::class,"index"])->name("product.index");



Route::post("/product",[ProductController::class,'store'])->name("product.store");


Route::get("/productget/{id}",[ProductController::class,'getdata'])->name("product.getdata");

//productin route
Route::get("/productin",[ProductController::class,'productinview'])->name("productin.view");

Route::post("/productin",[ProductController::class,'productinstore'])->name("productin.store");

Route::get('/productinlist',[ProductController::class,"productinlist"])->name("productin.list");



Route::get("/productin/edit/{id}",[ProductController::class,"productinedit"])->name("productin.edit");

Route::put("/productin/update/{id}",[ProductController::class,"productinupdate"])->name("productin.update");

Route::delete("/productin/delete/{id}",[ProductController::class,"productindelete"])->name("productin.delete");

//productout route

Route::get("/productout",[ProductController::class,'productoutview'])->name("productout.view");

Route::post("/productout",[ProductController::class,'productoutstore'])->name("productout.store");

Route::get('/productoutlist',[ProductController::class,"productoutlist"])->name("productout.list");

Route::get("productout/edit/{id}",[ProductController::class,"productoutedit"])->name("productout.edit");

Route::put("productout/update/{id}",[ProductController::class,"productoutupdate"])->name("productout.update");

Route::delete("productout/delete/{id}",[ProductController::class,"productoutdelete"])->name("productout.delete");

//route for available list

Route::get('/productavailable',[ProductController::class,"available"])->name("product.available");


Route::get('/product/excessquantity/{id}',[ProductController::class,"excessquantity"])->name("product.excessquantity");

Route::get("/product/search/",[ProductController::class,"searchdata"])->name("product.search");

Route::get("/productin/search",[ProductController::class,"searchproductindata"])->name("productin.search");