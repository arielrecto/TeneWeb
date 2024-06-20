<x-dashboard.admin.base>


    <x-notification-message />
    <x-dashboard.page-label title="Announcement Edit" :back_url="route('admin.announcements.index')" />

    <div class="panel p-2 flex flex-col gap-2">

        <form action="{{ route('admin.announcements.update', ['announcement' => $announcement->id]) }}" method="post" class="flex flex-col gap-2 w-full h-full">
            @csrf
            @method('put')
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Title</h1>
                <input type="text" name="title" class="input-generic" placeholder="{{$announcement->title}}">

                @if ($errors->has('title'))
                    <p class="text-xs text-error">
                        {{ $errors->first('title') }}
                    </p>
                @endif
            </div>
            <div class="min-h-32 w-full flex  flex-col gap-2">
                <h1 class="input-generic-label">Descriptions</h1>
                <x-quill-editor >
                    {!! $announcement->description !!}
                </x-quill-editor>

                @if ($errors->has('descriptions'))
                    <p class="text-xs text-error">
                        {{ $errors->first('descriptions') }}
                    </p>
                @endif
            </div>


            <button class="btn btn-sm btn-primary text-accent">
                Post
            </button>
        </form>


    </div>
</x-dashboard.admin.base>
