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
							<h3 class="box-title">{{ "Edit $resource->name" }}</h3>
						</div>
						
						<form action="{{ route('roles.update', $resource->id) }}" method="POST">
							<div class="box-body">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<div class="form-group row">
									<label for="name" class="col-sm-2 control-label">First Name</label>
                        			<div class="col-md-10">
										<input id="name" name="name" type="text" class="form-control" data-slug placeholder="Name" value="{{ $resource->name }}">
										@include("Pluma::errors.span", ['field' => 'name'])
									</div>
								</div>

								<div class="form-group row">
									<label for="slug" class="col-sm-2 control-label">Slug</label>
									<div class="col-md-10">
										<input id="slug" name="slug" type="text" class="form-control" placeholder="Unique slug" value="{{ $resource->slug }}">
										@include("Pluma::errors.span", ['field' => 'slug'])
									</div>
								</div>

								<div class="form-group row">
									<label for="description" class="col-sm-2 control-label">Description</label>
									<div class="col-md-10">
										<textarea id="description" name="description" type="text" class="form-control" placeholder="Description">{{ $resource->description }}</textarea>
										@include("Pluma::errors.span", ['field' => 'description'])
									</div>
								</div>
								<div class="form-group row">
									<label for="permissions" class="col-sm-2 control-label">Permissions</label>
									<div class="col-md-10">
										<div class="table-wrapper">
											<table class="table table-sm">
												<tbody>
													@foreach ( $permissions as $permission )
														<tr>
															<td>
																<label for="p-{{ $permission->id }}" role="button">
																	<input id="p-{{ $permission->id }}" type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $resource->permissions->contains( $permission->id ) ? 'checked' : '' }}>
																	&nbsp;
																	{{ $permission->name }}
																	<em class="text-muted">{{ $permission->description }}</em>
																</label>
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										@include("Pluma::errors.span", ['field' => 'permissions'])
									</div>
								</div>
							</div>
							<div class="box-footer">
								<a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Update</button>
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