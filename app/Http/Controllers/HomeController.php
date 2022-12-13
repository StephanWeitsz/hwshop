<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use App\Models\Product_item;
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
        //$products = Product::all();
        //$posts = Post::all()->sortBy('id', 'desc');
        
        return view('home', ['posts'=>$posts]);
    } //public function index() {

    public function products() {
        $products = Product::all();
        return view('products.products', ['products'=>$products]);
    } //public function products() {

    public function product(Product $product) {
        return view('products.product', ['product'=>$product]);
    } //public function product(Product $product) {

    public function product_item(Product $product, Product_item $product_item) {
        return view('products.item', ['product'=>$product, 'item'=>$product_item]);
    } //public function product_item(Product $product, Product_item $product_item) {
} //class HomeController extends Controller
