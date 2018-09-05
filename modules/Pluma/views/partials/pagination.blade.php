@php
    if ( null !== $resources ) {
        $paginator = $resources;
    }
@endphp

@if ($paginator->lastPage() > 1)
<ul class="pagination pull-right">
    <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url(1) }}">&laquo;</a>
     </li>
    <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}">&lsaquo;</a>
    </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
        {!! $paginator->currentPage() == $i ? '<span class="page-link">'.$i.'</span>' : '<a class="page-link" href="'. $paginator->url($i) . '">' .$i.'</a>' !!}

        </li>
    @endfor
    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" >&rsaquo;</a>
    </li>
    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
    </li>
</ul>
@endif