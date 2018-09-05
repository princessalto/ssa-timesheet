@if (Session::has('status'))
    <div class="alert alert-{{ Session::get('type') }}">
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	{{ Session::get('status') }}
    </div>
@endif