@php
    $columns = ['name', 'email', 'tenant type', 'room no', 'tenement'];
@endphp

<x-dashboard.admin.base>
    <div class="grid grid-cols-2 grid-flow-row gap-2 h-32">
        <x-card label="Tenants" icon="fi fi-rr-house-chimney-user" :total="$totalTenant" />
        <x-card label="Unverified Tenants" icon="fi fi-rr-house-chimney-user" :total="count($unverifiedTenants)" />
    </div>


    <div class="panel p-2">
        <x-table-body label="Pre Register Tenant" :columns="$columns">
            @forelse ($unverifiedTenants as $unTenant)
                <tr>
                    <th></th>
                    <td>{{ $unTenant->name }}</td>
                    <td>{{ $unTenant->email }}</td>
                    <td>{{ $unTenant->tenant_type }}</td>
                    <td>{{ $unTenant->room_number }}</td>
                    <td>{{ $unTenant->tenement->name }}</td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{route('admin.unverified-tenant.show', ['unverified_tenant' => $unTenant->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                    </td>
                </tr>

            @empty
                <tr>
                    <th></th>
                    <td>No Pre Register Tenants </td>
                </tr>
            @endforelse

            {!! $unverifiedTenants->links() !!}
        </x-table-body>
    </div>




</x-dashboard.admin.base>
