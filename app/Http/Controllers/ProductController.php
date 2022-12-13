<?php

namespace App\Http\Controllers;

use ZipArchive;
use DOMDocument;

use App\Models\Product;
use App\Models\Product_item;
use App\Models\Product_item_element;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use PhpOffice\PhpWord\IOFactory;
use Maatwebsite\Excel\Facades\Excel;
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
            'description'=> 'required|min:8',
        ]);

        $inputs['type'] = $request->type;
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
            'description'=> 'required|min:8',
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
        if(request('type')) {
            $product->type = request('type');
        } //if(request('type')) {

        $product->description = $inputs['description'];

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

    public function importProduct() {
        return view('admin.products.import');
    }

    //WORD DOCX Reader option 1
    private $data_arr;
    private $status;
    private $row_status;
    private $in_table;
    private $pcnt;
    private $icnt;
    private $ecnt;

    private function iterateOverRows($table) {
       
        $this->row_status = "";

        $row_cnt = 0;
        $rows = $table->getRows();
        foreach ($rows as $row) {
            $this->in_table = "Y";
            $cell_cnt = 0;

            foreach ($row->getCells() as $cell) {
                if($cell_cnt == 0) {
                    if($row_cnt > 0) {
                        //echo "<br>" . $this->row_status . ": TXT <hr>";                        
                        $this->status = "ABOUT";
                        //echo "<hr>" . $this->status . "<hr>";
                        $row_cnt = -1;
                    } //if($row_cnt > 0) {       
                    else {
                        $this->icnt++;
                        $this->status = "ITEM";
                        //echo "<hr>$this->status $this->icnt<hr>";
                    } //else
                } //if($cell_cnt == 0) {
                else {
                    $this->ecnt++;
                    $this->status = "ELEMENT";
                    //echo "<br> " . $this->row_status . ": TXT .<hr>" . $this->status . " " . $this->icnt . "-" . $this->ecnt . "<hr>";
                } //else

                $els = $cell->getElements();
                foreach ($els as $e) {
                    $this->switchElements($e);
                } //foreach ($els as $e) {
                $cell_cnt++;
            } //foreach ($row->getCells() as $cell) {
            $row_cnt++;
        } //foreach ($rows as $row) {
        $this->in_table = "N";
        //echo "<br> E : TBL <hr>";
        $this->row_status = "";
    }

    private function switchElements($element) {
        switch (get_class($element)) {
            case 'PhpOffice\PhpWord\Element\TextRun':
                if(empty($this->row_status)) {
                    if($this->in_table == 'N') {
                        //dump($this->data_arr);
                        $this->status = "PRODUCT";
                        //echo "<hr>$this->status<hr>";
                        $this->pcnt++;
                    } //if($this->in_table == 'N') {
                    else 
                        //echo ">"; 

                    $this->row_status = "S";
                } //if(empty($this->row_status)) {

                if($this->row_status == 'S') {
                    //echo "<hr>* $this->row_status : TXT $this->icnt<br>";
                    $this->row_status = "E";
                } //if($this->row_status == 'S') {
                elseif($this->row_status == 'E') {
                    //echo "<hr> S : TXT > $this->icnt<br>";
                } //elseif($this->row_status == 'E') {
                else {
                    $this->row_status = "###";
                } //else
                
                $this->getTextFromTextRun($element);
            break;
            case 'PhpOffice\PhpWord\Element\Table':
                //echo "<br> " . $this->row_status . ": TXT <hr>";    
                //echo "<hr> S : TBL<br>";

                if($this->row_status) {
                    $this->icnt = 0;
                    $this->ecnt = 0;
                } //if($this->row_status) {

                $this->iterateOverRows($element);
            break;
            default:
        } //switch (get_class($element)) {
    }

    private function getTextFromTextRun($element) {
        for ($index = 0; $index < $element->countElements(); $index++) {
            $textRunElement = $element->getElement($index);
    
            switch (get_class($textRunElement)) {
                case 'PhpOffice\PhpWord\Element\Text':
                case 'PhpOffice\PhpWord\Element\TextRun':
                    $text = $textRunElement->getText();
                    if (strlen($text) > 0) {
                        switch($this->status) {
                            case "PRODUCT":
                                if(isset($this->data_arr['PRODUCT'][$this->pcnt]['TEXT'])) {
                                    $this->data_arr['PRODUCT'][$this->pcnt]['TEXT'] .= $text;
                                } //if(isset($this->data_arr['PRODUCT'][$this->pcnt]['TEXT'])) {
                                else {
                                    $this->data_arr['PRODUCT'][$this->pcnt]['TEXT'] = $text;
                                } //else
                            break;
                            case "ITEM":
                                if(isset($this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['NAME'])) {
                                    $this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['NAME'] .= $text;
                                } //if(isset($this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['NAME'])) {
                                else {
                                    $this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['NAME'] = $text;
                                } //else
                            break;
                            case "ELEMENT":
                                if(isset($this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['ELEMENT'][$this->ecnt]['Value'])) {
                                    $this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['ELEMENT'][$this->ecnt]['Value'] .= $text;
                                } //if(isset($this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['ELEMENT'][$this->ecnt]['Value'])) {    
                                else {
                                    $this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['ELEMENT'][$this->ecnt]['Value'] = $text;
                                } //else
                            break;
                            case "ABOUT":
                                if(isset($this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['ABOUT'])) {
                                    $this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['ABOUT'] .= $text;
                                } //if(isset($this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['ABOUT'])) {
                                else {
                                    $this->data_arr['PRODUCT'][$this->pcnt]['ITEM'][$this->icnt]['ABOUT'] = $text;
                                } //else
                            break;
                        } //switch($this->status) {
                        //echo $text; 
                    }
                break;
                case 'PhpOffice\PhpWord\Element\TextBreak':
                break;
                default:
                break;
            } //switch (get_class($textRunElement)) {
        } //for ($index = 0; $index < $element->countElements(); $index++) {
    }

    public function uploadProduct(Request $request) {

        $this->status = "";
        $this->in_table = "N";
        $this->pcnt = 0;

        $file = $request->file('file');
        $fileName = $request->file->getClientOriginalName();
        $file->move(public_path('import'), $fileName);

        $source = "import/" . $fileName;

        $phpWord = \PhpOffice\PhpWord\IOFactory::load($source);
        $sections = $phpWord->getSections();
        foreach ($sections as $s) {
            $els = $s->getElements();
            foreach ($els as $e) {
                $this->switchElements($e);   
            } //foreach ($els as $e) {
        } //foreach ($sections as $s) {

        unset($product_arr);
        foreach($this->data_arr as $data_list) {
            foreach($data_list as $product_array) {
                $allswell = true;
                $product_text = $product_array['TEXT'];
                $product_text_array = explode(":", $product_text);

                if(strpos($product_text_array[1],"Signature")) {
                    $product_arr["PRODUCT"][$product_text_array[0]]['TYPE'] = $product_text_array[1];
                    if(isset($product_text_array[2])) {
                        $product_arr["PRODUCT"][$product_text_array[0]]['DESCRIPTION'] = $product_text_array[2];
                    } //if(isset($product_text_array[2])) {
                } //if(strpos($product_text_array[1],"Signature")) {
                else {
                    $product_arr["PRODUCT"][$product_text_array[0]]['TYPE'] = "";
                    $product_arr["PRODUCT"][$product_text_array[0]]['DESCRIPTION'] = $product_text_array[1];
                } //else

                $product_items = $product_array['ITEM'];
                foreach($product_items as $product_item) {
                    if(isset($product_item['NAME'])) {
                        if(isset($product_item['ABOUT'])) {
                            $product_arr["PRODUCT"][$product_text_array[0]]['I'][$product_item['NAME']]['ABOUT'] = $product_item['ABOUT'];
                        } //if(isset($product_item['ABOUT'])) { 
                        else {
                            $product_arr["PRODUCT"][$product_text_array[0]]['I'][$product_item['NAME']]['ABOUT'] = "";
                        } //else

                        if(isset($product_item['ELEMENT'])) {
                            $product_elements = $product_item['ELEMENT'];

                            foreach($product_elements as $product_element) {
                                if(isset($product_element['Value'])) {
                                    $element_value_array = explode(" ", $product_element['Value']);
                                    $element_value_cnt = count($element_value_array);
                                    if(isset($element_value_array[0])) {
                                        $txt = "";
                                        for($i = 1; $i < $element_value_cnt; $i++) {
                                            if($element_value_array[$i]) {
                                                if($element_value_array[$i] == "refill") {
                                                    $txt = " pre Refill";
                                                } //if($element_value_array[$i] == "refill") {
                                                else {
                                                    $product_arr["PRODUCT"][$product_text_array[0]]['I'][$product_item['NAME']]['E'][$element_value_array[0]] = $element_value_array[$i] . $txt;
                                                    break;
                                                } //else
                                            } //if(isset($element_value_array[$i])) {
                                        } //for($i = 0; $i > $element_value_cnt; $i++) {
                                    } //if(isset($element_value_array[0])) {
                                    else {
                                        $allswell = false;
                                        echo "<hr>";
                                        echo "<b>E0-VALUE : Product {$product_text_array[0]} > {$product_item['NAME']} </b>";
                                        echo "<hr>";
                                        dump($element_value_array);
                                        echo "<hr>";
                                    } //else
                                } //if(isset($product_element['Value'])) {
                                else {
                                    $allswell = false;
                                    echo "<hr>";
                                    echo "<b>E-VALUE : Product {$product_text_array[0]} > {$product_item['NAME']} </b>";
                                    echo "<hr>";
                                    dump($product_element);
                                    echo "<hr>";
                                } //else
                            } //foreach($product_elements as $product_element) {
                        } //if(isset($product_item['ELEMENT'])) {
                        else {
                            $allswell = false;
                            echo "<hr>";
                            echo "<b>E-ELEMENTS : Product {$product_text_array[0]} > {$product_item['NAME']} </b>";
                            echo "<hr>";
                            dump($product_item);
                            echo "<hr>";
                        } //else
                    } //if(isset($product_item['NAME'])) {
                    else {
                        $allswell = false;
                        echo "<hr>";
                        echo "<b>E-ITEM  {$product_text_array[0]} </b>";
                        echo "<hr>";
                        dump($product_item);
                        echo "<hr>";
                    } //else
                } //foreach($product_items as $product_item) {
  
                if($allswell) {                   
                    foreach($product_arr as $product_item) {
                        foreach($product_item as $product_name =>$items) {
                            echo "<hr>";
                            echo "PRODUCT : $product_name <br>";
                            echo "<hr>";

                            $p = Product::where('name', "=", $product_name)->exists();
                            if($p) {
                                $p = Product::where('name', "=", $product_name)->firstOrFail();
                                echo "$product_name exists {$p->id} <br>";
            
                                if(isset($items['DESCRIPTION'])) {
                                    $upd = 0;
                                    $old_description = $p->description;
                                    if($items['DESCRIPTION'] != $old_description) {
                                        $upd = 1;
                                        $p->description = $items['DESCRIPTION'];
                                    } //if($items['DESCRIPTION'] != $old_description) {

                                    $old_type = $p->type;
                                    if($items['TYPE'] == $old_type) {
                                        $upd = 1;
                                        $p->type = $items['TYPE'];
                                    } //if($items['TYPE'] == $old_type) {

                                    if($upd == 1) {
                                        $p->save();
                                        echo "Update Product description on $product_name {$p->id}<br>";
                                    } //if($upd == 1) {
                                } //if(isset($items['DESCRIPTION'])) {
                                else {
                                    $allswell = false;
                                    echo "<font color=red>Update product : $product_name failed</font><br>";
                                } //else      
                            } //if($p) {
                            else {
                                echo "New Product : $product_name <br>";
                                
                                if(isset($items['DESCRIPTION'])) {
                                    $p = new Product;
                                    $p->name = $product_name;
                                    $p->description = $items['DESCRIPTION'];
                                    $p->type = $items['TYPE'];
                                    $p->save();
                                    echo "Created New product : $product_name ($p->id) <br>";
                                } //if(isset($items['DESCRIPTION'])) {
                                else { 
                                    $allswell = false;
                                    echo "<font color=red>Created New product : $product_name failed</font><br>";
                                } //else
                            } //else
                            echo "<hr>";

                            if($allswell) {
                                $item_arr = $items['I'];
                                foreach($item_arr as $item_name=>$item_item) {
                                    echo "*******************<br>";
                                    echo "* $item_name <br>";
                                    echo "*******************<br>";
                                    
                                    $pi = Product_item::where('name', "=", $item_name)->exists();
                                    if($pi) {
                                        $pi = Product_item::where('name', "=", $item_name)->firstOrFail();
                                        echo "$item_name exists {$pi->id} <br>";

                                        $upd = 0;
                                        $old_about = $pi->about;
                                        if($item_item['ABOUT'] != $old_about) {
                                            $upd = 1;
                                            $pi->about = $item_item['ABOUT'];
                                        } //if($item_item['ABOUT'] != $old_about) {
        
                                        if($upd == 1) {
                                            $pi->save();
                                            echo "Update Product Item about on $product_name for $item_name {$pi->id}<br>";
                                        } //if($upd == 1) {
                                    } //if($p) {
                                    else {
                                        echo "New Product Item : $item_name <br>";
        
                                        $pi = new Product_item;
                                        $pi->product_id = $p->id;
                                        $pi->name = $item_name;
                                        $pi->about = $item_item['ABOUT'];
                                        $pi->save();
                                        echo "Created New product item : $item_name ($pi->id) <br>";
                                    } //else

                                    $element_arr = $item_item['E'];
                                    foreach($element_arr as $element_size=>$element_price) {
                                        $pie = Product_item_element::where('size', "=", $element_size)->where('product_item_id',"=",$pi->id)->exists();
                                        if($pie) {
                                            $pie = Product_item_element::where('size', "=", $element_size)->where('product_item_id',"=",$pi->id)->firstOrFail();
                                            echo "> $element_size exists {$pie->id} <br>";

                                            $old_price = $pie->price;
                                            if($element_price != $old_price) {
                                                $pie->price =  $element_price;
                                                $pie->save();
                                                echo "> Update Product Item Element: $element_size price from $old_price to $element_price<br>";
                                            } //if($element_price != $old_price) {
                                        } //if($p) {
                                        else {
                                            echo "> New Product Item Element: $element_size : $element_price<br>";
                                            $pie = new Product_item_element;
                                            $pie->product_item_id = $pi->id;
                                            $pie->size = $element_size;
                                            $pie->price = $element_price;
                                            $pie->save();
                                            echo "> Created New product element : $element_price ($pie->id) <br>";
                                        } //else
                                    } //foreach($element_arr as $element_size=>$element_price) {    
                                } //foreach($item_arr as $item_name=>$item_item) {
                            } //if($allswell) {
                        } //foreach($product_item as $product_name =>$items) {
                    } //foreach($product_arr as $product) {   
                } //if($allswell) {
                unset($product_arr);
            } //foreach($data_list as $product_arr) {
        } //foreach($this->data_arr as $data_list) {
        
        echo "<br>";
        echo "<hr>";
        echo "<a href='" . route('product.index') . "' class='btn btn-primary' role='button' aria-disabled='true'>go to Products</a>";
        echo "<hr>";
    } //public function uploadProduct(Request $request) {
} 
