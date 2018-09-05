@extends("Pluma::layouts.admin")

@section("content")
	<div class="content-wrapper">
		@include("Pluma::partials.breadcrumb")
		<section class="content">
			<div class="box box-primary">
                <div class="box-header with-border">
                	<h3 class="box-title">Trash</h3>
                </div>
				{{-- <a href="{{ route('roles.index') }}" class="btn btn-link pull-xs-right">Back</a> --}}
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Code</th>
									<th>Description</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@if ( $resources->isEmpty() )
								<tr>
									<td colspan="4" class="text-xs-center">No trashed resource.</td>
								</tr>
								@endif

								@foreach ( $resources as $resource )
									<tr>
										<td>{{ $resource->name }}</td>
										<td>{{ $resource->slug }}</td>
										<td>{{ $resource->description }}</td>
										<td>@include("Pluma::roles.restore", compact('resource'))</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
		</section>
	</div>
		@include("Pluma::partials.pagination", compact('resources'))
@endsection

@push('js')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
@endpush