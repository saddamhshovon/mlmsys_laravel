@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')

<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Edit Product</h1>

   <!-- DataTales Example -->
   <div class="row">
      <div class="col-8">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <a href="{{route('product.all')}}" class="btn btn-primary">Back To All Product</a>
            </div>
            <div>
               @if(session('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong>
               </div>
               @endif
               @if(session('error'))
               <div class="alert alert-success alert-danger fade show" role="alert">
                  <strong>{{session('error')}}</strong>
               </div>
               @endif
            </div>
            <div class="card-body">
               <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div>
                     <input type="hidden" name="id" value="{{$product->id}}">
                     <input type="hidden" name="old_image" value="{{$product->product_image}}">
                     <input type="hidden" name="old_pdf" value="{{$product->product_pdf}}">
                     <div class="mb-3">
                        <label for="product_name" class="form-label">Product Names<span class="text-danger">*</span></label>
                        <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" id="product_name" placeholder="Product Name">
                        @error('product_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_category" class="form-label">Product Category<span class="text-danger">*</span></label>
                        <select class="form-control form-control-md" name="product_category">
                           <option value="{{$product->product_category}}">{{$product->product_category}}</option>
                           <option value="Physical">Physical</option>
                           <option value="Virtual">Virtual</option>
                        </select>
                        @error('product_category')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_code" class="form-label">Product Code<span class="text-danger">*</span></label>
                        <input type="text" name="product_code" value="{{$product->product_code}}" class="form-control" id="product_code" placeholder="Product Code">
                        @error('product_code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_price" class="form-label">Product Price<span class="text-danger">*</span></label>
                        <input type="text" name="product_price" value="{{$product->product_price}}" class="form-control" id="product_price" placeholder="Product Price">
                        @error('product_price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea class="form-control" name="product_description" value="{{$product->product_description}}" id="product_description" rows="2" placeholder="Product Description"></textarea>
                     </div>

                     <div class="mb-3">
                        <label for="product_image" class="form-label">Product Image<span class="text-danger">*</span></label>
                        <input type="file" name="product_image" class="form-control" id="product_image" placeholder="Product Image">
                        @error('product_image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="product_pdf" class="form-label">Product PDF</label>
                        <input type="file" name="product_pdf" class="form-control" id="product_pdf" placeholder="Product PDF">
                        @error('product_pdf')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                     </div>
                  </div>
                  <div>
                     <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection