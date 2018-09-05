@include("Pluma::partials.header")

    @include("Pluma::partials.browser-support")
    @include("Pluma::partials.noscript")

	{{-- @include("Pluma::partials.navigation") --}}

	{{-- <main id="main" class="main main-light main-center main-auth" role="main"> --}}

	    {{-- <div class="m-x-auto text-xs-center m-b-3"> --}}
	    	{{-- @include("Pluma::partials.brand") --}}
	    {{-- </div> --}}

		@yield("content")

		
	{{-- </main> --}}

{{-- @include("Pluma::partials.footer") --}}