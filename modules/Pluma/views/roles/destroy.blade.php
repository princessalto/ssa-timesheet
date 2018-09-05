<form action="{{ action('\Pluma\Controllers\RoleController@destroy', $resource->id) }}" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	{{ method_field('DELETE') }}
	<button type="submit" class="delete-btn" data-toggle="tooltip" data-placement="top" title="delete"><i class="fa fa-trash-o"></i></button>
	{{-- <button type="submit" class="btn btn-link"><i class="fa fa-trash"></i> Remove</button> --}}
</form>