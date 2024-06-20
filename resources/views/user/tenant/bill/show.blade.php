<x-dashboard.tenant.base>


    <x-notification-message />

    <x-dashboard.page-label title="Bills Show" />

    <div class="panel p-2  flex  flex-col  gap-2">
        <div class="flex justify-center items-center  border-b border-gray-100">
            <div class="flex items-center">
                <img src="https://t4.ftcdn.net/jpg/00/79/60/93/360_F_79609383_wxzSfzthQ0QAeGzPVSO2pr6vpWghVLnH.jpg"
                    alt="" srcset="" class="h-16 w-16 object-center">
                <h1 class="text-3xl font-bold tracking-widest text-primary">TeneWeb</h1>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <h1 class="font-bold capitalize">Name : {{ $bill->name }}</h1>
            <p class="text-xs text-gray-500">
                Gererated At: {{ date('F d, Y h:s A', strtotime($bill->created_at)) }}
            </p>
        </div>

        <h1 class="text-primary font-bold mt-2">
            Type: {{ $bill->type }}
        </h1>

        <div class="flex flex-col h-full justify-between">
            <div class="grid grid-cols-2 grid-flow-row gap-2">
                <h1 class="font-bold">Amount : </h1>
                <div class="w-full flex  justify-end">
                    <p> ₱ {{ number_format($bill->amount, 2) }}</p>
                </div>

            </div>

            <div class="grid grid-cols-2 grid-flow-row gap-2 border-t border-gray-100 py-2">
                <h1 class="font-bold">Total : </h1>
                <div class="w-full flex  justify-end">
                    <p> ₱ {{ number_format($bill->amount, 2) }}</p>
                </div>
            </div>
        </div>

        <button class="btn btn-primary text-accent">
            Pay
        </button>
    </div>
</x-dashboard.tenant.base>
