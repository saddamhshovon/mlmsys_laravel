@extends('admin.layouts.app')

@section('title', 'Edit Member')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Member</h1>

        <!-- DataTales Example -->
        <div class="row">
            <div class="col-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{ route('member.all') }}" class="btn btn-primary">Back To All Member</a>
                    </div>
                    <div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-success alert-danger fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('member.update', $member->id) }}" method="post">
                            @csrf
                            <div class="">
                                <div class="mb-3">
                                    <label for="referral_id" class="form-label">Refferal ID<span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled value="{{ $member->referral_id ?? 'Root' }}"
                                        class="form-control" id="referral_id" placeholder="Refferal ID">
                                    @error('referral_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="first_name" value="{{ $member->first_name }}"
                                        class="form-control" id="first_name" placeholder="First Name">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="last_name" value="{{ $member->last_name }}"
                                        class="form-control" id="last_name" placeholder="Last Name">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="email" value="{{ $member->email }}" class="form-control"
                                        id="email" placeholder="Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password" value="{{ $member->password }}"
                                        class="form-control" id="password" placeholder="Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="mobile_no" class="form-label">Mobile Number<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="mobile_no" value="{{ $member->mobile_no }}"
                                        class="form-control" id="mobile_no" placeholder="Mobile Number">
                                    @error('mobile_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pin" class="form-label">Pin Code<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="pin" value="{{ $member->pin }}" class="form-control"
                                        id="pin" placeholder="Pin Code">
                                    @error('pin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="moblie_banking_service" class="form-label">Mobile Banking Service<span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled
                                        value="{{ $member->mobile_banking_service }}" class="form-control"
                                        id="moblie_banking_service" placeholder="Mobile Banking Service">
                                </div>
                                <div class="mb-3">
                                    <select class="form-control" aria-label="Select Mobile Banking Service"
                                        id="exampleMobileBanking" placeholder="Mobile Banking Service"
                                        name="mobile_banking_service" required>
                                        <option selected value="" disabled>Mobile Banking Service</option>
                                        @foreach ($mobiles as $mobile)
                                            <option value="{{ $mobile->name }}">{{ $mobile->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('mobile_banking_service')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="country" class="form-label">Country<span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled required value="{{ $member->country }}"
                                        class="form-control" id="country">
                                </div>
                                <div class="mb-3">
                                    <select class="form-control" aria-label="Select Country" id="exampleCountry"
                                        name="country" required>
                                        <option selected value="" disabled>Open this select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="city" class="form-label">City<span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled required value="{{ $member->city }}"
                                        class="form-control" id="city">
                                </div>

                                <div class="mb-3">
                                    <select class="form-control" aria-label="Select City" id="exampleCity"
                                        placeholder="City" name="city" required>
                                        <option selected value="" disabled>Open this select city</option>
                                    </select>
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="membership_type" class="form-label">Membership Process<span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled value="{{ $member->membership_type }}"
                                        class="form-control" id="membership_type" placeholder="Membership Process">
                                </div>

                                <div class="mb-3">
                                    <label for="placement_id" class="form-label">Placement ID<span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled value="{{ $member->placement_id ?? 'Root' }}"
                                        class="form-control" id="placement_id" placeholder="Placement ID">
                                    @error('placement_id')
                                        <span class="text-danger">{{ $message }}</span>
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
