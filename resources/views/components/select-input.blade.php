@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }}  {!! $attributes->merge(['class' =>'mt-1 w-full bg-white dark:bg-gray-600 text-gray-800 dark:text-white border-gray-300 dark:border-gray-500 focus:border-blue-500 focus:ring-blue-500 rounded shadow-sm',]) !!}>
    {{ $slot }}
</select>
