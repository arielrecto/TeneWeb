<x-dashboard.admin.base>


    <x-notification-message />

    <div class="grid grid-cols-2 grid-flow-row gap-2 h-32">
        <a href="{{ route('admin.tenants.index') }}" class="w-full h-full">
            <x-card label="tenants" icon="fi fi-rr-house-chimney-user" :total="count($tenants)" />
        </a>
        <a href="{{ route('admin.unverified-tenant.index') }}" class="w-full h-full">
            <x-card label="Pre Register Tenants" icon="fi fi-rr-house-chimney-user" :total="$unverifiedTenantTotal" />
        </a>
    </div>


    <div class="panel p-2">
        <x-table-body :columns="['name', 'room number', 'Move in Date']" label="Tenants" :create_url="route('admin.tenants.create')">

            @forelse ($tenants as $tenant)
                <tr>
                    <td>

                    </td>
                    <td>
                        {{ $tenant->name }}
                    </td>
                    <td>
                        {{ $tenant->tenant->room->room_number }}
                    </td>
                    <td>
                        {{ date('F d, Y', strtotime($tenant->tenant->move_in_date)) }}
                    </td>

                    <td class="flex gap-2 justify-center">
                        <a href="{{route('admin.tenants.show', ['tenant' => $tenant->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                        <form action="{{route('admin.tenants.destroy', ['tenant' => $tenant->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-error btn-sm">
                                <i class="fi fi-rr-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <td>No Tenant</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $tenants->links() !!}
        </x-table-body>
    </div>
</x-dashboard.admin.base>
