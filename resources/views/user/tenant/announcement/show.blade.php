<x-dashboard.tenant.base>
    <x-dashboard.page-label title="Announcement" :back_url="route('tenant.announcements.index')" />
    <div class="panel p-2 flex flex-col gap-2">
        <h1 class="py-10 text-center text-3xl font-bold text-primary border-b border-gray-100 capitalize">
            {{ $announcement->title }}
        </h1>
        <div class="flex justify-end">
            <p class="text-xs text-gray-500">Date Posted : {{ date('F d, Y', strtotime($announcement->created_at)) }}</p>
        </div>


        <div class="bg-gray-200 rounded-lg p-2 min-h-32">
            {!! $announcement->description !!}
        </div>

        <div class="flex  flex-col gap-2" x-data="{ toggle: false }">
            <div class="border-y border-gray-200 p-2 flex  items-center gap-2  justify-between capitalize">
                <h1 class="input-generic-label flex items-center gap-2">
                    <span> comments</span> <span>{{ $announcement->announcementFeeds()->count() }}</span>
                </h1>
                <button @click="toggle = !toggle" class="btn btn-primary text-accent btn-sm">
                    <span x-text="toggle ? 'Close' : 'Add Comment'" />
                </button>
            </div>

            <div x-show="toggle" x-transition.duration.700ms>
                <form action="{{route('tenant.announcement-feeds.store')}}" method="post" class="flex flex-col gap-2">
                    @csrf
                    <x-quill-editor />

                    @if ($errors->has('descriptions'))
                        <p class="text-xs  text-error">{{$errors->first('descriptions')}}</p>
                    @endif

                    <input type="hidden" name="announcement" value="{{$announcement->id}}">
                    <button class="btn btn-sm btn-primary text-accent">Add Comment</button>
                </form>
            </div>
        </div>


        @forelse ($announcement->announcementFeeds()->latest()->get() as $comment)

        <div class="border border-primary rounded-lg p-2 flex flex-col gap-2">
            <div class="flex items-center justify-between gap-5">
                <div class="flex items-center gap-2">
                    <img src="{{$comment->user->profile->image}}" alt="" srcset="" class="h-16 w-16 object-cover object-top rounded-full">
                </div>

                <div class="flex flex-col gap-2 bg-gray-100 rounded-lg p-2  grow">
                    <div class="flex justify-between items-center border-b border-gray-200">
                        <h1 class="capitalize font-bold">
                            <span>
                                {{$comment->user->name}}
                            </span>
                            <span class="text-xs text-gray-500"> - {{$comment->user->tenant->room->room_number}}</span>
                        </h1>

                        <p class="text-xs  text-gray-500">
                            {{date('F d, Y', strtotime($comment->created_at))}}
                        </p>
                    </div>


                    <div class="flex flex-col gap-2">
                        {!! $comment->content !!}
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="border border-primary rounded-lg p-2 flex items-center justify-center ">
                <h1 class="text-primary text-sm font-semibold">No Comments</h1>
            </div>
        @endforelse

    </div>
</x-dashboard.tenant.base>
