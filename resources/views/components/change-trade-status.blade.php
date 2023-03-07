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
        <label for="reject_message"><strong>Message</strong></label>
        <textarea name="reject_message" id="reject_message" cols="30" rows="10" class="form-control"></textarea>
        <x-error key="reject_message" />
    </div>

    <div class="form-group my-3 d-none" id="reject_image_conatainer">
        <input type="file" id="reject_image" name="reject_image" accept="image/*" style="display:none">
        <label for="reject_image">
            <span class="d-block mb-2"><strong>Image</strong> (optional)</span>
            <div class="btn btn-sm btn-outline-primary">
                Upload <i class="fa fa-upload"></i>
            </div>
        </label>
        <x-error key="reject_image" />
    </div>

    <button class="w-100 btn btn-outline-success" onclick="changeStatus('{{route('admin.trade.change-status', $trade->id)}}')">Update Status</button>
</div>
