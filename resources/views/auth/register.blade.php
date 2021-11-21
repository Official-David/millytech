@extends('layouts.auth')
@section('title', 'Register')
@section('content')
    <h4 class="text-center mb-4">Create a free account</h4>
    <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Firstname" value="{{old('firstname')}}" name="firstname">
            <x-error :key="'firstname'" />
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Lastname" value="{{old('email')}}" name="lastname">
            <x-error :key="'lastname'" />
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" placeholder="hello@example.com" value="{{old('email')}}" name="email">
            <x-error :key="'email'" />
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <x-error :key="'password'" />
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">Create</button>
        </div>
    </form>
    <div class="new-account mt-3">
        <p>Already have an account? <a class="text-primary" href="{{route('login')}}">Sign in</a> or go back <a class="text-primary" href="//{{front_domain()}}"">Home</a></p>
    </div>
@endsection
