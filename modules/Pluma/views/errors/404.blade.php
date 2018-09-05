@extends("Pluma::layouts.admin")

@section("content")
	<div class="content-wrapper">
		{{-- @include("Pluma::partials.breadcrumb") --}}
		<section class="content">
			<div class="error-page">
				<h2 class="headline text-red"> 404</h2>
				<div class="error-content">
					<h3><i class="fa fa-warning text-red"></i> The page cannot be found</h3>
					<p>
						We could not find the page you were looking for.
						Meanwhile, you may <a href="dashboard">return to dashboard</a> or try using the search form.
					</p>
					<form class="search-form">
						<div class="input-group">
							<input type="text" name="search" class="form-control" placeholder="Search">
							<div class="input-group-btn">
								<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
@endsection

@push('js')
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
	<script src="{{ asset('vendor/admin-lte/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/demo.js') }}"></script>
@endpush