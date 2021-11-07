@extends('layouts.app')

@section('title', 'Create Country')
@section('content')
    <div class="container-fluid">
        <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
            <h5 class="mb-3 me-auto">@yield('title')</h5>
        </div>

        <div class="col-lg-5 col-sm-12 m-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.currencies.store')}}" method="POST" class="pt-4 pb-4">
                        @csrf
                        <div class="form-group mb-5">
                            <label for="name"><strong>Currency</strong></label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="eg. USD" value="{{old('name')}}">
                            <x-error :key="'name'" />
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
