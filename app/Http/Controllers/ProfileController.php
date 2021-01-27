<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
     public function __construct()
    {
         $this->middleware('auth', ['except' => ['index']]);
       //  $this->middleware('auth');

    }
    //
    public function index($id) {
        //View all post created by a single user
        $news = News::where('user_id', $id)->get();
        if(!$news)  return response()->json(['message' => 'Mot record found!', 'status' => false], 404);
        return response()->json(['news' => $news, 'status' => true], 200);     
      }

      public function userNews() {
        $user = Auth::user();
        return $user;
        $news = News::where('user_id', $user)->get();
        if(!$news)  return response()->json(['message' => 'No record found!', 'status' => false], 404);
        return response()->json(['news' => $news, 'status' => true], 200); 

      }
}
