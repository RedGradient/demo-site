<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Rubric;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // значения по-умолчанию
        $sort = 'created_at';
        $order = 'desc';
        $posts = Post::orderBy($sort, $order)->paginate(6);

        // если в GET-запросе есть ключи
        if ($request->all()) {
            // если есть ключ filter
            if ($rubric = $request->get('rubric')) {
                print_r($request->all());
                $rubric_id = Rubric::where('title', '=', $rubric)->id;
                print_r($rubric_id);
                switch ($request->get('order')) {
                    case 'desc':
                        $order = 'desc';
                        break;
                    case 'asc':
                        $order = 'asc';
                        break;
                }
                switch ($request->get('sort')) {
                    case 'date':
                        $sort = 'created_at';
                        $posts = Post::where('rubric_id', '=', $rubric_id)->orderBy($sort, $order)->paginate(6);
                        break;
                    case 'popularity':
                        $posts = Post::where('rubric_id', '=', $rubric_id)->withCount('likes')->orderBy('likes_count', $order)->paginate(6);
                        break;
                }
            // если ключа filter нет
            } else {
                switch ($request->get('order')) {
                    case 'desc':
                        $order = 'desc';
                        break;
                    case 'asc':
                        $order = 'asc';
                        break;
                }

                switch ($request->get('sort')) {
                    case 'date':
                        $sort = 'created_at';
                        $posts = Post::orderBy($sort, $order)->paginate(6);
                        break;
                    case 'popularity':
                        $posts = Post::withCount('likes')->orderBy('likes_count', $order)->paginate(6);
                        break;
                }

                $posts = Post::orderBy($sort, $order)->paginate(6);
            }
        }


        $like_class = Like::class;


        return view('post_list', [
            'posts' => $posts,
            '$like_class' => $like_class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rubrics = Rubric::all();
        return view('post_create_form', ['rubrics' => $rubrics]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $description = $request->input('description');
        $rubric = $request->input('rubric');

        $post = new Post;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $name = strval(Auth::user()->id).date('DdMYHis').".".$ext;
            $path = '/var/www/public/images/';
            $image->move($path, $name);

            $post->image = $name;
        }

        $post->title = $title;
        $post->description = $description;
        $post->body = $body;

        $post->user_id = Auth::user()->id;
        $post->rubric_id = $rubric;

        $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $post = Post::find($id);
        $author = User::find(Post::find($id)->user_id)->name;
        $likes = Like::where('post_id', '=', $post->id)->count();
        $rubric = Rubric::where('post_id', '=', $post->id);

        return view('post_detailed', [
            'post' => $post,
            'author' => $author,
            'rubric' => $rubric,
            'likes' => $likes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $rubrics = Rubric::all();
        return view('post_edit_form', [
            'post' => $post,
            'rubrics' => $rubrics
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $description = $request->input('description');
        $rubric = $request->input('rubric');

        $post = Post::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $name = strval(Auth::user()->id).date('DdMYHis').".".$ext;
            $path = '/var/www/public/images/';
            $image->move($path, $name);

            $post->image = $name;
        }

        $post->title = $title;
        $post->description = $description;
        $post->body = $body;

        $post->user_id = Auth::user()->id;
        $post->rubric_id = $rubric;

        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        dd($id);
        $post = Post::find($id);
        $post->delete();
    }
}
