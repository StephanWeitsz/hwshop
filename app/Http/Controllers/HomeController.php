<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    } //public function __construct() {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $posts = Post::all();
        //$posts = Post::all()->sortBy('id', 'desc');
        
        return view('home', ['posts'=>$posts]);
    } //public function index() {

    public function products() {
        $products = Product::all();
        return view('products.products', ['products'=>$products]);
    } //public function products() {

    public function product(Product $product) {
        return view('products.product', ['product'=>$product]);
    }
} //class HomeController extends Controller
