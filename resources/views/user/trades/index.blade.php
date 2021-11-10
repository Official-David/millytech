@extends('layouts.app')

@section('title', 'Sell GiftCard')
@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h6 class="mb-3 me-auto">@yield('title')</h6>
    </div>

    <div class="col-lg-7 col-sm-12 m-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{route('user.trades.place')}}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group pt-5">
                        <label for=""> <strong>Card</strong> </label>
                        <select name="giftcard" id="giftcard"
                            class="form-select form-select-lg form-control wide fs-12">
                            <option value="">Select a Card</option>
                            @foreach ($giftcards as $giftcard)
                            <option value="{{$giftcard->id}}">{{ $giftcard->name }}</option>
                            @endforeach
                        </select>
                        <x-error key="giftcard" />
                    </div>

                    <div class="form-group pt-5">
                        <label for=""><strong>Currency</strong></label>
                        <select name="currency" id="currencies"
                            class="form-select form-select-sm form-control form-control-sm wide fs-12" disabled>
                            <option value="">Select Currency</option>
                        </select>
                        <x-error key="currency" />
                    </div>

                    <div class="form-group pt-5">
                        <label for=""><strong>Rate</strong></label>
                        <input type="text" name="rate" id="rate" class="form-control fs-12" disabled readonly>
                        <x-error key="rate" />
                    </div>

                    <div class="form-group">
                        <label for=""><strong>Amount</strong></label>
                        <input type="text" name="amount" class="form-control fs-12" id="amount">
                        <x-error key="amount" />
                    </div>

                    <div class="form-group">
                        <label for=""><strong>Total</strong></label>
                        <input type="text" class="form-control fs-12" disabled readonly id="total">
                        <x-error key="total" />
                    </div>

                    <div class="form-group">
                        <input type="file" name="card_image" id="upload" style="display: none" accept="image/*">
                        <label for="upload" class="btn btn-outline-primary btn-sm">Upload <i
                                class="fa fa-upload"></i></label>
                        <x-error key="card_image" />
                    </div>
                    <div id="preview" class="d-flex justify-content-center"></div>




                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">Sell</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('select').niceSelect();
    document.getElementById('amount').oninput = e => {
        e.target.nextElementSibling.innerHTML = ""
        let value = e.target.value
        if(value != '' && isNaN(value)){
            e.target.nextElementSibling.innerHTML = "only numbers are allowed"
            return false
        }
        document.getElementById('total').value = document.getElementById('rate').value * value
    }

    document.getElementById('giftcard').onchange = (e) => {
        document.getElementById('currencies').value = '';
        document.getElementById('rate').value = '';
        fetch(window.location.href + `/currencies/${e.target.value}`)
        .then(res => res.json())
        .then(res => {
            currencies = document.getElementById('currencies')
            currencies.removeAttribute('disabled')
            currencies.insertAdjacentHTML('beforeend', res.html);
            $('select').niceSelect('update');
        })
        .catch(err => console.log(err))
    }

    document.getElementById('currencies').onchange = (e) => {
    document.getElementById('rate').value = '';
        fetch(window.location.href + `/rate/${e.target.value}`)
        .then(res => res.json())
        .then(res => {
            document.getElementById('rate').value = res.rate;
            $('select').niceSelect('update');
        })
        .catch(err => console.log(err))
    }

    document.getElementById('upload').onchange = e => {
        let url = URL.createObjectURL(e.target.files[0])
        document.getElementById('preview').innerHTML = `<img src="${url}" >`
    }
</script>
@endpush

@push('css')
<style>
    #preview img {
        width: 150px;
        height: auto;
    }
</style>
@endpush
