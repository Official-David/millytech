@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

    <div class="container-fluid">
        <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
            <h3 class="mb-3 me-auto">@yield('title')</h3>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $notification)
                                    <tr @class(['table-active' => !$notification->pivot->read])>
                                        <td>{{ $notification->title }}</td>
                                        <td>{{ Str::limit($notification->message, 40) }}</td>
                                        <td>
                                            <span @class(['text-danger' => !$notification->pivot->read])>
                                                {{ $notification->pivot->read ? 'Read' : 'Unread' }}
                                            </span>
                                        </td>
                                        <td>{{ $notification->created_at->format('d, M, Y - h:ia') }}</td>
                                        <td>
                                            <form method="POST" action="{{route('user.notifications.destroy', $notification->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    data-show-url="{{ route('user.notifications.show', $notification->id) }}"
                                                    type="button"
                                                    class="btn btn-outline-primary btn-sm show-notification"
                                                >
                                                    <i class="far fa-eye"></i>
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-danger btn-sm delete-notification"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="6"
                                            class="text-center text-muted fs-12"
                                        >No notificatios yet</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end pt-3">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="modal fade"
        id="notification-modal"
        style="display: none;"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-dialog-centered"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notification Details</h5>
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

@push('css')
<style>
    .form-control {
        font-size: 1.2em;
    }
</style>

@endpush

@push('js')
    <script>
        $(() => {

            document.querySelectorAll('button.show-notification').forEach(element => {
                element.addEventListener('click', e => {
                    fetch(element.dataset.showUrl)
                    .then(res => res.json())
                    .then(res => {
                        document.querySelector('#notification-modal .modal-body').innerHTML = res.html
                        $('#notification-modal').modal('show')
                    })
                    .catch(err => console.log(err))
                })
            });

            document.querySelectorAll('button.delete-notification').forEach(element => {
                element.addEventListener('click', e => {
                    if(confirm('Are you sure you want to delete this notification?')){
                        element.parentElement.submit();
                    }
                })
            })
        })






        // document.querySelectorAll('.status-switch').forEach((item) => {
        //     item.addEventListener('change', e => {

        //     })
        // })
    </script>
@endpush
