@extends('layouts.auth')
@section('title', 'Forgot password')
@section('content')
<h4 class="text-center mb-4 mt-4">
    Forgot your password?
</h4>
<p class="text-center">Enter your account email address, we'll mail you a link to reset your password.</p>

<form action="{{ url('forgot-password') }}" method="POST">
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
    <div class="mb-3">
        <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email Address">
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
