@if ($paginator->hasPages())
    <div class="center">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <a href="#" style="pointer-events: none; background: #aaa"><i class="fa-sharp fa-solid fa-angle-left"></i> Prev</a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"><i class="fa-sharp fa-solid fa-angle-left"></i> Prev</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">Next <i class="fa-sharp fa-solid fa-angle-right"></i></a>
                </li>
            @else
                <li>
                    <a href="#" style="pointer-events: none; background: #aaa">Next <i class="fa-sharp fa-solid fa-angle-right"></i></a>
                </li>
            @endif
        </ul>
    </div>
@endif
