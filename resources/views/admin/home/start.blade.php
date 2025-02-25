@extends('admin.layouts.app')

@section('title', 'Home Start View')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Home Start View</h1>
</div>

<div class="row">
   <div class="col-xl-6 col-md-6 mb-4">
      <div class="card shadow mb-4">
         <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>{{session('success')}}</strong>
               <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-success alert-danger fade show" role="alert">
               <strong>{{session('error')}}</strong>
               <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            @endif

            <img class="rounded-circle" style="height:100px; width: 100px;" src="{{(isset($homestart->image)) ? asset($homestart->image) : url('images/no_image.jpg')}}" height="100%" width="100%" alt=""><br>

            <form action="{{route('home.start.submit')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="mb-3">
                  <label for="image" class="form-label">Upload Logo<span class="text-danger">*</span></label>

                  <input type="file" name="image" class="form-control" id="image">
               </div>
               @error('image')
               <div class="form-group">
                  <h1 class="h6 pl-3 text-danger" role="alert">{{$message}}</h1>
               </div>
               @enderror

               <div class="mb-3">
                  <label for="logo_title" class="form-label">Logo Title<span class="text-danger">*</span></label>
                  <input type="text" name="logo_title" value="{{!empty($homestart->logo_title) ? $homestart->logo_title : ''}}" class="form-control" id="logo_title" placeholder="Logo Title">
                  @error('logo_title')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>

               <div class="mb-3">
                  <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                  <input type="text" name="title" value="{{!empty($homestart->title) ? $homestart->title : ''}}" class="form-control" id="title" placeholder="Title">
                  @error('title')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>

               <div class="mb-3">
                  <label for="subtitle" class="form-label">Description<span class="text-danger">*</span></label>
                  <input type="text" name="subtitle" value="{{!empty($homestart->subtitle) ? $homestart->subtitle : ''}}" class="form-control" id="subtitle" placeholder="Description">
                  @error('subtitle')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
               </div>
               @if(empty($homestart))
               <div>
                  <button type="submit" class="btn btn-rounded btn-primary">Create</button>
               </div>
               @else
               <div>
                  <button type="submit" class="btn btn-rounded btn-primary">Update</button>
               </div>
               @endif
            </form>
         </div>
      </div>
   </div>
</div>

@endsection