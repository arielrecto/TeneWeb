<x-dashboard.admin.base>

    <div class="panel p-2">
        <x-table-body label="Announcements" :columns="[
            'Title',
            'Date Posted',
        ]"  :create_url="route('admin.announcements.create')">
            @forelse ($announcements as $announcement)
                <tr>
                    <td></td>
                    <td>
                        {{ $announcement->title}}
                    </td>
                    <td>
                        {{date('F d, Y', strtotime($announcement->created_at))}}
                    </td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{route('admin.announcements.show', ['announcement' => $announcement->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        <a href="{{route('admin.announcements.edit', ['announcement' => $announcement->id])}}" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a>
                        <form action="{{route('admin.announcements.destroy', ['announcement' => $announcement->id])}}" method="post">
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
        {!! $announcements->links() !!}
    </div>
</x-dashboard.admin.base>
