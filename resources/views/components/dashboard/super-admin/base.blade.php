@php
    $links = [
        [
            'url' => 'super-admin.dashboard',
            'name' => 'dasboard',
            'icon' => '<i class="fi fi-rr-dashboard"></i>',
        ],
        [
            'url' => 'super-admin.users.index',
            'name' => 'users',
            'icon' => '<i class="fi fi-rr-users-alt"></i>',
        ],
        [
            'url' => "super-admin.tenements.index",
            'name' => 'tenements',
            'icon' => '<i class="fi fi-rr-house-building"></i>',
        ],
        [
            'url' => null,
            'name' => 'reports',
            'icon' => '<i class="fi fi-rr-newspaper"></i>',
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
