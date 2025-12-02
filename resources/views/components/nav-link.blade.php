@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white font-medium shadow-sm transition'
            : 'flex items-center px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
