@props(['action' => '', 'method' => 'post'])
<form {{ $attributes->merge(['action' => $action, 'method' => $method == 'get' ? 'get' : 'post']) }}>
    @if ($method != 'get')
        @csrf
    @endif
    @if ($method != 'post' && $method != 'get')
        @method($method)
    @endif
    {{ $slot }}
</form>
