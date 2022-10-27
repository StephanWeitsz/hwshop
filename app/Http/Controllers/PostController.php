<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$posts = auth()->user()->posts()->paginate(5);
        $posts = auth()->user()->posts;
        return view('admin.posts.index', ['posts'=> $posts]);
    }

    public function all() {
        $posts = Post::all();
        return view('admin.posts.index', ['posts'=> $posts]);
    }

    public function create() {
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    public function store(Request $request) {
        $this->authorize('create', Post::class);
        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required'
        ]);

        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);
        Session::flash('post_create_message','Post with title was created : ' . $inputs['title']);
        return redirect()->route('post.index');
    }

    public function show(Post $post) {
        return view('post', ['post'=>$post]);
    }

    public function edit(Post $post) {
        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post'=> $post]);
    }

    public function update(Post $post) {
        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required'
        ]);

        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);
        $post->save();

        Session::flash('post_update_message','Post ' . $post->id . ' updated');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post) {

        $this->authorize('delete', $post);

        $post->delete();
        Session::flash('post_delete_message','Post ' . $post->id . ' was deleted');
        return back();
    }
}