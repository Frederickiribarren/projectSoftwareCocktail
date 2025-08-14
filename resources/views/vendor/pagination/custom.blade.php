@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Botón Previous --}}
        @if ($paginator->onFirstPage())
            <button class="page-btn disabled" disabled>
                <i class="fas fa-chevron-left"></i>
            </button>
        @else
            <button class="page-btn" wire:click="previousPage" wire:loading.attr="disabled" onclick="window.location='{{ $paginator->previousPageUrl() }}'">
                <i class="fas fa-chevron-left"></i>
            </button>
        @endif

        {{-- Números de página --}}
        @foreach ($elements as $element)
            {{-- Separador "..." --}}
            @if (is_string($element))
                <button class="page-btn disabled" disabled>{{ $element }}</button>
            @endif

            {{-- Array de links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="page-btn active" disabled>{{ $page }}</button>
                    @else
                        <button class="page-btn" onclick="window.location='{{ $url }}'">{{ $page }}</button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botón Next --}}
        @if ($paginator->hasMorePages())
            <button class="page-btn" onclick="window.location='{{ $paginator->nextPageUrl() }}'">
                <i class="fas fa-chevron-right"></i>
            </button>
        @else
            <button class="page-btn disabled" disabled>
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif
    </div>
@endif
