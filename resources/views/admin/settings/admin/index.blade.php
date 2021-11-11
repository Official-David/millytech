@extends('layouts.app')

@section('title','Admins')

@section('content')

<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h5 class="mb-3 me-auto">@yield('title')</h5>
    </div>

    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <a href="{{ route('admin.settings.admin.create') }}" class="btn btn-primary btn-sm"><i
                            class="fa fa-plus"></i> Add</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Super</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins   as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td> <a href="{{route('admin.settings.admin.show',$admin->id)}}" class="btn btn-sm btn-outline-{{$admin->super ? 'success':'danger'}}"> <i class="fa fa-{{ $admin->super?'check':'times' }}"></i></a></td>
                                <td>{{ $admin->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="dropdown dropdown-sm">
                                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu" style="margin: 0px;">
                                            <a class="dropdown-item" href="{{route('admin.settings.admin.edit',$admin->id)}}">Edit</a>
                                            @if ($admin->id != auth(config('fortify.guard'))->user()->id)
                                                <a class="dropdown-item" href="{{route('admin.settings.admin.show',$admin->id)}}"> {{$admin->super ? 'Unm':'M'}}ake super</a>
                                                <form action="{{ route('admin.settings.admin.destroy',$admin->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="dropdown-item" href="#">Delete</button>
                                                </form>
                                            @endif
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
                <div class="d-flex justify-content-end pt-3">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
