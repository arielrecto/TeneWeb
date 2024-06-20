<x-dashboard.super-admin.base>
    <x-dashboard.page-label :create_url="route('super-admin.tenements.create')" title="tenements" />


    <div class="panel p-2">

        @if (count($tenements) !== 0)
            <div class="grid grid-cols-2 grid-flow-row gap-5">
                @foreach ($tenements as $tenement)
                    <a href="{{route('super-admin.tenements.show', ['tenement' => $tenement->id])}}" class="h-full rounded-lg shadow-lg bg-white">
                        <img src="{{ $tenement->image }}" alt="" srcset=""
                            class="rounded-t-lg object-cover object-center h-44 w-full">
                        <div class="w-full flex flex-col gap-2 p-2">
                            <div class="w-full flex items-center justify-between">
                                <h1 class="text-2xl font-bold text-primary capitalize">{{ $tenement->name }}</h1>
                                <p class="text-xs text-secondary">
                                    Date : {{date('F d, Y', strtotime($tenement->created_at))}}
                                </p>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col gap-2">
                                    <h3 class="text-sm">Total Rooms</h3>
                                    <p class="text-xs text-secondary">{{ count($tenement->rooms) }}</p>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h3 class="text-sm">Announcements</h3>
                                    <p class="text-xs text-secondary">{{ count($tenement->announcements) }}</p>
                                </div>
                            </div>
                        </div>

                    </a>
                @endforeach
            </div>
        @else
            <div class="h-full flex justify-center items-center w-full bg-gray-100">
                <a href="{{ route('super-admin.tenements.create') }}" class="text-accent btn btn-xs btn-primary">Add
                    Tenement</a>
            </div>
        @endif

    </div>
</x-dashboard.super-admin.base>
