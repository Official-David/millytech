@extends('layouts.app')

@section('title', 'Change Password')
@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h6 class="mb-3 me-auto">@yield('title')</h6>
    </div>

    <div class="col-lg-5 col-sm-12 m-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{route('user.settings.password.change')}}" method="POST" id="form">
                    @csrf

                    <div class="form-group pt-3">
                        <label for=""><strong>Current password</strong></label>
                        <input type="password" name="current_password" id="password" class="form-control fs-12" placeholder="Current password" value="{{old('current_password')}}">
                        <x-error key="current_password" />
                    </div>

                    <div class="form-group pt-3">
                        <label for=""><strong>New password</strong></label>
                        <input type="password" name="password" id="password" class="form-control fs-12" placeholder="New password" value="{{old('password')}}">
                        <x-error key="password" />
                    </div>

                    <div class="form-group pt-3">
                        <label for=""><strong>Confirm new password</strong></label>
                        <input type="password" name="password_confirmation" class="form-control fs-12" placeholder="Confirm password" value="{{old('password_confirmation')}}">
                        <x-error key="password_confirmation" />
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">Change password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
