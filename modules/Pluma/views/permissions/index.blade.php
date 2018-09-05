@extends("Pluma::layouts.admin")

@section("content")
	<div class="content-wrapper">
		@include("Pluma::partials.breadcrumb")
		<section class="content">
			<div class="row">
				<div class="col-md-6">
					@include("Pluma::partials.flash")
					<div class="box box-primary">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Employees</h3>
		                    <div class="box-tools pull-right">
		                        <a href="{{ route('permissions.refresh') }}" type="submit" class="btn btn-link"><i class="fa fa-refresh">&nbsp;</i>Refresh</a>
		                    </div>
		                </div>

		                <div class="box-body">
		                	<div class="table-responsive">
			                	<table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
										@foreach ( $resources as $i => $resource )
											<tr>
												<td>{{ ++$i }}</td>
												<td>{{ $resource->name or 'unnamed' }}</td>
												<td>{{ $resource->description }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
		                	</div>
		                </div>
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