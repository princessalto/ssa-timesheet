@include("partials.header")

    @include("partials.browser-support")
    @include("partials.noscript")

	<main id="{{ $page->id or 'main' }}" class="main main-primary {{ $page->class or 'main' }}">
		@yield("content")
	</main>


@include("partials.footer")