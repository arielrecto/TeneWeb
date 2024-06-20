<x-dashboard.super-admin.base>
    <x-dashboard.page-label :back_url="route('super-admin.tenements.index')" title="tenement - {{ $tenement->name }}" />


    <div class="panel flex flex-col gap-2">
        <img src="{{ $tenement->image }}" alt="" srcset=""
            class="w-full object-cover object-center h-64 rounded-t-lg">
        <h1 class="text-3xl font-bold tracking-wider text-center">
            {{ $tenement->name }}
        </h1>
        <div class="p-2 flex flex-col gap-2">
            <div class="grid grid-cols-3 grid-flow-row gap-2 h-32">
                <x-card label="room" icon="fi fi-rr-bed-alt" total="{{$tenement->rooms()->count()}}" />
                <x-card label="tenants" icon="fi fi-rr-family-dress" total="{{$tenement->activeTenants()->count()}}" />
                <x-card label="announcements" icon="fi fi-rr-megaphone" total="{{$tenement->announcements()->count()}}" />
            </div>

            <div class="flex gap-2">
                <div class="grow flex flex-col gap-2">
                    <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Rooms</h1>
                    <x-pie-chart />
                </div>
                <div class="grow flex flex-col gap-2">
                    <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Dues</h1>
                    <x-line-chart />
                </div>
            </div>
        </div>
        @php
            $rooms = $tenement->rooms()->paginate(10);
        @endphp
        <div class="h-96 w-full overflow-y-auto flex flex-col gap-2">
            <h1 class="text-lg font-bold text-primary">Rooms</h1>
            <table class="table">
                <!-- head -->
                <thead class="bg-primary text-accent">
                    <tr>
                        <th></th>
                        <th>Room No.</th>
                        <th>Status</th>
                    <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->

                    @forelse ($rooms as $room)

                    <tr>
                        <th></th>
                        <td>{{$room->room_number}}</td>
                        <td>{{$room->status}}</td>
                        <td class="flex gap-2 justify-center">
                            <a href="#" class="btn btn-accent btn-sm text-primary">
                                <i class="fi fi-rr-eye"></i>
                            </a>
                            <form action="#" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-error btn-sm">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <th></th>
                        <td>No Rooms</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
        {!! $rooms->links() !!}
    </div>
</x-dashboard.super-admin.base>
