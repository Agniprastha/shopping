@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Edit Categories</a> </div>
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
            <h5>Edit Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ Url('admin/edit-category/'.$category_datails->id) }}" name="edit_category" id="edit_category" novalidate="novalidate">   {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="category_name" id="category_name" value="{{ $category_datails->name }}">
              </div>
              <div class="control-group">
                <label class="control-label">Category Level</label>
                <div class="controls">
                <select name="parent_id" style="width: 220px;">
                  <option value="0">main Category</option>
                  @foreach($levels as $val)
                  <option value="{{ $val->id }}" @if($val->id == $category_datails->parent_id) selected @endif >{{ $val->name }}</option>
                  @endforeach
                </select>
              </div>

              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
              <textarea name="Description" id="Description" >{{ $category_datails->description }} </textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Url</label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{ $category_datails->url }}">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Category" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection