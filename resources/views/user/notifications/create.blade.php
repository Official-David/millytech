@extends('layouts.app')

@section('title','Send Notification')

@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h3 class="mb-3 me-auto">@yield('title')</h3>
    </div>

    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.notifications.store')}}" method="post">
                    @csrf
                    <div class="form-group my-3">
                        <label for="users">User(s)</label>
                        <select name="users[]" id="users" class="form-select select2" multiple>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <x-error key="users" />
                    </div>

                    <div class="form-group mt-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <x-error key="title" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <textarea name="message" id="message" class="form-control" rows="30"></textarea>
                        <x-error key="message" />
                    </div>
                    <div class="text-center mb-3">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-bell"></i>
                            Send Notification(s)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    window.onload = () => $('.select2').select2({
        placeholder: 'Select User(s)'
        , width: 'resolve'
        , theme: 'classic'
    });

</script>
@endpush
