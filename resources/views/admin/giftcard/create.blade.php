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
                    <form action="{{ route('admin.giftcards.store') }}" method="POST" id="form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><strong>Card name</strong></label>
                            <input class="form-control" type="text" id="card_name" name="name"
                                placeholder="eg. iTunes" value="{{ old('name') }}">
                            <x-error key="name" />
                        </div>

                        <div class="form-group">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" id="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <x-error key="status" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-2">

                            <label><strong>Currencies and Rates</strong></label>

                            <button class="btn btn-sm btn-outline-primary" id="add-currency-rate" type="button"><i
                                    class="fa fa-plus fs-8"></i></button>
                        </div>
                        <div id="currency-rate">
                            @include('includes.add-currency')
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-outline-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let headers = {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
        document.getElementById('card_name').onblur = e => {
            e.target.nextElementSibling.innerHTML = ''
            if(e.target.value != ''){
                fetch("{{route('admin.giftcards.check-name')}}", {
                    method: 'POST',
                    body: JSON.stringify({name: e.target.value}),
                    headers
                })
                .then(async res => {
                    let data = await res.json();
                    if(!res.ok){
                        throw data;
                    }
                    return data;
                })
                .then(data => {
                    if(data.exists){
                        e.target.nextElementSibling.innerHTML = 'The giftcard already exists';
                    }
                })
                .catch(err => {
                    console.log(err);
                    toast('Failed to verify the giftcard name existence');
                })
            }
        }
        document.getElementById('add-currency-rate').addEventListener('click', e => {
            fetch("{{ route('admin.giftcards.add') }}")
                .then(res => res.json())
                .then(res => {
                    document.getElementById('currency-rate').insertAdjacentHTML('beforeend', res.html);
                })
                .catch(err => console.log(err))
        })

        let removeCurrencyRate = (element) => element.parentElement.parentElement.remove()

        let checkEmpty = (param) => {
            if (param.value === '') {
                param.nextElementSibling.innerHTML = 'this field cannot be empty';
                return false;
            }
            return true;
        }

        let checkNumeric = (param) => {
            if (param.value !== '' && isNaN(parseInt(param.value))) {
                param.nextElementSibling.innerHTML = 'only numbers are allowed.';
                return false;
            }
            return true;
        }

        let clearError = element => element.nextElementSibling.innerHTML = '';

        let validate = (e) => {
            e.preventDefault();
            e.preventDefault();

            let data = []
            let passChecks = false;

            let currencies = document.getElementById('currency-rate').querySelectorAll('.currency');
            let rates = document.getElementById('currency-rate').querySelectorAll('.rate');
            let ecode_rates = document.getElementById('currency-rate').querySelectorAll('.ecode_rate');
            let name = document.getElementById('card_name');
            let status = document.getElementById('status');

            clearError(name);
            document.getElementById('currency-rate').querySelectorAll('.currency,.rate,.ecode_rate').forEach((item) => {
                clearError(item);
            })

            rates = Array.from(rates);
            currencies = Array.from(currencies);
            ecode_rates = Array.from(ecode_rates);

            for (i = 0; i < currencies.length; i++) {

                passChecks = (
                    checkEmpty(name) &&
                    checkEmpty(status) &&
                    checkEmpty(currencies[i]) &&
                    checkEmpty(rates[i]) &&
                    checkEmpty(ecode_rates[i]) &&
                    checkNumeric(rates[i]) &&
                    checkNumeric(ecode_rates[i])
                );

                if (passChecks) {
                    data.push({
                        name: currencies[i].value,
                        rate: rates[i].value,
                        ecode_rate: ecode_rates[i].value
                    })
                }

            }

            if (data.length > 0) {
                create(data, name.value, status.value)
            } else {
                alert('At least a currency and it\'s rates are required');
            }

        }

        let create = (data, name, status) => {
            fetch("{{ route('admin.giftcards.store') }}", {
                    method: 'POST',
                    body: JSON.stringify({
                        meta: data,
                        name: name,
                        status: status,
                    }),
                    headers
                })
                .then(async res => {
                    var data = await res.json()
                    if(!res.ok){
                        throw data;
                    }
                    return data;
                })
                .then(res => {
                    toast('Card created successfully');
                    setInterval(() => {
                        window.location.href = "{{ route('admin.giftcards.index') }}"
                    }, 1300);
                })
                .catch(err => {
                    console.log(err)
                    toast('An error occured, failed to create card','error');
                })
        }
        document.getElementById('form').addEventListener('submit', e => validate(e))
    </script>
@endpush
