<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
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
        $products = Product::all();
        $this->authorize('create', Post::class);
        return view('admin.posts.create', ['products'=>$products]);
    }

    public function store(Request $request) {
        $this->authorize('create', Post::class);
        $inputs = request()->validate([
            'product'=> 'nullable',
            'title'=> 'required|min:8|max:255',
            'post_banner'=> 'file',
            'body'=> 'required'
        ]);

        if(request('post_banner')) {
            $inputs['post_banner'] = request('post_banner')->store('images');
        }
        $post = auth()->user()->posts()->create($inputs);

        if(request('post_image')) {
            $images = request('post_image');
            foreach($images as $image) {
                $image_fn = $image->store('images');
                $photo = $post->images()->create(['filename' => $image_fn]);

                Session::flash('post_image_added_message','Post Image created : ' . $photo->id );
            } //foreach($image as $image) {
        }
       
        Session::flash('post_create_message','Post with title was created : ' . $inputs['title']);
        return redirect()->route('post.index');
    }

    public function show(Post $post) {
        return view('post', ['post'=>$post]);
    }

    public function edit(Post $post) {
        $this->authorize('view', $post);
        $products = Product::all();
        return view('admin.posts.edit', ['post'=> $post, 'products'=>$products]);
    }

    public function update(Post $post) {

        $inputs = request()->validate([
            'product'=> 'nullable',
            'title'=> 'required|min:8|max:255',
            'post_banner'=> 'file',
            'body'=> 'required'
        ]);

        if(request('post_banner')) {
            $inputs['post_banner'] = request('post_banner')->store('images');
            $post->post_banner = $inputs['post_banner'];
        }

        if(request('post_image')) {
            $images = request('post_image');
            foreach($images as $image) {
                $image_fn = $image->store('images');
                $photo = $post->images()->create(['filename' => $image_fn]);

                Session::flash('post_image_update_message','Post Image update : ' . $photo->id );
            } //foreach($image as $image) {
        }

        $post->product_id = $inputs['product'];
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);
        $post->save();

        Session::flash('post_update_message','Post ' . $post->id . ' updated');
        //return redirect()->route('post.index');
        return back();
    }

    public function destroy(Post $post) {

        $this->authorize('delete', $post);

        $post->delete();
        Session::flash('post_delete_message','Post ' . $post->id . ' was deleted');
        return back();
    }
}