<div class="row">
    <div class="form-group col-md-12">
        <label for=""><strong>User</strong></label>
        <input type="text" class="form-control" value="{{$trade->user->name}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for=""><strong>Status</strong></label>
        <input type="text" class="form-control" value="{{$trade->status}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for=""><strong>Type</strong></label>
        <input type="text" class="form-control" value="{{ $trade->tradeable_type == \App\Models\GiftCard::class ? 'GiftCard':'Coin' }}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for=""><strong>Total</strong></label>
        <input type="text" class="form-control" value="&#8358;{{number_format($trade->total)}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for=""><strong>Card</strong></label>
        <input type="text" class="form-control" value="{{ucfirst($trade->tradeable->name)}}" disabled>
    </div>
    <h5 class="py-3">Trade Items</h5>
    @foreach ($trade->trade_items as $k => $trade_item)
        @include('components.giftcard-details-show', ['trade_item' => $trade_item, 'currencies' => $trade->tradeable->currencies])
    @endforeach
</div>
