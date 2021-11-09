@extends('layouts.app')

@section('title','Trade history')

@section('content')

<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h6 class="mb-3 me-auto">@yield('title')</h6>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Card</th>
                                <th>Amount</th>
                                <th>Rate</th>
                                <th>Total</th>
                                <th>Info</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trades as $trade)
                            <tr>
                                <td>{{$trade->tradeable->name}}</td>
                                <td>{{ $trade->amount }}</td>
                                <td>{{ $trade->rate }}</td>
                                <td>&#8358;{{ number_format($trade->total) }}</td>
                                <td>
                                    @foreach ($trade->meta ?? [] as $k => $meta)
                                    <strong>{{ucfirst($k)}}</strong>:{{$meta}} @if(!$loop->last) <br> @endif
                                    @endforeach
                                </td>
                                <td>{{ $trade->tradeable_type == \App\Models\GiftCard::class ? 'GiftCard':'Coin' }}</td>
                                <td>
                                    @if(in_array($trade->status,['rejected','paid']))
                                    <span class="badge badge-outline-{{trade_status($trade->status)}}"> {{
                                        strtoupper($trade->status) }} </span>
                                    @else
                                    <select id="" class="form-select small status-switch" data-id="{{$trade->id}}">
                                        @foreach (['pending','processing','rejected'] as $status)
                                        <option value="{{$status}}">{{strtoupper($status)}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </td>
                                <td>{{ $trade->created_at->diffForHumans() }}</td>
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
                                            <a class="dropdown-item" onclick="show({{$trade->id}})" class="d-block"> <i
                                                    class="fa fa-eye"></i>
                                                Show</a>
                                                @if (auth(config('fortify.guard'))->user()->super)
                                                <a class="dropdown-item" onclick="payForm({{$trade->id}})" class="d-block"> <i
                                                        class="fa fa-lock"></i>
                                                    Pay</a>
                                                @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No trades yet!</td>
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

    #recept-preview{
        padding: 20px 5px;
    }
    #recept-preview img{
        width: 100%;
        height: auto;
    }
</style>
@endpush

@push('js')
<script>

    let uploaded = e => {
        let url = URL.createObjectURL(e.target.files[0])
          document.getElementById('recept-preview').innerHTML = `<img src="${url}" >`
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

        document.querySelectorAll('.status-switch').forEach((item) => {
            item.addEventListener('change', e => {
                fetch(`${location.pathname}/change-status/${e.target.dataset.id}`,{
                    method: 'post',
                    headers:{
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": "{{csrf_token()}}"
                    },
                    body: JSON.stringify({
                        status : e.target.value
                    })
                })
                .then(res => {
                    if(!res.ok){
                        throw 'Error Occured'
                    }
                    return res.json()
                })
                .then(res => {
                    alert('status changed');
                    location.reload()
                })
                .catch(err => console.log(err))
            })
        })
</script>
@endpush
