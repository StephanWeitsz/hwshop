<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductItemController extends Controller
{

    public function create(Product $product) {
        return view('admin.product_items.create', ['product'=>$product]);
    }

    public function store(Request $request, Product $product) {
        //$this->authorize('create', Product_item::class);
        $inputs = request()->validate([
            'name'=> 'required|min:8|max:255',
            'about'=> 'required|min:8|max:255',
        ]);

        $inputs['product_id'] = $product->id;

        $item = Product_item::create($inputs);

        Session::flash('productItem_create_message','Product Item was created : ' . $inputs['name']);
        return redirect()->route('product.edit', $product->id);
    }

    public function edit(Product $product, Product_item $product_item) {
         //$this->authorize('view', $product_item);
         return view('admin.product_items.edit', ['product'=> $product, 'product_item'=> $product_item]);
    }

    public function update(Product $product, Product_item $product_item) {
        $inputs = request()->validate([
            'name'=> 'required|min:3|max:255',
            'about'=> 'required|min:3|max:255',
        ]);

        $product_item->name = $inputs['name'];
        $product_item->about = $inputs['about'];

        //$this->authorize('update', $product_item);
        $product_item->save();

        Session::flash('product_item_update_message','Product Item ' . $product_item->id . ' updated');
        return back();
    }

    public function destroy(Product $product, Product_item $product_item) {
        //$this->authorize('delete', $product_item);
        $product_item->delete();
        Session::flash('productItem_delete_message','Product Item' . $product_item->name . ' was deleted');
        return back();
    }
} 
