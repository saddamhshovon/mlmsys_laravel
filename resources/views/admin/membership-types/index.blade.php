@extends('admin.layouts.app')

@section('title', 'Membership Types')

@section('content')

    <div class="container">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Membership Types</h1>

        <!-- DataTales Example -->
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{ route('membership') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Add New Membership Type<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-gray-200">
                                <tr role="row" class="text-center">
                                    <th scope="col" width="10%">Sl</th>
                                    <th scope="col" width="60%">Name</th>
                                    <th scope="col" width="30%">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($types as $type)
                                    <tr class="text-center">
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $type->name }}</td>
                                        <td>
                                            <form action="{{ route('membership.delete', $type) }}" method="POST" style="display: inline-block">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
