<x-dashboard.admin.base>
    <div class="grid grid-cols-3 grid-flow-row gap-2 h-32">
        <a href="#" class="h-full w-full">
            <x-card label="rooms" icon="fi fi-rr-bed-alt" :total="$roomTotal" />
        </a>
        <a href="#" class="h-full w-full">
            <x-card label="available rooms" icon="fi fi-rr-bed-alt" :total="$vacantRoomTotal" />
        </a>
        <a href="#" class="h-full w-full">
            <x-card label="occupied rooms" icon="fi fi-rr-bed-alt" :total="$occupiedRoomTotal"  />
        </a>
    </div>

    <div class="panel p-2">
        <x-table-body label="Rooms" :columns="[
            'room no.',
            'status',
            'tenement'
        ]"  :create_url="route('admin.rooms.create')">
            @forelse ($rooms as $room)
                <tr>
                    <td></td>
                    <td>
                        {{ $room->room_number }}
                    </td>
                    <td>
                        {{$room->status}}
                    </td>
                    <td>
                        {{$room->tenement->name}}
                    </td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{route('admin.rooms.show', ['room' => $room->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        <a href="{{ route('admin.rooms.edit', ['room' => $room->id]) }}"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a>
                        <form action="{{route('admin.rooms.destroy', ['room' => $room->id])}}" method="post">
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
                    <td>
                        No Rooms
                    </td>
                </tr>
            @endforelse
        </x-table-body>
        {!! $rooms->links() !!}
    </div>
</x-dashboard.admin.base>
