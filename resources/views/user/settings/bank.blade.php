@extends('layouts.app')

@section('title', 'Account Details')
@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h6 class="mb-3 me-auto">@yield('title')</h6>
    </div>

    <div class="col-lg-6 col-sm-12 m-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{route('user.settings.bank.details.update')}}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group pt-5">
                        <label for=""><strong>Bank name</strong></label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control fs-12" placeholder="Enter bank name" value="{{$user->bank?->bank_name}}">
                        <x-error key="bank_name" />
                    </div>

                    <div class="form-group">
                        <label for=""><strong>Account number</strong></label>
                        <input type="text" name="account_number" class="form-control fs-12" placeholder="Enter account number" value="{{$user->bank?->account_number}}">
                        <x-error key="account_number" />
                    </div>

                    <div class="form-group">
                        <label for=""><strong>Account name</strong></label>
                        <input type="text" name="account_name" class="form-control fs-12" placeholder="Enter account name"value="{{$user->bank?->account_name}}">
                        <x-error key="account_name" />
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
