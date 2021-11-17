@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<h4 class="text-center mb-4 mt-4">
    @if(request()->isUser())
    Sign into your account
    @else
    Welcome Admin
    @endif
</h4>
<form action="{{ route('login') }}" method="POST">
    @error('email')
        <div class="alert alert-danger alert-dismissible fade show fs-12">
                {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
            </button>
        </div>
    @enderror
    @csrf
    <div class="mb-3">
        <label class="mb-1"><strong>Email</strong></label>
        <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email Address">
    </div>
    <div class="mb-3">
        <label class="mb-1"><strong>Password</strong></label>
        <input type="password" class="form-control" placeholder="Password" name="password">
    </div>
    <div class="d-flex justify-content-between ">
        <div class="mb-3">
            <div class="form-check custom-checkbox ms-1">
                <input type="checkbox" class="form-check-input" id="basic_checkbox_1" name="remember">
                <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
            </div>
        </div>
        @if(request()->isUser())
        <div>
            <a href="{{route('register')}}" class="d-flex">Create account</a>
        </div>
        @endif
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>
</form>
<div class="new-account mt-3 text-center">
    <p>Go back <a class="text-primary" href=""> <i class="fa fa-home"></i> Home</a></p>
</div>
</div>
@endsection
