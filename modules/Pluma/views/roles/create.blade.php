@extends("Pluma::layouts.admin")

@section("content")
	<div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")
        <section class="content">
	        <div class="row">
	            <div class="col-md-6 col-xs-12">
	            	@include("Pluma::partials.flash")
		        	<div class="box box-primary">
		                <div class="box-header with-border">
		                	<h3 class="box-title">Roles</h3>
		                </div>
						<form action="{{ route('roles.store') }}" method="POST">
		            		<div class="box-body">
							{{ csrf_field() }}
								<div class="form-group row">
									<label class="col-sm-2 control-label">Name</label>
                                    <div class="col-md-10">
										<input name="name" type="text" class="form-control" placeholder="Name" data-slug value="{{ old('name') }}">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-2 control-label">Slug</label>
                                    <div class="col-md-10">
										<input name="slug" type="text" class="form-control" placeholder="Slug" value="{{ old('slug') }}">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-2 control-label">Description</label>
                                	<div class="col-md-10">
										<textarea name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
									</div>
								</div>

								<div class="form-group">
									@foreach ( $permissions as $id => $name )
										<label for="{{ "permission-$id" }}" class="input-group" role="button">
											<input id="{{ "permission-$id" }}" type="checkbox" name="permissions[]" value="{{ $id }}">
										{{ $name }}
										</label>
									@endforeach
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" name="submit" class="btn btn-primary pull-right">Add</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection

@push('js')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
@endpush