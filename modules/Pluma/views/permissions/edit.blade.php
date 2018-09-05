@extends("Pluma::layouts.admin")

@section("content")
	<div class="content-wrapper">
		@include("Pluma::partials.breadcrumb")
		<section class="content">
			@include("Pluma::partials.flash")

			<form action="{{ route('permissions.update', $resource->id) }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control-dotted" placeholder="Name" value="{{ $resource->name }}" readonly>
				</div>
				<div class="form-group">
					<label>Slug</label>
					<input type="text" class="form-control-dotted" placeholder="Name" value="{{ $resource->slug }}" readonly>
				</div>
				<div class="form-group">
					<label>Method</label>
					<input type="text" class="form-control-dotted" placeholder="Name" value="{{ $resource->method }}" readonly>
				</div>

				<div class="form-group">
					<label for="roles">Roles</label>
					<select name="roles" id="roles" class="form-control-dotted" multiple>
						@foreach ( $roles_options as $id => $role )
							<option value="{{ $id }}" >{{ $role }}</option>
						@endforeach
					</select>
				</div>
			</form>
		</section>
	</div>
@endsection

@push('js')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
@endpush