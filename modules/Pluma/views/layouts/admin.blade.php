@include("Pluma::partials.header")

	<div class="wrapper">
		@include("Pluma::partials.browser-support")
		@include("Pluma::partials.noscript")

		@include("Pluma::partials.utilitybar")

		@include("Pluma::partials.sidebar")

		@section("content")

			This is the master content
		@show

		@include("Pluma::partials.endnote", ["isSticky" => true])
		<div class="control-sidebar-bg"></div>
	</div>

{{-- Push admin-specific scripts to before including footer --}}
@push('pre-js')
	<script src="{{ asset('js/app.vendor.js') }}"></script>
@endpush

@include("Pluma::partials.footer")