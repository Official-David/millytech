@extends('layouts.app')

@section('title', 'Gift Cards')

@section('content')

    <div class="container-fluid">
        <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">@yield('title')</h2>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="trade_status" {{config('system.trading') == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="trade_status">
                                <strong>Trade Status</strong>
                            </label>
                        </div>

                        <a
                            href="{{ route('admin.giftcards.create') }}"
                            class="btn btn-primary btn-sm"
                        ><i class="fa fa-plus"></i> Add</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Normal Rates</th>
                                    <th>Ecode Rates</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($giftcards as $giftcard)
                                    <tr>
                                        <td>{{ $giftcard->name }}</td>
                                        <td>
                                            @foreach ($giftcard->currencies as $currency)
                                                {{ $currency->name }}:{{ $currency->rate }}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($giftcard->currencies as $currency)
                                                {{ $currency->name }}:{{ $currency->ecode_rate }}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <span @class([
                                                'badge',
                                                'badge-outline-success' => $giftcard->status == 'active',
                                                'badge-outline-danger' => $giftcard->status == 'inactive',
                                            ])>
                                                {{ ucfirst($giftcard->status) }}
                                            </span>
                                        </td>
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
                                                        href="{{ route('admin.giftcards.edit', $giftcard->id) }}"
                                                    >Edit</a>
                                                    <a
                                                        class="dropdown-item"
                                                        href="{{ route('admin.giftcards.destroy', $giftcard->id) }}"
                                                    >Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="5"
                                            class="text-center"
                                        >No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center pt-3">
                        {{ $giftcards->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById('trade_status').onchange = e => {
            e.preventDefault();
            e.stopPropagation();
            return e.target.checked ? handleActivate(e) : handleDeactivate(e)
        }

        let handleActivate = e => {
            if(!confirm('Are you sure you want to activate trade?')){
                return e.target.checked = false;
            }
            submitData();
        }

        let handleDeactivate = e => {
            if(!confirm('Are you sure you want to deactivate trade?')) {
                return e.target.checked = true;
            }
            submitData();
        }

        let submitData = () => {
            fetch("{{route('admin.settings.deactivate-trading')}}",{
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(async res => {
                let data = res.json();
                if(!res.ok)
                {
                    throw data;
                }
                return data;
            })
            .then(data => {
                toast(data.message);
            })
            .catch(err => {
                if(err.hasOwnProperty('message')){
                    return toast(err.message,'error');
                }
                toast('An error occurred trying to ')
            })
        }
    </script>
@endpush

@push('css')
    <style>
        .form-check-input:checked {
            background-color: var(--bs-success);
            border-color: var(--bs-success);
        }
    </style>
@endpush
