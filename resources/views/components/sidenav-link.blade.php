@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-gray-100 hover:bg-gray-100 dark:bg-gray-800 text-gray-900 px-5 py-3 dark:text-white border-blue-500 hover:border-blue-500 border-l-4 flex items-center justify-start gap-4 transition duration-150 ease-in-out'
            : 'hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center justify-start gap-4 px-5 dark:text-white py-3 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

