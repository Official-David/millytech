@error($key)
<span class="text-sm text-danger d-block fs-12" id="{{$key}}_error">{{$message}}</span>
@else
<span class="text-sm text-danger d-block fs-12" id="{{$key}}_error"></span>
@enderror
