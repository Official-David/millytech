<div class="row">
    <div class="form-group col-md-6">
        <label for=""><strong>Amount</strong></label>
        <input type="text" class="form-control" value="{{$trade->amount}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for=""><strong>Rate</strong></label>
        <input type="text" class="form-control" value="{{$trade->rate}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for=""><strong>Total</strong></label>
        <input type="text" class="form-control" value="&#8358;{{number_format($trade->total)}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for=""><strong>Status</strong></label>
        <input type="text" class="form-control" value="{{$trade->status}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for=""><strong>Type</strong></label>
        <input type="text" class="form-control" value="{{ $trade->tradeable_type == \App\Models\GiftCard::class ? 'GiftCard':'Coin' }}" disabled>
    </div>
    @foreach ($trade->meta as $k => $meta)
    <div class="form-group col-md-6">
        <label for=""><strong>{{ucfirst($k)}}</strong></label>
        <input type="text" class="form-control" value="{{$meta}}" disabled>
    </div>
    @endforeach

    <div class="form-group col-md-6">
        <label for=""><strong>Image</strong></label>
        <a href="{{asset(config('dir.card_image').$trade->image)}}" target="_blank" rel="noopener noreferrer">
            <img src="{{asset(config('dir.card_image').$trade->image)}}" alt="" style="width:100%">
        </a>
    </div>
    @if(!is_null($trade->receipt))
    <div class="form-group col-md-6">
        <label for=""><strong>Payment Receipt</strong></label>
        <a href="{{asset(config('dir.receipt').$trade->receipt)}}" target="_blank" rel="noopener noreferrer">
            <img src="{{asset(config('dir.receipt').$trade->receipt)}}" alt="" style="width:100%">
        </a>
    </div>
    @endif
</div>
