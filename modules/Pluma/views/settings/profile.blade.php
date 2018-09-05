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
                            <h3 class="box-title">Profile Settings</h3>
                        </div>

						<div class="box-body">
							<aside class="card card-light">
								<div class="card-block">
									<img src="//placehold.it/100x100" alt="" class="img-fluid text-xs-center">
								</div>
								<div class="card-footer text-xs-right">
									{{-- <input type="file" name="avatar" id="avatar" class="form-control form-control-dotted"> --}}
									<button type="button" class="btn btn-link">Change avatar</button>
								</div>
							</aside>

							<div class="col-sm-9">
								<div class="card">
									<div class="card-block">
										<p><strong>Edit Profile</strong> <span class="text-muted">| {{ auth()->user()->fullname }}</span></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection

@push('js')
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
@endpush