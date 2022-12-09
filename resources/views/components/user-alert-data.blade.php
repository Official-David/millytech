<form
    action="{{ route('admin.user.alert', $user->id) }}"
    id="alert-form"
    method="POST"
>
    <div class="form-group">
        <label for="user">User</label>
        <input
            type="text"
            class="form-control"
            value="{{ $user->name }}"
            disabled
        >
    </div>
    <div class="form-group">
        <label for="type">Alert Type</label>
        <select
            id="alert_type"
            name="alert_type"
            id="type"
            class="form-select"
        >
            <option
                value=""
                @selected(empty($user->alert_type))
            >Choose Alert Type</option>
            <option
                value="payment_alert"
                @selected($user->alert_type == 'payment_alert')
            >Payment Alert</option>
            <option
                value="scam_alert"
                @selected($user->alert_type == 'scam_alert')
            >Scam Alert</option>
        </select>
        <x-error key="alert_type" />
    </div>
    <div class="form-group mb-3">
        <label for="alert_message">Alert Message</label>
        <textarea
            name="alert_message"
            id="alert_message"
            cols="30"
            rows="10"
            class="form-control"
        >{{ $user->alert_message }}</textarea>
        <x-error key="alert_message" />
    </div>

    <button
        type="submit"
        class="btn btn-outline-primary w-100"
    >Submit</button>

</form>
