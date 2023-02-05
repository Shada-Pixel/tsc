<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="p-6 bg-white dark:bg-gray-700 rounded">
                <div class="p-6 text-gray-900 dark:text-white">
                    {{ __("You're logged in!") }}
                </div>
        </div>
    </div>
</x-app-layout>
