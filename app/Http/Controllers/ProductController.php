<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.products.index', ['products'=> $products]);
    }

    public function create() {
        //$this->authorize('create', Product::class);
        return view('admin.products.create');
    }

    public function store(Request $request) {
        //$this->authorize('create', Product::class);
        $inputs = request()->validate([
            'name'=> 'required|min:8|max:255',
            'description'=> 'required|min:8|max:255',
            'about'=> 'required|min:8|max:255',
            'price'=> 'required'
        ]);

        $product = Product::create($inputs);

        if(request('product_image')) {
            $images = request('product_image');
            foreach($images as $image) {
                $image_fn = $image->store('images');
                $photo = $product->images()->create(['filename' => $image_fn]);

                Session::flash('product_image_created_message','Product Image created : ' . $photo->id );
            } //foreach($image as $image) {
        }

        Session::flash('product_create_message','Product was created : ' . $inputs['name']);
        return redirect()->route('product.index');
    }

    public function show(Product $product) {
        return view('product', ['product'=>$product]);
    }

    public function edit(Product $product) {
        //$this->authorize('view', $product);
        return view('admin.products.edit', ['product'=> $product]);
    }

    public function update(Product $product) {

        $inputs = request()->validate([
            'name'=> 'required|min:8|max:255',
            'description'=> 'required|min:8|max:255',
            'about'=> 'required|min:8|max:255',
            'price'=> 'required'
        ]);

        if(request('product_image')) {
            $images = request('product_image');
            foreach($images as $image) {
                $image_fn = $image->store('images');
                $photo = $product->images()->create(['filename' => $image_fn]);

                Session::flash('product_image_update_message','Product Image update : ' . $photo->id );
            } //foreach($image as $image) {
        }

        $product->name = $inputs['name'];
        $product->description = $inputs['description'];
        $product->about = $inputs['about'];
        $product->price = $inputs['price'];

        //$this->authorize('update', $product);
        $product->save();

        Session::flash('product_update_message','Product ' . $product->id . ' updated');
        //return redirect()->route('product.index');
        return back();
    }

    public function destroy(Product $product) {

        //$this->authorize('delete', $product);

        $product->delete();
        Session::flash('product_delete_message','Product ' . $product->id . ' was deleted');
        return back();
    }
}
