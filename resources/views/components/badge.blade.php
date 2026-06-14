@props(['type' => 'default'])

<span {{ $attributes->merge(['class' => 'badge badge-'.$type]) }}>
    {{ $slot }}
</span>
