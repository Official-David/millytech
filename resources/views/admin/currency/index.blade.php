@extends('layouts.app')

@section('title','Countries')

@section('content')

<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h5 class="mb-3 me-auto">@yield('title')</h5>
    </div>

    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <a href="{{ route('admin.currencies.create') }}" class="btn btn-primary btn-sm"><i
                            class="fa fa-plus"></i> Add</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-responsive-sm">
                        {{-- <thead>
                            <tr>
                                <th>Currency</th>
                                <th></th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            @forelse ($currencies as $currency)
                            <tr>
                                <td>{{ $currency->name }}</td>
                                <td>
                                    <div class="dropdown dropdown-sm">
                                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu" style="margin: 0px;">
                                            <a class="dropdown-item" href="{{route('admin.currencies.edit',$currency->id)}}">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center pt-3">
                    {{ $currencies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
