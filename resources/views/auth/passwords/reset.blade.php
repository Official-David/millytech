@extends('layouts.auth')
@section('title', 'Reset password')
@section('content')
<h4 class="text-center mb-4 mt-4">
    Reset password
</h4>
<p class="text-center">Enter a new password to reset it.</p>

<form action="{{ url('reset-password') }}" method="POST">
    @if (session('status'))
    <div class="alert alert-info alert-dismissible fade show fs-12">
        {{session('status')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button>
    </div>
    @endif
    @error('email')
    <div class="alert alert-danger alert-dismissible fade show fs-12">
        {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button>
    </div>
    @enderror
    @csrf
    <input type="hidden"  value="{{ $request->input('email') }}" name="email">
    <input type="hidden"  value="{{ $request->route('token') }}" name="token">
    <div class="mb-3">
        <input type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="New password">
    </div>

    <div class="mb-3">
        <input type="password" class="form-control" value="{{ old('password') }}" name="password_confirmation" placeholder="Confirm new password">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </div>
</form>
<div class="new-account mt-3 text-end">
    <p><a class="text-primary" href="{{route('login')}}">Back to login</a></p>
</div>
</div>
@endsection
