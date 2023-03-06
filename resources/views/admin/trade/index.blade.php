@extends('layouts.app')

@section('title', 'Trade history')

@section('content')

    <div class="container-fluid">
        <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
            <h3 class="mb-3 me-auto">@yield('title')</h3>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.trade.index') }}">
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <select name="fstatus" id="status-filter">
                                    <option>Filter by status</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="paid">Paid</option>
                                    <option value="rejected">Rejected</option>
                                    <option value="verified">Verified</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div @class(['mb-3 input-group  input-primary'])>
                                    <input type="text" class="form-control" name="search"
                                        value="{{ request()->input('search') }}">
                                    <button type="submit" class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="table-responsive" style="min-height: 300px">
                    <table class="table table-hover table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>User</th>
                                <th>Card</th>
                                <th>Type</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trades as $trade)
                                <tr>
                                    <td>{{ $trade->reference }}</td>
                                    <td>
                                        {{ $trade->user->name }}
                                        @if ($trade->user->alert_type)
                                            <i @class([
                                                'fa fa-exclamation-triangle fs-18',
                                                'text-danger' => $trade->user->alert_type == 'scam_alert',
                                                'text-warning' => $trade->user->alert_type == 'payment_alert',
                                            ]) data-bs-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                data-bs-title="{{ $trade->user->alert_message }}"></i>
                                        @endif
                                    </td>
                                    <td>{{ $trade->tradeable->name }}</td>
                                    <td>{{ $trade->tradeable_type == \App\Models\GiftCard::class ? 'GiftCard' : 'Coin' }}</td>
                                    <td>{{ format_money($trade->total) }}</td>
                                    <td>
                                        <span @class([
                                            'badge',
                                            'badge-outline-success' => $trade->status == 'paid',
                                            'badge-outline-danger' => $trade->status == 'rejected',
                                            'badge-outline-info' => $trade->status == 'processing',
                                            'badge-outline-primary' => $trade->status == 'pending',
                                            'badge-outline-light' => $trade->status == 'verified',
                                        ])>
                                            {{ strtoupper($trade->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $trade->created_at->format('d-m-Y - h:ia') }}</td>
                                    <td>
                                        <div class="dropdown dropdown-sm">
                                            <button type="button" class="btn btn-success light sharp"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24">
                                                        </rect>
                                                        <circle fill="#000000" cx="5" cy="12" r="2">
                                                        </circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2">
                                                        </circle>
                                                        <circle fill="#000000" cx="19" cy="12" r="2">
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu" style="margin: 0px;">
                                                <a class="dropdown-item" onclick="show({{ $trade->id }})"
                                                    class="d-block"> <i class="fa fa-eye"></i>
                                                    Show</a>
                                                @if (in_array($trade->status, ['pending', 'processing']))
                                                    <button class="dropdown-item"
                                                        onclick="showChangeStatusModal('{{ route('admin.trade.change-status-modal', $trade->id) }}')">
                                                        <i class="fa fa-edit"></i>
                                                        Update Status
                                                    </button>
                                                @endif
                                                @if (auth(config('fortify.guard'))->user()->super && $trade->status == 'verified')
                                                    <a class="dropdown-item" onclick="payForm({{ $trade->id }})">
                                                        <i class="fa fa-lock"></i>
                                                        Pay
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No trades yet!</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end pt-3">
                    {{ $trades->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="show-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal"> <i
                            class="fa fa-times"></i> Cancel</button>
                    <button type="button" class="btn btn-success light" id="pay">Pay <i class="fa fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change-status" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload payment receipt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // let uploaded = e => {
        //     let url = URL.createObjectURL(e.target.files[0])
        //       document.getElementById('recept-preview').innerHTML = `<img src="${url}" >`
        // }

        $('select').niceSelect();

        $('#status-filter').on('change', e => {
            $(e.target).parent().parent().parent().submit();
        });

        $(document).on('change', 'select[name=status]', e => {
            var el = document.querySelector('#rejection_message_container');
            if (e.target.value == 'rejected' || e.target.value == 'verified') {
                el.classList.remove('d-none');
            } else {
                el.classList.add('d-none');
            }
        });

        let copy = (text, message = null) => {
            navigator.clipboard.writeText(text)
            toast(message ?? 'Copied to clipboard', 'info')
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

        let showChangeStatusModal = url => {

            fetch(url)
                .then(res => res.json())
                .then(res => {
                    document.querySelector('#change-status .modal-body').innerHTML = res.html
                    $('select').niceSelect();
                    $('#change-status').modal('show');
                })
                .catch(error => {
                    toast('Failed to load status data', 'error');
                });

        }

        let changeStatus = url => {
            var reject_message = document.querySelector('textarea[name=reject_message]');
            var status = document.querySelector('select[name=status]');
            var postData = {
                status: status.value,
                reject_message: ''
            }
            if (reject_message != '') {
                postData.reject_message = reject_message.value;
            }

            fetch(url, {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(postData)
                })
                .then(async res => {

                    var data = await res.json();
                    try {
                        if (!res.ok) throw data;
                        return data;
                    } catch (error) {
                        throw error;
                    }
                })
                .then(res => {
                    toast('Status changed successfully')
                    setTimeout(() => location.reload(), 1200);
                })
                .catch(err => {
                    if (err.hasOwnProperty('errors')) {
                        if (err.errors.hasOwnProperty('status')) {
                            status.nextElementSibling.nextElementSibling.innerHTML = err.errors.status
                        }
                        if (err.errors.hasOwnProperty('reject_message')) {
                            reject_message.nextElementSibling.innerHTML = err.errors.reject_message
                        }
                        return;
                    }
                    toast('Failed to update status', 'error')
                })
        }
    </script>
@endpush


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
