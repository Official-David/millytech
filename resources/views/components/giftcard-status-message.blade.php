<div class="row">
    <div class="form-group col-md-12">
        <label for=""><strong>User</strong></label>
        <input type="text" class="form-control" value="{{$trade?->user?->name}}" disabled>
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
    <div class="form-group col-md-12">
        <label for=""><strong>Status Message</strong></label>
        <textarea class="form-control" readonly disabled>{{$trade->reject_message}}</textarea>
    </div>
</div>
