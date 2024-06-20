@php
    $links = [
        [
            'url' => 'admin.dashboard',
            'name' => 'dasboard',
            'icon' => '<i class="fi fi-rr-dashboard"></i>',
        ],
        [
            'url' => 'admin.announcements.index',
            'name' => 'Announcements',
            'icon' => '<i class="fi fi-rr-megaphone"></i>',
        ],
        [
            'url' => 'admin.tenants.index',
            'name' => 'tenants',
            'icon' => '<i class="fi fi-rr-house-chimney-user"></i>',
        ],
        [
            'url' => 'admin.rooms.index',
            'name' => 'rooms',
            'icon' => '<i class="fi fi-rr-bed-alt"></i>',
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
