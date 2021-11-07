@extends('layouts.app')

@section('title', 'Create Card')
@section('content')
<div class="container-fluid">
    <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
        <h6 class="mb-3 me-auto">@yield('title')</h6>
    </div>

    <div class="col-lg-6 col-sm-12 m-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.giftcards.store')}}" method="POST" id="form">
                    @csrf
                    <div class="form-group pt-5">
                        <label for=""> <strong>Card</strong> </label>
                        <select name="" id="giftcard" class="form-select form-select-lg form-control wide fs-12">
                            <option value="">Select a Card</option>
                            @foreach ($giftcards as $giftcard)
                                <option value="{{$giftcard->id}}">{{ $giftcard->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group pt-5">
                        <label for=""><strong>Currency</strong></label>
                        <select name="" id="currencies" class="form-select form-select-lg form-control wide fs-12">
                            <option value="">Select Currency</option>

                        </select>
                    </div>

                    <div class="form-group pt-5">
                        <label for=""><strong>Rate</strong></label>
                        <input type="text" id="rate" class="form-control fs-12" disabled readonly>
                    </div>

                    <div class="form-group">
                        <label for=""><strong>Amount</strong></label>
                        <input type="text" class="form-control fs-12">
                    </div>

                    <div class="form-group">
                        <input type="file" id="upload" style="display: none" accept="image/*">
                        <label for="upload" class="btn btn-outline-primary">Upload <i class="fa fa-upload"></i></label>
                    </div>
                    <div id="preview">

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
        $('select').niceSelect();
      document.getElementById('giftcard').onchange = (e) => {
          fetch(window.location.href + `/currencies/${e.target.value}`)
          .then(res => res.json())
          .then(res => {
              document.getElementById('currencies').insertAdjacentHTML('beforeend', res.html);
              $('select').niceSelect('update');
          })
          .catch(err => console.log(err))
      }

      document.getElementById('currencies').onchange = (e) => {
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

    </style>
@endpush
