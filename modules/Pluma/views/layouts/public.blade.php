@include("Pluma::partials.header")

@include("Pluma::partials.browser-support")
@include("Pluma::partials.noscript")

@section("content")
	<p class="text-muted">No content to show.</p>
@show

@include("Pluma::partials.endnote")

{{-- Push admin-specific scripts to before including footer --}}
@push('pre-js')
	<script src="{{ asset('js/app.vendor.js') }}"></script>
@endpush

@include("Pluma::partials.footer")
