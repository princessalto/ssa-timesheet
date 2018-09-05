<form action="{{ route('roles.restore', $resource->id) }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-link"><i class="fa fa-undo">&nbsp;</i>Restore</button>
</form>