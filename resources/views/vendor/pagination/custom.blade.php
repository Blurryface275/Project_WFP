@if ($paginator->hasPages())
<nav class="pagination py-2 d-inline-block">
    <div class="nav-links">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <span class="page-numbers disabled">&laquo;</span>
        @else
            <a class="page-numbers" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
        @endif

        {{-- Nomor halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-numbers dots">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-numbers current">{{ $page }}</span>
                    @else
                        <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a class="page-numbers" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
        @else
            <span class="page-numbers disabled">&raquo;</span>
        @endif
    </div>
</nav>
@endif
