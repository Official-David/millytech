@extends('layouts.app')

@section('title', 'Sell GiftCard')
@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h6 class="mb-3 me-auto">@yield('title')</h6>
    </div>

    <div class="col-lg-8 col-sm-12 m-auto">
        <div class="card">
            <div class="card-body">
                @if (config('system.trading'))
                <form action="{{ route('user.trades.place') }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="giftcard"> <strong>Giftcard</strong> </label>
                        <select name="giftcard" id="giftcard" class="form-control wide">
                            <option value="">Select Gift card</option>
                            @foreach ($giftcards as $giftcard)
                            <option value="{{ $giftcard->id }}">{{ $giftcard->name }}</option>
                            @endforeach
                        </select>
                        <x-error key="giftcard" />
                    </div>

                    <div class="row g-3" id="card-container">
                    </div>

                    <div class="text-end mt-3">
                        <button type="button" class="btn btn-outline-success btn-sm" id="addCard">Add Card</button>
                    </div>


                    <div class="form-group">
                        <label for=""><strong>Total</strong></label>
                        <input type="text" class="form-control fs-12" disabled readonly id="total">
                        <x-error key="total" />
                    </div>


                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">Sell</button>
                    </div>
                </form>
                @else
                <div class="text-center my-5">
                    <strong>Notice!!!</strong> The trading system is temporarily disabled.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // window.onload = () => {
    //     attachEventsToCardType();
    // }

    const delegate_event = (event_type, ancestor_element, element_class, listener_function) => {
        document.querySelector(ancestor_element).addEventListener(event_type, event => {
            if (event.target && event.target.classList.contains(element_class)) {
                listener_function(event);
            }
        });
    }

    document.getElementById('addCard').onclick = e => {
        var id = document.querySelector('#giftcard').value;
        if (!id) {
            toast('You need to select at least one gift card', 'error');
            return false;
        }
        fetch("{{ url()->current() }}/" + id).then(res => {
            if (!res.ok) {
                throw new Error('Failed to add card');
            }
            return res.json();
        }).then(data => {
            document.querySelector('#card-container').insertAdjacentHTML('beforeend', data.html);
            attachEventsToCardType();
        }).catch(error => {
            console.error(error);
        })
    }
    const attachEventsToCardType = () => {
        let cardContainer = document.getElementById('card-container');
        cardContainer.querySelectorAll('select.card-type').forEach(el => {
            el.onchange = () => {
                let parent = el.parentElement.parentElement;
                let ecodeWrapper = parent.querySelector('div.ecode-card');
                let physicalWrapper = parent.querySelector('div.physical-card');
                if (el.value == 'ecode') {
                    ecodeWrapper.classList.remove('d-none');
                    physicalWrapper.classList.add('d-none');
                } else if (el.value == 'physical') {
                    ecodeWrapper.classList.add('d-none');
                    physicalWrapper.classList.remove('d-none');
                } else {
                    ecodeWrapper.classList.add('d-none');
                    physicalWrapper.classList.add('d-none');
                }
            }
        })

        delegate_event('click', '#card-container', 'close-btn-x', e => {
            e.target.parentElement.parentElement.parentElement.parentElement.remove();
        })

        document.querySelectorAll('input[name=card_image]').forEach((el, index) => {
            el.addEventListener('change', e => {
                el.parentElement.nextElementSibling.innerHTML = '';
                let file = e.target.files[0];
                if (['image/png', 'image/jpg', 'image/jpeg'].includes(file.type)) {
                    console.log(file);
                    let url = URL.createObjectURL(file);
                    el.parentElement.nextElementSibling.innerHTML = `<a href="${url}" target="blank"><img src="${url}"></a>`
                } else {
                    toast('Unsupported file format selected, only png,jpeg and jpg is allowed', 'error');
                }
            })
        })

    }


    $('select').niceSelect();

    let clearErrors = (elements = null) => {
        if(elements != null){
            elements.forEach(el => {
                el.nextElementSibling.innerHTML = '';
            })
        }else{
            document.querySelector('#giftcard').nextElementSibling.innerHTML = '';
        }
    }

    document.getElementById('form').onsubmit = async e => {
        e.preventDefault();
        var currencies = document.getElementsByName('currency');
        var amounts = document.getElementsByName('amount');
        var types = document.getElementsByName('type');
        var ecodes = document.getElementsByName('ecode');
        var card_images = document.getElementsByName('card_image');
        var giftcard = document.querySelector('#giftcard').value

        clearErrors(currencies);
        clearErrors(amounts);
        clearErrors(types);
        clearErrors(ecodes);
        clearErrors(card_images);
        clearErrors();

        if (giftcard == '') {
            toast('Select giftcard type to proceed', 'error');
            return false;
        }
        if (!currencies.length) {
            toast('Please add a card', 'error');
            return false;
        }
        data = {
            giftcard: giftcard,
            cards: [],
        };
        for (let index = 0; index < currencies.length; index++) {
            let card = {
                'currency': currencies[index].value,
                'amount': amounts[index].value,
                'type': types[index].value
            }

            if (types[index].value == 'ecode') {
                card.ecode = ecodes[index].value;
            } else if (types[index].value == 'physical') {
                if(card_images[index].files[0] == Object(card_images[index].files[0])){
                    await convertImage(card_images[index].files[0], result => card.image = result);
                }else{
                    card.image = '';
                }
            }
            data.cards.push(card);
        }

        fetch("{{route('user.trades.place')}}", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            }
        }).then(async res => {
            var data = await res.json();
            try {
                if (!res.ok){
                    throw data;
                }
                return data;
            } catch (error) {
                throw error;
            }
        }).then(data => {
            if(data.hasOwnProperty('message') && data.hasOwnProperty('redirect_uri')){
                toast(data.message);
                setTimeout(() => window.location.href = data.redirect_uri, 1000)
            }
        }).catch(error => {
            if (typeof (error) != 'object' && error != Object(error)) {
                toast('An error ocurred while trying to place your trade.','error');
                return;
            }
                if(error.hasOwnProperty('errors')){
                    for (let index = 0; index < currencies.length; index++) {
                        for (const key in error.errors) {
                            if(`cards.${index}.currency` == key){
                                displayErrors(currencies[index], error.errors[key]);
                            }
                            if(`cards.${index}.amount` == key){
                                displayErrors(amounts[index], error.errors[key]);
                            }
                            if(`cards.${index}.ecode` == key){
                                displayErrors(ecodes[index], error.errors[key]);
                            }
                            if(`cards.${index}.image` == key){
                                displayErrors(card_images[index], error.errors[key]);
                            }
                            if(`cards.${index}.type` == key){
                                displayErrors(types[index], error.errors[key]);
                            }
                        }
                    }
                }else if(error.hasOwnProperty('message')){
                    toast(error.message,'error')
                }

        })
    }

    let displayErrors = (element, message) => element.nextElementSibling.innerHTML = message[0];

    let convertImage = async (file, callback) => {
        await new Promise(resolve => {
            let reader = new FileReader();
            reader.onload = e => resolve(reader.result);
            reader.readAsDataURL(file);
        }).then((result) => callback(result));
    }

        //  document.getElementById('amount').oninput = e => {
        //     e.target.nextElementSibling.innerHTML = ""
        //     let value = e.target.value
        //     if (value != '' && isNaN(value)) {
        //         e.target.nextElementSibling.innerHTML = "only numbers are allowed"
        //         return false
        //     }
        //     document.getElementById('total').value = document.getElementById('rate').value * value
        // }

        // document.getElementById('giftcard').onchange = (e) => {
        //     document.getElementById('currencies').value = '';
        //     document.getElementById('rate').value = '';
        //     fetch(window.location.href + `/currencies/${e.target.value}`)
        //         .then(res => res.json())
        //         .then(res => {
        //             currencies = document.getElementById('currencies')
        //             currencies.removeAttribute('disabled')
        //             currencies.insertAdjacentHTML('beforeend', res.html);
        //             $('select').niceSelect('update');
        //         })
        //         .catch(err => console.log(err))
        // }

        // document.getElementById('currencies').onchange = (e) => {
        //     document.getElementById('rate').value = '';
        //     fetch(window.location.href + `/rate/${e.target.value}`)
        //         .then(res => res.json())
        //         .then(res => {
        //             document.getElementById('rate').value = res.rate;
        //             $('select').niceSelect('update');
        //         })
        //         .catch(err => console.log(err))
        // }
</script>
@endpush

@push('css')
<style>
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        color: red;
        padding: 3px 5px;
        cursor: pointer;
    }

    .preview img {
        width: 150px;
        height: auto;
    }
</style>
@endpush
