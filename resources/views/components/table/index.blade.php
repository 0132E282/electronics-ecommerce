@props(['head', 'body'])
<table {{ $attributes->class(['table table-striped']) }}>
    <thead>
        {{ $head }}
    </thead>
    <tbody>
        {{ $body }}
    </tbody>
</table>
