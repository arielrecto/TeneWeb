<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('admin.tenants.index')" title="Tenant" />

    <div class="panel p-2">
        <div class="flex gap-2">
            <div class="w-1/5 flex  flex-col gap-2">
                <img src="{{ $tenant->profile->image }}" alt="" srcset="" class="w-full h-64 object-cover">
                <h1 class="text-center text-lg font-bold capitalize text-primary">
                    {{ "{$tenant->profile->last_name}, {$tenant->profile->first_name}" }}
                </h1>
                <h1 class="text-center text-xs font-semibold text-gray-500">
                    {{ $tenant->email }}
                </h1>
            </div>
            <div class="w-5/6 min-h-32 bg-gray-50 rounded-lg p-2">
                <h1 class="text-xl font-bold text-primary capitalize">
                    Personal Information
                </h1>

                <div class="grid grid-cols-3 grid-flow-row gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Last Name</h1>
                        <p>{{ $tenant->profile->last_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">First Name</h1>
                        <p>{{ $tenant->profile->first_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Middle Name</h1>
                        <p>{{ $tenant->profile->middle_name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Room Number</h1>
                        <p>{{ $tenant->tenant->room->room_number ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Move in Date</h1>
                        <p>{{ date('F d, Y', strtotime($tenant->tenant->move_in_date)) }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Tenement</h1>
                        <p>{{ $tenant->tenant->room->tenement->name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Gender</h1>
                        <p>{{ $tenant->profile->gender ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Contact</h1>
                        <p>{{ $tenant->profile->contact ?? 'N\A' }}</p>
                    </div>
                </div>



                <div class="flex flex-col gap-2 mt-5">
                    <x-table-body :columns="['name', 'amount', 'type', 'status']" label="Bills" :create_url="route('admin.bills.create', ['tenant' => $tenant->id])">

                        @forelse ($tenant->tenant->bills as $bill)
                            <tr>
                                <td></td>
                                <td>
                                    {{ $bill->name }}
                                </td>
                                <td>
                                    {{ $bill->amount }}
                                </td>
                                <td>
                                    {{ $bill->type }}
                                </td>
                                <td>
                                    {{ $bill->status }}
                                </td>
                                <td class="flex gap-2 justify-center">
                                    {{-- <a href="{{route('admin.tenants.show', ['tenant' => $tenant->id])}}" class="btn btn-accent btn-sm text-primary">
                                        <i class="fi fi-rr-eye"></i>
                                    </a> --}}
                                    <a href="{{route('admin.bills.edit', ['bill' => $bill->id])}}" class="btn btn-secodary btn-sm text-primary">
                                        <i class="fi fi-rr-edit"></i>
                                    </a>
                                    <form action="{{route('admin.bills.destroy', ['bill' => $bill->id])}}" method="post">
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
                                <td> No Bills Data
                                    <td />
                            </tr>
                        @endforelse

                    </x-table-body>
                </div>
            </div>

        </div>
    </div>
</x-dashboard.admin.base>
