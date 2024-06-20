<x-dashboard.tenant.base>


    <div class="w-full h-64 rounded-lg bg-center bg-no-repeat bg-cover relative"
        style="background-image: url({{ $tenement->image }})">
        <div class="absolute z-10 backdrop-blur-sm flex w-full h-full justify-center items-center">
            <div class="flex  flex-col gap-2">
                <h1 class="text-2xl font-bold text-primary text-center">{{ $tenement->name }}</h1>
                <p class="text-lg text-center">{{ $room->room_number }}</p>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-2 grid-flow-row gap-2">
        <x-card icon="fi fi-rr-file-invoice-dollar" label="Bills" :hasCurrency="true" :total="number_format($totalUnpaidBills, 2)" />
        <x-card icon="fi fi-rr-megaphone" label="Announcement" :total="count($announcements)" />
    </div>

    <x-dashboard.page-label title="Announcements" />



    <div class="min-h-64 max-h-96 overflow-y-auto flex flex-col gap-2">

        @forelse ($announcements as $announcement)
            <a href="{{ route('tenant.announcements.show', ['announcement' => $announcement->id]) }}">
                <div class="min-h-32 flex flex-col gap-2 bg-white rounded-lg shadow-md p-2 justify-between">
                    <div class="flex justify-between items-center">
                        <h1 class="text-xl font-bold text-primary capitalize">
                            {{ $announcement->title }}
                        </h1>
                        <p class="text-xs text-gray-500">
                            {{ date('F d, Y h:s A', strtotime($announcement->created_at)) }}
                        </p>
                    </div>

                    <div class="truncate text-sm">
                        {!! $announcement->description !!}
                    </div>


                    <div class="flex items-center justify-center border-t border-gray-200 p-2">
                        <h1 class="flex items-center gap-2 text-sm">
                            <i class="fi fi-rr-comment-alt"></i>
                            <span>{{ $announcement->announcementFeeds()->count() }}</span>
                        </h1>
                    </div>
                </div>
            </a>
        @empty

            <div class="min-h-32 flex justify-center items-center gap-2 bg-white rounded-lg shadow-md p-2 ">
                <h1>No Announcements</h1>
            </div>
        @endforelse


    </div>

</x-dashboard.tenant.base>
