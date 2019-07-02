@foreach($data as $element)
    {{ $element }}
    @if (isset($break))
        <br />
    @else
        @if (!$loop->last && $data[$loop->index + 1])
            -
        @endif
    @endif
@endforeach