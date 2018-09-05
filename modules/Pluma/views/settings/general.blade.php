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
                            <h3 class="box-title">General Settings</h3>
                        </div>

						<div class="box-body">
							<form action="{{ route('settings.general') }}" class="card">
								{{ csrf_field() }}
								{{-- {{ dd($settings) }} --}}
								<div class="card-block">
									<div class="form-group row">
										<label for="sitename" class="col-form-label col-md-2 col-sm-3">Site Name</label>
										<div class="col-md-10 col-sm-9">
											<input id="sitename" name="sitename" type="text" class="form-control" data-slug placeholder="Site Name" value="{{ '' }}">
											@include("Pluma::errors.span", ['field' => 'sitename'])
										</div>
									</div>

									<div class="form-group row">
										<label for="tagline" class="col-sm-2 control-label">Tagline</label>
										<div class="col-md-10 col-sm-9">
											<input id="tagline" name="tagline" type="text" class="form-control" data-slug placeholder="Tagline" value="{{ '' }}">
											@include("Pluma::errors.span", ['field' => 'tagline'])
										</div>
									</div>

									<div class="form-group row">
										<label for="email" class="col-form-label col-md-2 col-sm-3">Email</label>
										<div class="col-md-10 col-sm-9">
											<input id="email" name="email" type="email" class="form-control" data-slug placeholder="Email" value="{{ '' }}">
											@include("Pluma::errors.span", ['field' => 'email'])
										</div>
									</div>

									<div class="form-group row">
										<label for="date_format" class="col-form-label col-md-2 col-sm-3">Date Format</label>
										<div class="col-md-10 col-sm-9">
											<input id="date_format" name="date_format" type="text" class="form-control" data-slug placeholder="Date Format" value="{{ '' }}">
											@include("Pluma::errors.span", ['field' => 'date_format'])
										</div>
									</div>

									<div class="form-group row">
										<label for="site_language" class="col-form-label col-md-2 col-sm-3">Site Language</label>
										<div class="col-md-10 col-sm-9">
											<input id="site_language" name="site_language" type="text" class="form-control" data-slug placeholder="Site Language" value="{{ '' }}">
											@include("Pluma::errors.span", ['field' => 'site_language'])
										</div>
									</div>
								</div>
							</form>
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