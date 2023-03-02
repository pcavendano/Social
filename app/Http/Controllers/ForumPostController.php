<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\PDF;
//use PDF;

class ForumPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = ForumPost::all();
        return view('forum.index', ['forums'=>$forums]);
        //return $forums[0]->title;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$category =  new Category;
        //$category = $category->selectCategory();

        $category =  Category::selectCategory();

       // return  $category;

        return view('forum.create', ['categories' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            //insert -> lastid  => select where lastId
            $newPost = ForumPost::create([
                'title' => $request->title,
                'body'  => $request->body,
                'user_id' => Auth::user()->id,
                'categorys_id' => $request->categorys_id
            ]);

            return redirect(route('forum.show', $newPost->id));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function show(ForumPost $forumPost)
    {
           //select * from forum_posts where id = $forumPost"
        return view('forum.show', ['forumPost' => $forumPost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumPost $forumPost)
    {
        $category =  Category::selectCategory();

        return view('forum.edit', ['forumPost' => $forumPost,
                                'categories' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ForumPost $forumPost)
    {
        //update where vPost->id  => select where forumPost->id
        $forumPost->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect(route('forum.show', $forumPost->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ForumPost  $forumPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(ForumPost $forumPost)
    {
        $forumPost->delete();

        return redirect(route('forum.index'));
    }

    public function query(){
        // select * FROM forum_posts;
       //  $query = forumPost::all();

      // $query = ForumPost::select()->get();
       //$query = ForumPost::select('title', 'body')->get();

       //WHERE
       /*$query = ForumPost::select()
                ->where('id', '=',1)
                ->get();
        return $query[0]->title;
        */

        // WHERE PK
        //SELECT  * from forum_posts where id = ?;
       //$query = ForumPost::find(1);

       //return $query->title;

       //AND
       //SELECT  * from forum_posts where user_id = ? AND title = ?;
        $query = ForumPost::Select()
                ->where('user_id', '=', 1)
                ->where('title', '=', 'Title 1')
                ->get();


        //OR
       //SELECT  * from forum_posts where user_id = ? OR title = ?;
       $query = ForumPost::Select()
       ->where('user_id', '=', 2)
       ->orWhere('title', '=', 'Title 1')
       ->get();

       //ORDER BY
        //SELECT  * from forum_posts ORDER BY title;
        $query = ForumPost::Select()
        //->where("user_id", ">", 2)
        ->orderBy('title', 'desc')
        ->get();

        //INNER
        //SELECT * FROM forum_posts INNER JOIN users ON user_id = users.id;
        $query = ForumPost::select()
                ->join('users', 'users.id', '=', 'user_id')
                ->get();

          //OUTER
        //SELECT * FROM forum_posts RIGHT OUTER JOIN users ON user_id = users.id;
        $query = ForumPost::select()
                ->rightjoin('users', 'users.id', '=', 'user_id')
                ->get();

        //aggregation

        //$query = ForumPost::max('id');
        $query = ForumPost::select()
                ->count();



        // Raw Query
        // SELECT count(*) as forums, user_id  * FROM forum_posts group by user_id;
        $query = ForumPost::select(DB::raw('count(*) as forums, user_id '))
        ->groupBy('user_id')
        ->get();


        return $query;

    }

    public function page(){
        $forumPosts = ForumPost::select()
                ->paginate(5);

                return view('forum.page', ['forumPosts' => $forumPosts]);
    }

    public function pdf(ForumPost $forumPost){
        //return $forumPost;

        $pdf = PDF::loadView('forum.show-pdf', ['forumPost' => $forumPost]);
        return $pdf->download('forumABC.pdf');
        //return $pdf->stream('forumABC.pdf');
    }
}


