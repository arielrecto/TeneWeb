@php
    $links = [
        [
            'url' => 'tenant.dashboard',
            'name' => 'dasboard',
            'icon' => '<i class="fi fi-rr-dashboard"></i>',
        ],
    ];
@endphp


@php
    $links = [
        [
            'url' => 'tenant.dashboard',
            'name' => 'dasboard',
            'icon' => '<i class="fi fi-rr-dashboard"></i>',
        ],
        [
            'url' => 'tenant.announcements.index',
            'name' => 'Announcements',
            'icon' => '<i class="fi fi-rr-megaphone"></i>',
        ],
        [
            'url' => 'tenant.bills.index',
            'name' => 'bills',
            'icon' => '<i class="fi fi-rr-file-invoice-dollar"></i>',
        ],
    ];
@endphp

<x-app-layout>

    <x-dashboard.content-wrapper>
        <div class="flex gap-5 w-full">
            <x-dashboard.sidebar :links="$links" />
            <div class="w-5/6 h-full flex flex-col gap-2">
                <x-dashboard.header />
                <div class="p-2 h-auto w-full flex flex-col gap-2">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </x-dashboard.content-wrapper>

</x-app-layout>
