@php
    $rand_id = Str::random(10);
@endphp
<div class="col-6">
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for=""><strong>Currency</strong></label>
                <input
                    type="text"
                    class="form-control"
                    value="{{ $trade_item?->currency ?? 'Deleted' }}"
                    disabled
                >
            </div>

            <div class="form-group">
                <label for="{{ $rand_id }}_amount"><strong>Amount</strong></label>
                <input
                    type="text"
                    class="form-control"
                    value="{{ $trade_item?->amount }}"
                    id="{{ $rand_id }}_amount"
                    disabled
                >
            </div>

            <div class="form-group">
                <label for="{{ $rand_id }}_type">Card type</label>
                <input
                    type="text"
                    class="form-control"
                    value="{{ $trade_item?->type }}"
                    disabled
                >
            </div>
            @if ($trade_item->type == 'ecode')
                <div class="form-group mt-3">
                    <label for="{{ $rand_id }}_ecode">Ecode</label>
                    <div @class([
                        "mb-3","input-group  input-primary" => request()->isAdmin()
                    ])>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $trade_item?->ecode }}"
                        >
                        @if(request()->isAdmin())
                        <button onclick="copy('{{ $trade_item?->ecode }}', 'Ecode coppied to clipboard')" class="input-group-text">Copy</button>
                        @endif
                    </div>
                </div>
            @else
                <label>Actions</label>
                <div class="form-group mt-3 d-flex justify-content-between">
                    <a
                        target="blank"
                        href="{{ asset('storage/card_images/' . $trade_item->image) }}"
                        class="btn btn-outline-primary btn-sm"
                    >
                        <i class="fa fa-eye"></i>
                        View
                    </a>
                    <a
                        download
                        target="blank"
                        href="{{ asset('storage/card_images/' . $trade_item->image) }}"
                        class="btn btn-outline-primary btn-sm"
                    >
                        <i class="fa fa-download"></i>
                        Download
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
