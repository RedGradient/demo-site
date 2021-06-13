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
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    public function like(Request $request) {

        $user_id = Auth::user()->id;
        $post_id = $request->get('post_id');

        $like = new Like;
        $like->user_id = $user_id;
        $like->post_id = $post_id;
        $like->save();
    }

    public function unlike(Request $request) {
        $user_id = Auth::user()->id;
        $post_id = $request->get('post_id');

        Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->delete();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // значения по-умолчанию, на случай, если в GET-ключей нет
        $sort = 'created_at';
        $order = 'desc';
        $posts = Post::orderBy($sort, $order)->paginate(6);

        // если в GET-запросе есть ключи
        if ($request->all()) {
            // если есть ключ rubric
            if ($request->get('rubric')) {
                $rubric = $request->get('rubric');
                $rubric_id = Rubric::where('title', '=', $rubric)->first()->id;
                // если кроме rubric есть правила сортировки
                if ($request->get('sort') && $request->get('order')) {
                    $order = $request->get('order');
                    switch ($request->get('sort')) {
                        case 'date':
                            $sort = 'created_at';
                            $posts = Post::where('rubric_id', '=', $rubric_id)->orderBy($sort, $order)->paginate(6);
                            break;
                        case 'popularity':
                            $posts = Post::where('rubric_id', '=', $rubric_id)->withCount('likes')->orderBy('likes_count', $order)->paginate(6);
                            break;
                    }
                // если правил сортировки нет
                } else {
                    $posts = Post::where('rubric_id', '=', $rubric_id)->orderBy('created_at', 'desc')->paginate(6);
                }
            // если ключа rubric нет
            } else {
                $order = $request->get('order');
                switch ($request->get('sort')) {
                    case 'date':
                        $sort = 'created_at';
                        $posts = Post::orderBy($sort, $order)->paginate(6);
                        break;
                    case 'popularity':
                        $posts = Post::withCount('likes')->orderBy('likes_count', $order)->paginate(6);
                        break;
                }
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
        return redirect()->route('home');
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
//        try {
//            $user_id = Auth::user()->id;
//        } catch (e) {
//            $user_id = null;
//        }

        return view('post_detailed', [
//            'user_id' => $user_id,
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

        $post->update();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // удаление картинки
        $path = '/var/www/public/images/'.$post->image;
        File::delete($path);

        $post->delete();
        return redirect()->route('home');
    }
}
