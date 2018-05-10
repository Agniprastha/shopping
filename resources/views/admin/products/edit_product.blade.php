@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Product Details</a> <a href="#" class="current">Edit Product</a> </div>
    <h1>Form validation</h1>
  </div>
  <div>
      @if(Session::has('flash_message_error'))
          <div class="alert alert-danger alert-block">

              <button type="button" class="close" data-dismiss="alert">×</button> 

              <strong>{!! Session('flash_message_error') !!}</strong>

          </div>
      @endif
      @if(Session::has('flash_message_success'))
          <div class="alert alert-success alert-block">

              <button type="button" class="close" data-dismiss="alert">×</button> 

              <strong>{!! Session('flash_message_success') !!}</strong>

          </div>
      @endif   
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Product/h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ Url('admin/edit-product/'.$Product->id) }}" name="edit_product" id="edit_product" novalidate="novalidate">   {{ csrf_field() }}

                <div class="control-group">
                  <label class="control-label">Under Category</label>
                  <div class="controls">
                    <select name="category_id" id="category_id" style="width: 220px;">
                        <?php echo $categories_dropdown; ?>
                    </select>
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{ $Product->product_name }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" value="{{ $Product->product_color }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{ $Product->product_code }}">
                </div>
              </div>                           
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
              <textarea type="text" name="description" id="description" >{{ $Product->description }}" </textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{ $Product->price }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Image</label>

                <div class="uploader" id="uniform-undefined">
                  <input  style="opacity: 0;" type="file" id="image" name="image"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span>
                  <img src="{{ asset('/images/backend_images/products/small/'.$Product->image) }}">
                </div>
                <div class="controls">
                  @if(!empty($Product->image))
                    <input type="file" name="image" id="image">
                    <input type="hidden" name="current_image" value="{{ $Product->image }}">
                    <img style="width: 40px"  src="{{ asset('/images/backend_images/products/small/'.$Product->image) }}"><a href="{{Url('/admin/delete-product-image/'.$Product->image) }}" >Delete</a>
                  @endif
                </div>

              </div>
              <div class="form-actions">
                <input type="submit" value="Edit_Product" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection