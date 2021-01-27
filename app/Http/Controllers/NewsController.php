<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
       //  $this->middleware('auth', ['except' => ['index']]);
       //  $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $news = News::all();
        return response()->json(['news' => $news, 'status' => true], 200);   
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'title' => 'required|string',
            'body' => 'required|string',
            'imgURL' => 'required|string',
        ]);

           $user = Auth::user()->id;
        try {
            $news = new News;
            $news->title = $request->input('title');
            $news->body = $request->input('body');
            $news->imgURL = $request->input('imgURL');
            $news->user_id = $user;
            $news->save();
            //return successful response
            return response()->json(['news' => $news, 'message' => 'News created successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'News Registration Failed!', 'status' => false], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $news = News::find($id);
        if(!$news)  return response()->json(['message' => 'Mot record found!', 'status' => false], 404);
        return response()->json(['news' => $news, 'status' => true], 200);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // not user full/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //validate incoming request 
        $this->validate($request, [
            'title' => 'required|string',
            'body' => 'required|string',
            'imgURL' => 'required|string',
        ]);

        try {
            $news =  News::find($id);
            $news->title = $request->input('title');
            $news->body = $request->input('body');
            $news->imgURL = $request->input('imgURL');
            $news->save();
            //return successful response
            return response()->json(['news' => $news, 'message' => 'News upda successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'News Registration Failed!', 'status' => false], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news =  news::find($id);
        if(!$news)  {
            return response()->json(['message' => 'Mot record found!', 'status' => false], 404);
        }
        $news->delete();
        return response()->json(['news' => $news, 'message'=> 'News deleted successfully', 'status' => true], 200);   

    }
}
