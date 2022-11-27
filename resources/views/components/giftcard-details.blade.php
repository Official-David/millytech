@php
    $rand_id = Str::random(10);
@endphp
<div class="col-6">
    <div class="card shadow">
        <div class="card-body">
            <div class="close-btn">
                <i class="fa fa-times close-btn-x"></i>
            </div>
            <div class="form-group">
                <label for=""><strong>Currency</strong></label>
                <select name="currency" class="form-control wide" id="{{$rand_id}}_currency">
                    <option value="">Select Currency</option>
                    @foreach ($currencies as $currency)
                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                    @endforeach
                </select>
                <x-error key="{{$rand_id}}_currency" />
            </div>

            <div class="form-group">
                <label for="{{$rand_id}}_amount"><strong>Amount</strong></label>
                <input type="text" name="amount" class="form-control fs-12" id="{{$rand_id}}_amount">
                <x-error key="{{$rand_id}}_amount" />
            </div>

            <div class="form-group">
                <label for="{{$rand_id}}_type">Card type</label>
                <select name="type" class="form-control wide card-type" id="{{$rand_id}}_type">
                    <option value="">Select card type</option>
                    <option value="ecode">Ecode</option>
                    <option value="physical">Physical</option>
                </select>
                <x-error key="{{$rand_id}}_type" />
            </div>
            <div class="ecode-card d-none">
                <div class="form-group mt-3">
                    <label for="{{$rand_id}}_ecode">Ecode</label>
                    <input type="text" class="form-control" placeholder="Enter ecode" name="ecode" id="{{$rand_id}}_ecode">
                    <x-error key="{{$rand_id}}_ecode" />
                </div>
            </div>
            <div class="physical-card d-none">
                <div class="form-group mt-3">
                    <label for="{{$rand_id}}_card_image" class="btn btn-outline-primary btn-sm">Upload <i
                            class="fa fa-upload"></i></label>
                    <input type="file" name="card_image" id="{{$rand_id}}_card_image" style="display: none" accept="image/*">
                    <x-error key="{{$rand_id}}_card_image" />
                </div>
                <div class="d-flex justify-content-center preview"></div>
            </div>
        </div>
    </div>
</div>
