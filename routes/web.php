<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Models\Category;
use App\Models\Photo;

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


// Route::resource('posts','App\Http\Controllers\PostsController');
// Route::get('/',[App\Http\Controllers\PostsController::class,'home'])->name('posts.home');


// elloquent

// 1.read methods

// Route::get('/read', function(){
//    $posts = Post::all();

//    foreach($posts as $post){
//      return  $post->title;
//    }
// });
// 1.read with id

// Route::get('/read', function(){
//    $post = Post::find(2);
//    return $post->title;
// });


// filter

// Route::get('/read', function(){
//    $post = Post::where('id',2)->orderBy('id','desc')->take(1)->get();
//    return $post;
// });



//  create data
Route::get('/create', function(){

  $title = 'new post with eloquent33';
  $body = 'this is body of new post33';
  $user_id = 1;

     Post::create([
    'title' => $title,
    'body' => $body,
    "user_id" => $user_id

    ]);

});

// update
// Route::get('/update', function(){

//   $title = 'Learning laravel';
//   $body =  'Laravel is best web framework';

//   Post::where('id',1)->where('is_admin',0)->update(['title'=> $title,'body'=>$body]);
// });

// simple delete

Route::get('/delete', function(){

    //   $post =  Post::find(1);
    //   $post->delete();

   Post::destroy([2,3,4]);
});

// trashed delete
Route::get('/softdelete', function(){

    Post::find(5)->delete();
});


       // getting access of trashed delete data

    Route::get('/softdeletedata', function()
    {
        // $post =  Post::onlyTrashed()->where('is_admin',0)->get();
        // $post =  Post::withTrashed()->where('id',5)->get();
        // $post =  Post::withTrashed()->where('id',5)->restore();
        $post =  Post::withTrashed()->where('id',5)->forceDelete();
        return  $post;
    });


    // One to relation ship
    // Route::get('/users/{id}/posts', function($id)
    // {
    //     $posts = User::find($id)->post;
    //     return $posts;
    // });


    // Route::get('/posts/{id}/user', function($id)
    // {
    //     $user = Post::find($id)->user;
    //     return $user;
    // });

    // one to many

    Route::get('/user/{id}/posts', function($id)
    {
        $posts = User::find($id)->posts;

        foreach($posts as $post){
             echo $post->title. '<br>';
        }
    });

// many to many
    Route::get('/user/{id}/role', function($id)
    {
        $roles = User::find($id)->roles;

        echo $roles;

    });
    Route::get('/role/{id}/users', function($id)
    {
        $users = Role::find($id)->users;

         foreach($users as $user){
             echo $user->name;
         }

    });


    // Has many through relation ship

   Route::get('/users/country',function(){

       $country = Country::find(1);

           foreach($country->posts as $post){
               return $post->title;
           }
   });

// has many relation
   Route::get('/posts/category',function(){
      $category = Category::find(1);
      echo $category->posts;

   });

// polymorphic relationship
// finding image with User id
Route::get('/user/photos',function(){
     $user = User::find(1);

     foreach($user->photos as $photo){
         echo $photo->path;
     }
});

// polymorphic relationship
// finding image with Post id
Route::get('/post/photos',function(){
     $post = Post::find(2);

     foreach($post->photos as $photo){
         echo $photo->path;
     }
});


// polymorphic relationship
// find the image owner
Route::get('/user/{id}/post',function($id) {
   $photo =  Photo::findOrFail($id);
   return $photo->imageable;
});









