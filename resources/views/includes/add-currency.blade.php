<div class="form-group row">
    <div class="col-11 row">
        <div class="col-md-4">
            <input type="text" name="currency[]" class="form-control currency" placeholder="Currency"
                value="{{ $currency ?? '' }}">
            <x-error key="{{ rand() }}" />
        </div>
        <div class="col-md-4">
            <input type="text" name="rate[]" class="form-control rate" placeholder="Rate"
                value="{{ $rate ?? '' }}">
            <x-error key="{{ rand() }}" />
        </div>
        <div class="col-md-4">
            <input type="text" name="ecode_rate[]" class="form-control ecode_rate" placeholder="Ecode Rate"
                value="{{ $ecode_rate ?? '' }}">
            <x-error key="{{ rand() }}" />
        </div>
    </div>
    <div class="col-1 text-end">
        <button class="btn btn-danger btn-sm" onclick="removeCurrencyRate(this)" type="button">
            <i class="fa fa-times"></i>
        </button>
    </div>
</div>
