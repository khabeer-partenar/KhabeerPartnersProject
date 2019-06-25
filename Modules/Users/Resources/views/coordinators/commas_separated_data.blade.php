@foreach($data as $element)
    {{ $element }}
    @if (isset($break))
        <br />
    @else
        @if (!$loop->last)
            -
        @endif
    @endif
@endforeach