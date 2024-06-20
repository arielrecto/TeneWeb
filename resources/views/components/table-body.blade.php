@props([
    'columns' => ['name', 'Email', 'Tenement'],
    'label' => 'sample table',
    'create_url' => null,
])

<div  class="w-full h-auto flex flex-col gap-2">
    <div class="w-full flex  items-center justify-between">
        <h1 class="text-2xl font-bold text-primary">{{ $label }}</h1>
        @if ($create_url)
            <a href="{{ $create_url }}" class="btn btn-sm btn-primary text-accent">
                <span>
                    <i class="fi fi-rr-add"></i>
                </span>
                <span>
                    Create
                </span>
            </a>
        @endif
    </div>

    <div class="overflow-y-auto">
        <table class="table">
            <!-- head -->
            <thead class="bg-primary text-accent">
                <tr>
                    <th></th>
                    @foreach ($columns as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>

