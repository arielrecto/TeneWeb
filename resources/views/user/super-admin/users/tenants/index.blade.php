<x-dashboard.super-admin.base>
    <x-dashboard.page-label :back_url="route('super-admin.users.index')" title="tenants" />


    <div class="panel flex flex-col gap-2 p-2">
        <x-dashboard.tab-navigation tab_number="2" :tabs="[
            [
                'url' => route('super-admin.users.tenants.index'),
                'label' => 'Phase 1',
            ],
            [
                'url' => route('super-admin.users.tenants.index', ['tenement' => 2]),
                'label' => 'Phase 2',
            ],
        ]" />
         <div class="h-96 w-full overflow-y-auto flex flex-col gap-2">
            <h1 class="text-lg font-bold text-primary"></h1>
            <table class="table">
                <!-- head -->
                <thead class="bg-primary text-accent">
                    <tr>
                        <th></th>
                        <th>name</th>
                        <th>Status</th>
                    <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->

                    @forelse ($tenants as $tenant)

                    <tr>
                        <th></th>
                        <td>{{$tenant->name}}</td>
                        <td></td>
                        <td class="flex gap-2 justify-center">
                            <a href="#" class="btn btn-accent btn-sm text-primary">
                                <i class="fi fi-rr-eye"></i>
                            </a>
                            <form action="#" method="post">
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
                        <th></th>
                        <td>No Admins</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.super-admin.base>
