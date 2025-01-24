<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Dashboard</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">


                <!-- Datepicker built with flatpickr -->
                <x-datepicker />


            </div>

        </div>

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Permohonan kontrak baru -->
           <x-dashboard.dashboard-card-05 />

           <!-- Paket Pekerjaan -->
           <x-dashboard.dashboard-card-01 :dataFeed="$dataFeed" />

           <!-- Tender -->
           <x-dashboard.dashboard-card-02 :dataFeed="$dataFeed" />

           <!-- Non Tender -->
           <x-dashboard.dashboard-card-03 :dataFeed="$dataFeed" />

           <!-- e-Catalog -->
           <x-dashboard.dashboard-card-04 />
        </div>
        <x-dashboard.dashboard-card-06 />
    </div>
</x-app-layout>