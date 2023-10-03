@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
             {{-- <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.previous')</span>
            </li> --}}
        @else

             <li class="page-item">
                <a class="btn btn-dark" href="{{ $paginator->previousPageUrl() }}" {{-- onclick="prev(); this.onclick=null;" --}} rel="prev">@lang('pagination.previous')</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li  id="tali" class="page-item">
                <a class="btn btn-dark"  href="{{ $paginator->nextPageUrl() }}" {{-- onclick="pass(); this.onclick=null;" --}}  rel="next">@lang('pagination.next')</a>
            </li>
       @else
                {{--  <button id="endquiz" class="btn btn-success" onclick="getresult()" disabled="true">{{ __('End') }}</button>  --}}

                {{--  <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">@lang('pagination.next')</span>
                </li>  --}}
            @endif
    </ul>
@endif
