<div>
    <div class="form-group mb-3">
        <label for="status"><strong>Status</strong></label>
        <select name="status" id="status" class="wide">
            @foreach (['pending', 'processing', 'rejected', 'verified'] as $status)
                <option value="{{$status}}" {{$trade->status == $status ? 'selected' : ''}}>{{ucfirst($status)}}</option>
            @endforeach
        </select>
        <x-error key="status" />
    </div>

    <div class="form-group mb-3 d-none" id="rejection_message_container">
        <label for="reject_message"><strong>Rejection Message</strong></label>
        <textarea name="reject_message" id="reject_message" cols="30" rows="10" class="form-control"></textarea>
        <x-error key="reject_message" />
    </div>

    <button class="w-100 btn btn-outline-success" onclick="changeStatus('{{route('admin.trade.change-status', $trade->id)}}')">Update Status</button>
</div>
