@props(['type' => 'success'])

<div>
    <div>Debug: Session Data - {{ json_encode(session()->all()) }}</div>

    @if (session()->has($type))
        <div class="alert alert-{{ $type }}">{{ session($type) }}</div>
    @else
        <h1>this text is to be rendered when there is no flash messages in the session</h1>
    @endif

    {{-- Debugging information --}}
    <div>Debug: Type - {{ $type }}</div>
</div>


{{-- @props(['type' => 'success'])


<div>
<div>Debug: Session Data - {{ json_encode(session()->all()) }}</div>
@if (session()->has($type))
    <div class="alert alert-{{ $type }}">{{ session($type) }}</div>
@endif
<h1>this text is to be rendered when there is no flash messages in the session</h1>

{{-- Debugging information --}}
<div>Debug: Type - {{ $type }}</div>
</div> --}}
