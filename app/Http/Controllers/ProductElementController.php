<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_item;
use App\Models\Product_item_element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductElementController extends Controller
{
    public function create(Product $product, Product_item $product_item) {
        return view('admin.product_elements.create', ['product'=>$product, 'product_item'=>$product_item]);
    }

    public function store(Request $request, Product $product, Product_item $product_item) {
         //$this->authorize('create', Product_element::class);
         $inputs = request()->validate([
            'size'=> 'required',
            'price'=> 'required',
        ]);

        $inputs['product_item_id'] = $product_item->id;

        $element = Product_item_element::create($inputs);

        Session::flash('productElement_create_message','Product Element was created : ' . $inputs['size']);
        return redirect()->route('product_item.edit', [$product->id, $product_item->id]);
    }

    public function edit(Product $product, Product_item $product_item, Product_item_element $product_element) {
         //$this->authorize('view', $product_element);
         return view('admin.product_elements.edit', ['product'=> $product, 'product_item'=> $product_item, 'product_element'=>$product_element]);
    }

    public function update(Product $product, Product_item $product_item, Product_item_element $product_element) {
        $inputs = request()->validate([
            'size'=> 'required',
            'price'=> 'required',
        ]);

        $product_element->size = $inputs['size'];
        $product_element->price = $inputs['price'];

        //$this->authorize('update', $product_element);
        $product_element->save();

        Session::flash('productElement_update_message','Product element ' . $product_element->id . ' updated');
        return back();
    }

    public function destroy(Product $product, Product_item $product_item, Product_item_element $product_element) {
        //$this->authorize('delete', $product_item);
        $product_element->delete();
        Session::flash('productElement_delete_message','Product Element ' . $product_element->size . ' was deleted');
        return back();
    }
} 
