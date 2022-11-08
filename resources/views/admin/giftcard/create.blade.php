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
                create(data, name.value)
            } else {
                alert('At least a currency and it\'s rates are required');
            }

        }

        let create = (data, name) => {
            fetch("{{ route('admin.giftcards.store') }}", {
                    method: 'POST',
                    body: JSON.stringify({
                        meta: data,
                        name: name
                    }),
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(res => res.json())
                .then(res => {
                    alert('created successfully');
                    window.location.href = "{{ route('admin.giftcards.index') }}"
                })
                .catch(err => {
                    console.log(err)
                })
        }
        document.getElementById('form').addEventListener('submit', e => validate(e))
    </script>
@endpush
