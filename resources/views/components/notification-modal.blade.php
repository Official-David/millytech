<div>
    <div class="form-group">
        <label for="title">
            <strong class="fs-18">
                Title
            </strong>
        </label>
        <input type="text" value="{{$notification->title}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="message">
            <strong class="fs-18">
                Message
            </strong>
        </label>
        <textarea class="form-control" name="message" id="message" cols="30" rows="10">{{$notification->message}}</textarea>
    </div>
</div>
