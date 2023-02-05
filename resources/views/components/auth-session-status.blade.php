@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bg-green-400 dark:bg-gray-500 rounded-md font-medium text-sm text-white dark:text-green-400 absolute z-50 top-2 right-6 py-2 px-6 transition-all ease-in-out duration-300 flex justify-between items-center', 'id' => 'notificationflush']) }}>
        <span class="iconify text-xl mr-2" data-icon="ic:round-check"></span>
        {{ $status }}
    </div>
@endif
