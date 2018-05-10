<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use File;
use session;
use Auth;
use App\Category;
use App\Product;
use Image;
use DB;
class ProductsController extends Controller
{
    public function add_Product(Request $request){
    	$data = $request->all();
    	if($request->isMethod('post')) {
    		if(empty($data['category_id'])){
    		return redirect()->back()->with('flash_message_error','Under Category is Missing or not selected');

    		}
    		
    		$product = new Product; // dd($data);
    		$product->category_id = $data['category_id'];
    		$product->product_name = $data['product_name'];
    		$product->product_code = $data['product_code'];
    		$product->product_color = $data['product_color'];
    		if(!empty($data['description'])){
    		$product->description = $data['description'];
			}else{
          		$product->description = '';

			}
    		$product->price = $data['price'];
    		//$product->image = $data['image'];
    		if ($request->hasFile('image')) {
    			$image_tmp = Input::file('image'); //die;
    			if ($image_tmp->isValid()) {
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,9999).'.'.$extension;       			    //dd($filename);

    				$Larg_image_path = 'images/backend_images/products/large/'.$filename;
    			    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
    			    $small_image_path = 'images/backend_images/products/small/'.$filename;

    			    Image::make($image_tmp)->save($Larg_image_path);
    			    Image::make($image_tmp)->resize(600,600)->save($medium_image_path); 
    			    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

    			    $product->image = $filename;     		
    		        //$product->image = $filename;     		

    		        $product->save();
    		        return redirect()->back()->with('flash_message_success','Product has been added successfully');

    			}
    		}
    		return redirect()->back()->with('flash_message_error','Product not Added. Size should be below 2MB');
    		
    	}
        //Dropdown list	
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option value=' ' selected disabled> Select </option>";
    	foreach ($categories as $Category) {
    		$categories_dropdown .="<option value='".$Category->id."'>".$Category->name."</option>";
           	$sub_categories = Category::where(['parent_id'=>$Category->id])->get();
           	foreach ($sub_categories as $Cat) {
    		    $categories_dropdown .="<option value='".$Cat->id."'>&nbsp; --&nbsp".$Cat->name."</option>";
    	    }

    	}
        //end dropdown	
    	return view('admin.products.add_product')->with(compact('categories_dropdown'));
    
    }

    public function Edit_Product(Request $request , $id){
        if ($request->isMethod('post')){
         	$data = $request->all();
         	//dd($data);
         	if ($request->hasFile('image')) {
    			$image_tmp = Input::file('image'); //die;
    			if ($image_tmp->isValid()) {
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,9999).'.'.$extension;       			    //dd($filename);

    				$Larg_image_path = 'images/backend_images/products/large/'.$filename;
    			    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
    			    $small_image_path = 'images/backend_images/products/small/'.$filename;

    			    Image::make($image_tmp)->save($Larg_image_path);
    			    Image::make($image_tmp)->resize(600,600)->save($medium_image_path); 
    			    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

    			}
    		}
    		else{
    			$filename = $data['current_image'];
    		}

         	Product::where(['id'=>$id])->update(['product_name'=>$data['product_name'],'product_color'=>$data['product_color'],'product_code'=>$data['product_code'],'description'=>$data['description'],'price'=>$data['price'],'image'=>$filename]);

    		return redirect()->back()->with('flash_message_success','Product Updated successfully');

         } 
    	$Product = Product::where(['id'=>$id])->first();
    	//Dropdown list	
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option value=' ' selected disabled> Select </option>";
    	foreach ($categories as $Category) {
    		if ($Category->id==$Product->category_id){
    			$selected="selected";
    		}else{
    			$selected="";
    		}
    		$categories_dropdown .="<option value='".$Category->id."' ".$selected.">".$Category->name."</option>";
           	$sub_categories = Category::where(['parent_id'=>$Category->id])->get();
           	foreach ($sub_categories as $sub_cat) {
           		if ($sub_cat->id==$Product->category_id){
    			    $selected="selected";
	    		}else{
	    			$selected="";
	    		}
    		    $categories_dropdown .="<option value='".$sub_cat->id."' ".$selected.">&nbsp; --&nbsp".$sub_cat->name."</option>";
    	    }

    	}
    	return view('admin.products.edit_product')->with(compact('Product','categories_dropdown'));
    }
    public function View_Products(Request $request){
        $products = Product::get();
        $first = "<b>Narendra Sisodia</b>";
        //$products = DB::table('products')->get();
        $products = json_decode(json_encode($products));
        foreach ($products as $key => $value) {
        	$category_name = Category::where(['id'=>$value->category_id])->first();
        	$products[$key]->category_name = $category_name->name;
        	  	//echo "<pre>".$category_name->name;// print_r($category_name); 
        }
        
      	return view('admin.products.view_products')->with(compact('products','first'));

    }

    public function Delete_Product_Image($id=null){
    	$a=Product::where(['image'=>$id])->update(['image'=>'']);
        dd($id);
        return redirect()->back()->with('flash_message_success','Product image deleted successfully');

    }

    public function Delete_Product($id=null){
    	Product::where(['id'=>$id])->delete();
    	//echo $id;dd($data);
    	//$data;//dd($d ata);
    	return redirect()->back()->with('flash_message_success','Product deleted successfully');;

    }    
}
