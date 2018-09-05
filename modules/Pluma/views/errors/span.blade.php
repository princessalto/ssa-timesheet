@if ($errors->has($field))
    <span class="error help-block">
        <strong>{{ $errors->first($field) }}</strong>
    </span>
@endif