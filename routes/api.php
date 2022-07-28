<?php


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    

});


//Employee
Route::apiResource('/employee','Api\EmployeeController');

//Supplier
Route::apiResource('/supplier','Api\SupplierController');


//Category
Route::apiResource('/category','Api\CategoryController');


//Product
Route::apiResource('/product','Api\ProductController');

//Expense
Route::apiResource('/expense','Api\ExpenseController');


//Salary
Route::Post('/salary/paid/{id}','Api\SalaryController@Paid');

Route::Get('/salary','Api\SalaryController@AllSalary');

Route::Get('/salary/view/{id}','Api\SalaryController@ViewSalary');

Route::Get('/edit/salary/{id}','Api\SalaryController@EditSalary');

Route::Post('/salary/update/{id}','Api\SalaryController@UpdateSalary');


//Stock Update
Route::Post('/stock/update/{id}','Api\ProductController@StockUpdate');



//Customer
Route::apiResource('/customer','Api\CustomerController');


//POS
Route::apiResource('/pos','Api\PosController');



//SubProduct Getting
Route::Get('/getting/product/{id}','Api\PosController@GetProduct');



//Add To Cart Route
Route::Get('/addToCart/{id}','Api\CartController@AddToCart');
Route::Get('/cart/product/','Api\CartController@CartProduct');
Route::Get('/remove/cart/{id}','Api\CartController@RemoveCart');

Route::Get('/increment/{id}','Api\CartController@Increment');
Route::Get('/decrement/{id}','Api\CartController@Decrement');


//Add Vat
Route::Get('/vat','Api\CartController@Vats');

//Add Vat
Route::Post('/orderdone','Api\PosController@OrderDone');


//Order Route
Route::Get('/orders','Api\OrderController@TodayOrder');

Route::Get('/order/details/{id}','Api\OrderController@OrderDetails');
Route::Get('/order/orderdetails/{id}','Api\OrderController@OrderDetailsAll');

//Search data by date
Route::Post('/search/order/','Api\PosController@SearchOrderDate');


//Admin Dashboard Route
Route::Get('/today/sell/','Api\PosController@TodaySell');

Route::Get('/today/income/','Api\PosController@TodayIncome');

Route::Get('/today/due/','Api\PosController@TodayDue');

Route::Get('/today/expense/','Api\PosController@TodayExpense');

Route::Get('/today/stockout/','Api\PosController@TodayStockout');
