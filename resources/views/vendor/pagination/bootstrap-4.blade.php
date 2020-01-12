@if ($paginator->hasPages())
    <br />
    <table cellpadding="3" cellspacing="1" border="0" class="PagerContainerTable">
        <tbody>
            <tr>

                {{-- Previous Page Link --}}

                @if ($paginator->onFirstPage())
                    <td class="PagerOtherPageCells"><a class="PagerHyperlinkStyle"><span>السابق</span></a></td>
                @else 
                    <td class="PagerOtherPageCells"><a class="PagerHyperlinkStyle" href="{{ $paginator->previousPageUrl() }}"><span>السابق</span></a></td>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)

                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <td class="PagerInfoCell"><span>{{ $element }}</span></td>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <td class="PagerCurrentPageCell"><span class="PagerHyperlinkStyle"><strong>{{ $page }}</strong></span></td>
                            @else
                                <td class="PagerOtherPageCells"><a class="PagerHyperlinkStyle" href="{{ $url }}"><span>{{ $page }}</span></a></td>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <td class="PagerOtherPageCells"><a class="PagerHyperlinkStyle" href="{{ $paginator->nextPageUrl() }}"><span>التالي</span></a></td>
                @else
                    <td class="PagerOtherPageCells"><a class="PagerHyperlinkStyle"><span>التالي</span></a></td>
                @endif
            
            </tr>
        </tbody>
   </table>

@endif
