<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use DB;
class CategoryController extends Controller
{
    public function addCategories(Request $request){
    	if($request->isMethod('post')) {
    		
    		$data = $request->all();
    		//dd($data);
    		$category = new Category;
    		$category->description = $data['Description'];
    		$category->name = $data['category_name'];
    		$category->parent_id = $data['parent_id'];
    		$category->url = $data['url'];
    		$category->save();
    		return redirect('/admin/view-categories')->with('flash_message_success','category added successfully');
    	}
    	$levels=Category::where(['parent_id'=>0])->get();
    	//dd($levels);
   	return view('admin.categories.add_category')->with(compact('levels'));

    }

    public function view_categories(Request $request){
    	$category = Category::get();
   	return view('admin.categories.view_categories',['catgs'=>$category]);

    }

    public function edit_category(Request $request, $id){
    	if($request->isMethod('post')) {
    		
    	    $data = $request->all();//dd($data);
    	    Category::where(['id'=>$id])->update(['name'=>$data['category_name'],'description'=>$data['Description'],'url'=>$data['url']]);

       		return redirect('/admin/view-categories')->with('flash_message_success','category Updated successfully');
    	}
    	$category_datails=Category::where(['id'=>$id])->first();
    	$levels=Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.edit_categories')->with(compact('category_datails','levels'));
    }

    public function delete_category(Request $request, $id=null){
    	if(!empty('$id')) {
    		
    	    Category::where(['id'=>$id])->delete();

       		return redirect()->back()->with('flash_message_success','category Deleted successfully');

    	}
    }    
}
