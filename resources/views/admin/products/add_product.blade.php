@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Products</a> </div>
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
            <h5>Add Product</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ Url('admin/add-product') }}" name="add_product" id="add_product" novalidate="novalidate">   {{ csrf_field() }}

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
                  <input type="text" name="product_name" id="product_name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code">
                </div>
              </div>                           
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
              <textarea type="text" name="description" id="description"> </textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Image</label>

                <div class="uploader" id="uniform-undefined">
                  <input  style="opacity: 0;" type="file" id="image" name="image"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span>
                </div>

              </div>
              <div class="form-actions">
                <input type="submit" value="AddProduct" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection