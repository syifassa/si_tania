@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
        <div class="flex items-center gap-1.5">
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-300 bg-gray-50 rounded-xl cursor-default">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}" class="flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-500 bg-gray-50 rounded-xl hover:bg-gray-100 hover:text-gray-700 active:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span aria-disabled="true" class="flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-400 bg-gray-50 rounded-xl cursor-default">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="flex items-center justify-center w-9 h-9 text-sm font-bold text-white bg-blue-600 rounded-xl shadow-sm shadow-blue-200">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-600 bg-gray-50 rounded-xl hover:bg-gray-100 hover:text-gray-700 active:bg-gray-200 transition">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}" class="flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-500 bg-gray-50 rounded-xl hover:bg-gray-100 hover:text-gray-700 active:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                </a>
            @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-300 bg-gray-50 rounded-xl cursor-default">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
