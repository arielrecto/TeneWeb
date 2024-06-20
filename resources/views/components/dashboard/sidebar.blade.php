@props([
    'links' => [],
])


@php
    $profile = Auth::user()->profile ?? null;
@endphp

<div class="w-1/5 h-screen flex flex-col bg-white border border-secondary">
    <div class="flex items-center border-b border-secondary p-2 justify-between">
        <div class="flex items-center gap-2">
            <img src="https://t4.ftcdn.net/jpg/00/79/60/93/360_F_79609383_wxzSfzthQ0QAeGzPVSO2pr6vpWghVLnH.jpg"
                class="h-12 w-12 rounded-full" />

            <h1 class="font-bold text-lg text-neutral">
                TeneWeb
            </h1>
        </div>

        <a href="#" class="text-2xl text-accent">
            @if ($profile)
                <img src="{{ $profile->image }}" class="h-12 w-12 rounded-full object-center" />
            @else
                <i class="fi fi-rr-circle-user"></i>
            @endif
        </a>
    </div>

    <div class="p-4 mt-5 flex flex-col gap-5 justify-between h-full">
        <div class="h-auto w-full  flex flex-col gap-5">
            @foreach ($links as $link)
                <a href="{{ $link['url'] ? route($link['url']) : '#' }}"
                    class="flex items-center w-full text-sm gap-2 p-2 rounded-lg
            {{ Route::is($link['url']) ? 'bg-secondary font-bold text-accent' : 'hover:bg-secondary hover:font-bold duration-700 hover:text-accent' }}
            ">
                    {!! $link['icon'] !!}
                    <span class="capitalize">
                        {{ $link['name'] }}
                    </span>
                </a>
            @endforeach
        </div>
        <div>
            <form method="POST" action="{{ route('logout') }}"
                class="flex items-center w-full text-neutral gap-2 text-sm hover:bg-secondary hover:font-bold duration-700 p-2 rounded-lg">

                @csrf
                <i class="fi fi-rr-sign-out-alt"></i>
                <button class="capitalize">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
