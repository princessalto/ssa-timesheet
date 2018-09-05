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
		                    <h3 class="box-title">Refresh List</h3>
		                </div>

						<form action="{{ route('permissions.show') }}" method="POST" class="card">
		                	<div class="box-body">
								{{ csrf_field() }}
								<div class="card-block">
									<legend><i class="fa fa-warning text-yellow">&nbsp;</i>| Warning</legend>
									<p>Refreshing the list of permissions will <strong>delete</strong> the associated permissions on all roles.</p>
									<p>You may manually re-assign <a href="{{ route('roles.index') }}">Roles</a> after the refresh.</p>
								</div>
							</div>
							<div class="box-footer">
								<a href="{{ route('permissions.index') }}" role="button" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Refresh</button>
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