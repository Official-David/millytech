@extends('layouts.app')

@section('title', 'Create Card')
@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h2 class="mb-3 me-auto">@yield('title')</h2>
    </div>

    <div class="col-lg-6 col-sm-12 m-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.giftcards.update',$giftcard->id)}}" method="POST" id="form">
                    @csrf
                    <div class="form-group">
                        <label for="name"><strong>Card name</strong></label>
                        <input class="form-control" type="text" id="card_name" name="name" placeholder="eg. iTunes"
                            value="{{$giftcard->name}}">
                        <x-error key="name" />
                    </div>
                    <div class="d-flex justify-content-between align-items-center pb-2">

                        <label><strong>Currencies and Rates</strong></label>

                        <button class="btn btn-sm btn-outline-primary" id="add-currency-rate" type="button"><i
                                class="fa fa-plus fs-8"></i></button>
                    </div>
                    <div id="currency-rate">
                        @foreach ($giftcard->currencies as $currency)
                        @include('includes.add-currency',['currency' => $currency->name, 'rate' => $currency->rate])
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.getElementById('add-currency-rate').addEventListener('click', e => {
        fetch("{{route('admin.giftcards.add')}}")
        .then(res => res.json())
        .then(res => {
            document.getElementById('currency-rate').insertAdjacentHTML('beforeend', res.html);
        })
        .catch(err => console.log(err))
    })

    let removeCurrencyRate = (element) =>  element.parentElement.parentElement.remove()

    let create = (e) => {
        e.preventDefault();
        let data = [];
        let tempCurrency,tempRate,errors = false;
        document.getElementById('currency-rate').querySelectorAll('.currency,.rate').forEach((item)=>{
            item.nextElementSibling.innerHTML = '';
        })
        let currencies = document.getElementById('currency-rate').querySelectorAll('.currency')
        let rates = document.getElementById('currency-rate').querySelectorAll('.rate')
        rates = Array.from(rates);
        currencies = Array.from(currencies);

        for(i=0; i < currencies.length; i++)
        {
            if(currencies[i].value == ''){
                currencies[i].nextElementSibling.innerHTML = 'this field cannot be empty';
                errors = true;
            }
            if(rates[i].value == ''){
                rates[i].nextElementSibling.innerHTML = 'this field cannot be empty';
                errors = true;
            }

            if(rates[i].value != '' && isNaN(parseInt(rates[i].value))){
                rates[i].nextElementSibling.innerHTML = 'only numbers are allowed.';
                errors = true;
            }

                name = currencies[i].value;
                rate = rates[i].value;
                data.push({name,rate})

        }

        if(errors) return false;

        fetch("{{route('admin.giftcards.update',$giftcard->id)}}",{
            method:'PUT',
            body: JSON.stringify({
                "meta" : data,
                "name" : document.getElementById('card_name').value
            }),
            headers:{
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": "{{csrf_token()}}"
            }
        })
        .then(res => res.json())
        .then(res => {
            // alert('Updated successfully');
            window.location.href = "{{route('admin.giftcards.index')}}"
        })
        .catch(err => {
            console.log(err)
        })

    }

    document.getElementById('form').addEventListener('submit', e => create(e))


</script>
@endpush
