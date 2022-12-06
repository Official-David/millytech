@extends('layouts.app')

@section('title','Users')

@section('content')

<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h2 class="mb-3 me-auto">@yield('title')</h2>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="min-height: 300px">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th class="fs-14">Firstname</th>
                                <th class="fs-14">Lastname</th>
                                <th class="fs-14">Email</th>
                                <th class="fs-14">Status</th>
                                <th class="fs-14">Joined</th>
                                <th class="fs-14">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr class="fs-12">
                                <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge badge-outline-{{user_status($user->status)}}">
                                            {{strtoupper($user->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="dropdown dropdown-sm">
                                        <button type="button" class="btn btn-success light sharp"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                    <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                    <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                </g>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" style="margin: 0px;">
                                            <a class="dropdown-item" href="{{route('admin.user.edit',$user->id)}}">Edit</a>
                                            @if ($user->status != 'pending')
                                                <a class="dropdown-item" href="{{route('admin.user.show',$user->id)}}">{{$user->status == 'active'?'Deactivate':'Activate'}} Account</a>
                                            @endif
                                            <button class="dropdown-item">Add Alert</button>
                                            <a class="dropdown-item delete-user" style="cursor: pointer">Delete</a>
                                            <form action="{{route('admin.user.destroy',$user->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No data found </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center pt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        document.querySelectorAll('a.delete-user').forEach(element => {

            element.addEventListener('click', e => {
                e.preventDefault();
                if(!confirm('Are you sure you want to delete this user?','Yes','No')) return;

                e.target.nextElementSibling.submit();

            })
        });
    </script>
@endpush
