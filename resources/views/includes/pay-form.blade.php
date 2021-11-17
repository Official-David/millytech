<form id="pay-form" action="{{route('admin.trade.pay',$trade->id)}}" enctype="multipart/form-data" class="text-left"
    method="POST">
    @csrf
    <div class="form-group">
        <label for=""><strong>Account name</strong></label>
        <input type="text" class="form-control" value="{{ $trade->user->bank->account_name }}">
    </div>

    <div class="form-group">
        <label for=""><strong>Account number</strong></label>
        <input type="text" id="account_number" class="form-control" value="{{ $trade->user->bank->account_number }}">
    </div>

    <div class="form-group">
        <label for=""><strong>Bank</strong></label>
        <input type="text" class="form-control" value="{{ $trade->user->bank->bank_name }}">
    </div>

    <div class="form-group">
        <label for=""><strong>Total payable</strong></label>
        <input type="text" class="form-control" value="{{ format_money($trade->total) }}">
    </div>

    <div class="text-end" onclick="copy()">
        <span class="btn btn-sm btn-secondary align-right"><i class="fa fa-copy"></i> Copy Details</span>
    </div>
</form>
