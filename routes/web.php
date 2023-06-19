<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserAuthController;
use App\Http\controllers\AdminAuthController;
use App\Http\controllers\BlogController;
use App\Http\controllers\UsersController;
use App\Http\controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\HeaderController;
use Laravel\SerializableClosure\SerializableClosure;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   $arrs=['1','5','20','-1'];
   $len=0;
   foreach($arrs as $arr)
   {
    $len=$len+1;

   }
   $max=$arrs[0];
   for($i=1;$i<$len;$i++)
   {
    if($arrs[$i] > $max)
    {
        $max=$arrs[$i];
    }

   }
   dd($max);

 
  
});
Route::get('/login',[UserAuthController::class,'login'])->name('user.login');
Route::post('/login',[UserAuthController::class,'handlelogin'])->name('user.handlelogin');
Route::get('/logout',[UserAuthController::class,'logout'])->name('user.logout');

Route::get('/admin',[AdminAuthController::class,'index'])->name('admin.home')->middleware('auth:webadmin');
Route::get('/admin/login',[AdminAuthController::class,'login'])->name('admin.login');
Route::get('/admin/logout',[AdminAuthController::class,'logout'])->name('admin.logout');

Route::post('admin/login',[AdminAuthController::class,'handlelogin'])->name('admin.handlelogin');

Route::get('addReview',[UserAuthController::class,'addReview']);
Route::post('addReviewPost',[UserAuthController::class,'addReviewPost'])->name('addReviewPost');

Route::get('AdminManageReview',[AdminAuthController::class,'AdminManageReview'])->name('AdminManageReview');
Route::any('userApprove/{id}',[AdminAuthController::class,'userApprove']);
Route::any('userReject/{id}',[AdminAuthController::class,'userReject']);

Route::get('myreview',[UserAuthController::class,'myreview']);
Route::get('items/{id}',[UserAuthController::class,'destroy']);
Route::get('addProduct',[AdminAuthController::class,'addProduct'])->name('admin.addProduct');
Route::post('productpost',[AdminAuthController::class,'productpost']);

Route::get('/blogs/{id}', [BlogController::class, 'index']);

Route::any('event',[BlogController::class, 'event']);

Route::get('sort',function(){
    $data = array('name'=>"Virat Gandhi");
   
    Mail::send('eventMail', $data, function($message) {
       $message->to('pankaj.singh910025@gmail.com', 'Tutorials Point')->subject
          ('Laravel Basic Testing Mail');
       $message->from('pankaj.singh910025@gmail.com','Virat Gandhi');
    });
    echo "Basic Email Sent. you can check it";
    
});
Route::get('/bl/{id}', [BlogController::class, 'bl']);

Route::get('index', [UsersController::class, 'create']);
Route::post('store', [UsersController::class, 'store'])->name('store');

Route::get('/data/load-more', [UsersController::class, 'loadMore'])->name('data.loadMore');

Route::get('services', [UsersController::class, 'myMethod']);
Route::get('edit/{id}', [UsersController::class, 'edit']);

Route::get('/payment', [PaymentController::class,'index']);
Route::post('/payment/process', [PaymentController::class,'processPayment']);
Route::get('jobs', [PaymentController::class,'jobs']);

Route::get('dd',function(){
   ProcessData::dispatch($request->input());
   

});
Route::get('sum',function(){

   $arrs=[1,4,5];
   $len=count($arrs);
   $sum=0;
   foreach($arrs as $arr)
   {
      $sum+= $arr;
   }
   dd($sum);
});

Route::get('max',function(){
   $arrs=[1,5,87,6];
   $len = count($arrs);
   $max=$arrs[0];
   for($i=1;$i<=$len;$i++){
      if($arrs[$i] > $max)
      {
          $max=$arrs[$i];
      }
  dd($max);

   }
});

Route::get('post',[PostController::class,'index']);

// Route::any('/register', [UserController::class, 'register']);
Route::any('/form', [UserController::class, 'form']);

Route::get('/login/facebook', [UserController::class,'redirectToFacebook']);
Route::get('/login/facebook/callback', [UserController::class,'handleFacebookCallback']);

Route::get('curl',function(){
   $curl = curl_init();
$data="hello";
$options = array(
    CURLOPT_POST => true,
    CURLOPT_HEADER => true,
    CURLOPT_URL => "https://example.example.com/api/example.php",
    CURLOPT_FRESH_CONNECT => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FORBID_REUSE => true,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_FAILONERROR => true,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_SSL_VERIFYPEER => false, // REMOVE IN PRODUCTION, IGNORES SELFSIGNED SSL
    CURLOPT_POSTFIELDS => $data // Replace $data with the actual data to be sent in the POST request
);

curl_setopt_array($curl, $options);

$response = curl_exec($curl);

if ($response === false) {
    echo 'cURL error: ' . curl_error($curl);
}

curl_close($curl);

echo $response;

  
});

Route::get('related',[UserController::class,'related']);

Route::get('user/{name}',function($name){

   dd($name);
})->where('name','[a-z A-Z]+'); // Regular expression with url
Route::get('reg/{name}',function($name){
   dd($name);
})->where(['name','[a-z]+']);

Route::get('user/{name?}', function ($name = 'John') {
   return $name;
});  //Optional Route Parameters With Defaults
Route::get('nn', function () {
   $a=3;
   $a='ram';
   $a='ramaaa';
   echo($a);
});  //Optional Route Parameters With Defaults
Route::get('swap', function () {
   $a = 10;
$b = 20;

echo "Before swapping: a = $a, b = $b";

$a = $a ^ $b;
$b = $a ^ $b;
$a = $a ^ $b;

echo "\nAfter swapping: a = $a, b = $b";
});  //Optional Route Parameters With Defaults



Route::get('/users', [UserController::class,'index']);
Route::get('/users/create', 'UserController@create');
Route::post('/users', 'UserController@store');
Route::get('/users/{user}', 'UserController@show');
Route::get('/users/edit/{user}', 'UserController@edit');
Route::put('/users/{user}', 'UserController@update');
Route::patch('/users/{user}', 'UserController@update');
Route::delete('/users/{user}', 'UserController@destroy');


Route::get('/home', 'HomeController@index')->name('home');



Route::get('head', [HeaderController::class, 'showHeader']);
Route::get('addmoney/stripe', [HeaderController::class, 'payWithStripe']);
Route::post('addmoney/stripe', [HeaderController::class, 'postPaymentWithStripe']);

// Route::get('', array('as' => 'addmoney.paywithstripe','uses' => 'AddMoneyController@payWithStripe'));
Route::post('', array('as' => 'addmoney.stripe','uses' => 'AddMoneyController@postPaymentWithStripe'));


