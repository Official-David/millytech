@extends('layouts.app')

@section('title','Notifications')

@section('content')

<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h3 class="mb-3 me-auto">@yield('title')</h3>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <a href="{{route('admin.notifications.create')}}" class="btn btn-outline-primary">
                        <i class="fa fa-bell"></i>
                        Send Notification
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-responsive-sm table-striped">
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
                            <tr>
                                <td>{{$notification->title}}</td>
                                <td>{{$notification->message}}</td>
                                <td>{{$notification->read ? 'Read' : 'Unread'}}</td>
                                <td>{{$notification->created_at->format('d, M, Y')}}</td>
                                <td></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted fs-12">No notificatios yet</td>
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
<div class="modal fade" id="show-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trade Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="receipt-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload payment receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal"> <i class="fa fa-times"></i> Cancel</button>
                <button type="button" class="btn btn-success light" id="pay">Pay <i class="fa fa-check"></i> </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    td a {
        cursor: pointer;
    }

    #recept-preview {
        padding: 20px 5px;
    }

    #recept-preview img {
        width: 100%;
        height: auto;
    }

</style>
@endpush

@push('js')
<script>
    // let uploaded = e => {
    //     let url = URL.createObjectURL(e.target.files[0])
    //       document.getElementById('recept-preview').innerHTML = `<img src="${url}" >`
    // }
    $(() => {
        $('select').niceSelect();
    })
    let copy = () => {
        let txt = document.getElementById('account_number')
        txt.select()
        txt.setSelectionRange(0, 99999)
        navigator.clipboard.writeText(txt.value)
        txt.blur()
        toast('Copied to clipboard', 'info')
    }

    document.getElementById('pay').addEventListener('click', e => {
        document.getElementById('pay-form').submit()
    })

    let show = id => {

        fetch(`${window.location.pathname}/show/${id}`)
            .then(res => res.json())
            .then(res => {
                document.querySelector('#show-modal .modal-body').innerHTML = res.html
                $('#show-modal').modal('show')
            })
            .catch(err => console.log(err))
    }

    let payForm = id => {
        fetch(`${window.location.pathname}/pay-form/${id}`)
            .then(res => res.json())
            .then(res => {
                document.querySelector('#receipt-modal .modal-body').innerHTML = res.html
                $('#receipt-modal').modal('show')
            })
            .catch(err => console.log(err))
    }

    let changeStatus = e => {
        e.preventDefault();
        fetch(`${location.pathname}/change-status/${e.target.dataset.id}`, {
                method: 'post'
                , headers: {
                    "Content-Type": "application/json"
                    , "Accept": "application/json, text-plain, */*"
                    , "X-Requested-With": "XMLHttpRequest"
                    , "X-CSRF-TOKEN": "{{csrf_token()}}"
                }
                , body: JSON.stringify({
                    status: e.target.value
                })
            })
            .then(res => {
                if (!res.ok) {
                    throw 'Error Occured'
                }
                return res.json()
            })
            .then(res => {
                toast('Status changed successfully')
                setTimeout(() => location.reload(), 1200);

            })
            .catch(err => console.log(err))
    }

    // document.querySelectorAll('.status-switch').forEach((item) => {
    //     item.addEventListener('change', e => {

    //     })
    // })

</script>
@endpush
