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
                                <th clas='fs-14'>Card</th>
                                <th clas='fs-14'>Amount</th>
                                <th clas='fs-14'>Rate</th>
                                <th clas='fs-14'>Total</th>
                                <th clas='fs-14'>Info</th>
                                <th clas='fs-14'>Type</th>
                                <th clas='fs-14'>Status</th>
                                <th clas='fs-14'>Date</th>
                                <th clas='fs-14'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trades as $trade)
                            <tr class="fs-12">
                                <td>{{$trade->tradeable->name}}</td>
                                <td>{{ $trade->amount }}</td>
                                <td>{{ $trade->rate }}</td>
                                <td>{{ format_money($trade->total) }}</td>
                                <td>
                                    @foreach ($trade->meta ?? [] as $k => $meta)
                                        <strong>{{ucfirst($k)}}</strong>:{{$meta}} @if(!$loop->last) <br> @endif
                                    @endforeach
                                </td>
                                <td>{{ $trade->tradeable_type == \App\Models\GiftCard::class ? 'GiftCard':'Coin' }}</td>
                                <td><span class="badge badge-outline-{{trade_status($trade->status)}}"> {{ strtoupper($trade->status) }} </span></td>
                                <td>{{ $trade->created_at->diffForHumans() }}</td>
                                <td>
                                    <a onclick="show({{$trade->id}})" class="d-block"> <i class="fa fa-eye"></i> Show</a>

                                    {{-- <div class="dropdown dropdown-sm">
                                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu" style="margin: 0px;">
                                            <a class="dropdown-item" href="#"> <i class="fa fa-eye"></i> Show</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div> --}}
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
@endsection

@push('css')
    <style>
        td a{
            cursor:pointer;
        }
    </style>
@endpush

@push('js')
    <script>
        let show = id => {

            fetch(`${window.location.pathname}/show/${id}`)
            .then(res => res.json())
            .then(res => {
                document.querySelector('#show-modal .modal-body').innerHTML = res.html
                $('#show-modal').modal('show')
            })
            .catch(err => console.log(err))
        }
    </script>
@endpush
