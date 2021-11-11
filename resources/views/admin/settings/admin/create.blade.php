@extends('layouts.app')

@section('title', 'Create admin')
@section('content')
    <div class="container-fluid">
        <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
            <h5 class="mb-3 me-auto">@yield('title')</h5>
        </div>

        <div class="col-lg-6 col-sm-12 m-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.settings.admin.store')}}" method="POST" class="pt-2 pb-2">
                        @csrf
                        <div class="form-group">
                            <label for="firstname"><strong>Firstname</strong></label>
                            <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Firstname" value="{{old('firstname')}}">
                            <x-error key="firstname" />
                        </div>

                        <div class="form-group">
                            <label for="lastname"><strong>Lastname</strong></label>
                            <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Lastname" value="{{old('lastname')}}">
                            <x-error key="lastname" />
                        </div>

                        <div class="form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Email Address" value="{{old('email')}}">
                            <x-error key="email" />
                        </div>

                        <div class="form-group">
                            <label for="super"><strong>Super Admin</strong></label>
                            <select name="super" id="super" class="form-select">
                                <option value="0" selected>No</option>
                                <option value="1">Yes</option>
                            </select>
                            <x-error key="super" />
                        </div>

                        <div class="form-group">
                            <label for="password"><strong>Password</strong></label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password" value="{{old('password')}}">
                            <x-error key="password" />
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-outline-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
