<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use  \App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});





Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password',
    ];

    if (!Auth::attempt($credentials)) {
        $user = new User();

        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);

        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $tokenAbilities = ['create', 'update', 'delete'];

            $adminToken = $user->createToken('admin-token', $tokenAbilities);
            $updateToken = $user->createToken('update-token', $tokenAbilities);
            $basicToken = $user->createToken('basic-token');

            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken,
            ];
        }
    }
});


// Route::get('/setup',function(){
//     $credentials=[
//      'email'=>'admin@admin.com',
//      'password' => 'password',
//     ];

//     if(!Auth::attempt($credentials)){
//      $user=new User();

//      $user->name='Admin';
//      $user->email = $credentials['email'];
//      $user->password = Hash::make($credentials['password']);

//      $user.save();

//      if(Auth::attempt($credentials)){
//          $user = Auth::user();

//          $adminToken=$user->createToken('admin-token',['create','update','delete']);
//          $updateToken=$user->createToken('update-token',['create','update']);
//          $basicToken=$user->createToken('basic-token');


//          return [
//              'admin'=>$adminToken.plainTextToken,
//              'update'=>$updateToken.plainTextToken,
//              'basic'=>$basicToken.plainTextToken,
//          ];
//      }
//     }
//  });
