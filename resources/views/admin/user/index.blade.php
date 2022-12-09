@extends('layouts.app')

@section('title', 'Users')

@section('content')

    <div class="container-fluid">
        <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">@yield('title')</h2>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div
                        class="table-responsive"
                        style="min-height: 300px"
                    >
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th class="fs-14">Name</th>
                                    <th class="fs-14">Email</th>
                                    <th class="fs-14">Gender</th>
                                    <th class="fs-14">Country</th>
                                    <th class="fs-14">City</th>
                                    <th class="fs-14">Status</th>
                                    <th class="fs-14">Joined</th>
                                    <th class="fs-14">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="fs-12">
                                        <td>
                                            {{ $user->name }}
                                            @if($user->alert_type)
                                            <i
                                                @class([
                                                    'fa fa-exclamation-triangle fs-18',
                                                    'text-danger' => ($user->alert_type == 'scam_alert'),
                                                    'text-warning' => ($user->alert_type == 'payment_alert'),
                                                ])
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                data-bs-title="{{$user->alert_message}}"
                                            ></i>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->country }}</td>
                                        <td>{{ $user->city }}</td>
                                        <td>
                                            <span class="badge badge-outline-{{ user_status($user->status) }}">
                                                {{ strtoupper($user->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="dropdown dropdown-sm">
                                                <button
                                                    type="button"
                                                    class="btn btn-success light sharp"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                >
                                                    <svg
                                                        width="20px"
                                                        height="20px"
                                                        viewBox="0 0 24 24"
                                                        version="1.1"
                                                    >
                                                        <g
                                                            stroke="none"
                                                            stroke-width="1"
                                                            fill="none"
                                                            fill-rule="evenodd"
                                                        >
                                                            <rect
                                                                x="0"
                                                                y="0"
                                                                width="24"
                                                                height="24"
                                                            ></rect>
                                                            <circle
                                                                fill="#000000"
                                                                cx="5"
                                                                cy="12"
                                                                r="2"
                                                            ></circle>
                                                            <circle
                                                                fill="#000000"
                                                                cx="12"
                                                                cy="12"
                                                                r="2"
                                                            ></circle>
                                                            <circle
                                                                fill="#000000"
                                                                cx="19"
                                                                cy="12"
                                                                r="2"
                                                            ></circle>
                                                        </g>
                                                    </svg>
                                                </button>
                                                <div
                                                    class="dropdown-menu"
                                                    style="margin: 0px;"
                                                >
                                                    <a
                                                        class="dropdown-item"
                                                        href="{{ route('admin.user.edit', $user->id) }}"
                                                    >Edit</a>
                                                    @if ($user->status != 'pending')
                                                        <a
                                                            class="dropdown-item"
                                                            href="{{ route('admin.user.show', $user->id) }}"
                                                        >{{ $user->status == 'active' ? 'Deactivate' : 'Activate' }}
                                                            Account</a>
                                                    @endif
                                                    <button
                                                        onclick="showAlertModal('{{ route('admin.user.alert', $user->id) }}')"
                                                        class="dropdown-item"
                                                    >Add Alert</button>
                                                    @if ($user->alert_type)
                                                        <button
                                                            onclick="clearAlert('{{ route('admin.user.alert', $user->id) }}')"
                                                            class="dropdown-item"
                                                        >Remove alert</button>
                                                    @endif
                                                    <a
                                                        class="dropdown-item delete-user"
                                                        style="cursor: pointer"
                                                    >Delete</a>
                                                    <form
                                                        action="{{ route('admin.user.destroy', $user->id) }}"
                                                        method="POST"
                                                    >
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="6"
                                            class="text-center"
                                        >No data found </td>
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

    <div
        class="modal fade"
        id="alert-modal"
        style="display: none;"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-dialog-centered"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Alert</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    >
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger light"
                        data-bs-dismiss="modal"
                    >Close</button>
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
                if (confirm('Are you sure you want to delete this user?', 'Yes', 'No')) {
                    e.target.nextElementSibling.submit();
                }

            })
        });
        let showAlertModal = url => {
            fetch(url)
                .then(async res => {
                    let data = await res.json();
                    try {
                        if (!res.ok) throw data;
                        return data;
                    } catch (error) {
                        throw error;
                    }
                })
                .then(data => {
                    document.querySelector('#alert-modal .modal-body').innerHTML = data.html
                    $('#alert-modal').modal('show');
                    document.querySelector('#alert-modal .modal-body form').addEventListener('submit',
                        handleAlertSubmit)
                })
                .catch(err => {
                    console.log(err);
                    toast('Failed to load alert information', 'error');
                    // if(err.hasOwnProperty('errors')){
                    //     for(let key in err.errors){
                    //         document.querySelector(key).nextE
                    //     }
                    // }
                })
        }

        let clearAlert = url => {
            fetch(url, {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        _method: 'delete'
                    })
                })
                .then(res => {
                    if (!res.ok) throw new Error('Failed to remove alert');
                    return res.json();
                })
                .then(d => {
                    toast('Alert removed from user account')
                    setTimeout(() => {
                        window.location.reload();
                    }, 1200);
                })
                .catch(err => console.log(err.message ?? 'We were unable to remove the alert.'))
        }

        let handleAlertSubmit = e => {
            e.preventDefault();
            let formData = Object.fromEntries(new FormData(e.target));
            fetch(e.target.action, {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(formData),
                }).then(async res => {
                    let data = await res.json();
                    try {
                        if (!res.ok) throw data;
                        return data;
                    } catch (error) {
                        throw error;
                    }
                })
                .then(data => {
                    toast('Alert added to account');
                    document.querySelector('#alert-modal .modal-body').innerHTML = ''
                    $('#alert-modal').modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1200);
                })
                .catch(err => {
                    if (err.hasOwnProperty('errors')) {
                        for (let error in err.errors) {
                            document.querySelector('#' + error).nextElementSibling.innerHTML = err.errors[error]
                        }
                        return;
                    }
                    if (err.hasOwnProperty('error_message')) {
                        toast(err.error_message, 'error');
                        return;
                    }
                    toast('Failed to submit alert data.', 'error')
                })
        }
    </script>
@endpush
