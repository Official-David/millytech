<form id="pay-form" action="{{route('admin.trade.pay',$trade->id)}}" enctype="multipart/form-data" class="text-center"
    method="POST">
    @csrf
    <input type="file" name="receipt" id="receipt" style="display: none" onchange="uploaded(event)" accept="image/*">
    <label for="receipt" class="btn btn-outline-primary btn-sm">
        Upload receipt <i class="fa fa-upload"></i>
    </label>
    <div id="recept-preview">

    </div>
</form>
