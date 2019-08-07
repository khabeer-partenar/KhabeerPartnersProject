@foreach($data as $element)
    {{ $element }}
    @if (!$loop->last)
        <br/>
    @endif
@endforeach