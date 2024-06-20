<x-dashboard.super-admin.base>
    <div class="grid grid-cols-3 grid-flow-row gap-5 h-32">
        <x-card />
        <x-card label="tenants" icon="fi fi-rr-house-chimney-user" :total="$tenantTotal"/>
        <x-card label="tenements" icon="fi fi-rr-house-building" :total="$tenementTotal"/>
    </div>

    <div class="w-full h-96 bg-white rounded-lg shadow-lg border border-secondary">
        <x-line-chart/>
    </div>
</x-dashboard.super-admin.base>
