<x-dashboard.tenant.base>


    <x-notification-message />

    <x-dashboard.page-label title="Bills" />

    <div class="panel p-2">
        <x-table-body :columns="['name', 'amount', 'type', 'status']" label="Bills">

            @forelse ($bills as $bill)
                <tr>
                    <td></td>
                    <td>
                        {{ $bill->name }}
                    </td>
                    <td>
                        ₱ {{ number_format($bill->amount, 2)  }}
                    </td>
                    <td>
                        {{ $bill->type }}
                    </td>
                    <td>
                        {{ $bill->status }}
                    </td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{ route('tenant.bills.show', ['bill' => $bill->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="{{route('admin.bills.edit', ['bill' => $bill->id])}}" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a>
                        <form action="{{route('admin.bills.destroy', ['bill' => $bill->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-error btn-sm">
                                <i class="fi fi-rr-trash"></i>
                            </button>
                        </form> --}}
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
</x-dashboard.tenant.base>
