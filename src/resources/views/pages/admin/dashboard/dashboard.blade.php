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
        <div class="flex flex-col md:flex-row gap-6 ">
			<x-dashboard.dashboard-card-06 :profilePimpinan="$profile_pimpinan"/>
			<div class="w-full md:flex-1 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-4 auto-rows-max">
				<x-dashboard.dashboard-card-05 :permohonanKontrak="$permohonan_kontrak"/>

				<!-- Paket Pekerjaan -->
				<x-dashboard.dashboard-card-01 :paketPekerjaan="$paket_pekerjaan" />

				<!-- Tender -->
				<x-dashboard.dashboard-card-02  :tender="$tender"/>

				<!-- Non Tender -->
				<x-dashboard.dashboard-card-03 :nonTender="$non_tender" />

				<!-- e-Catalog -->
				<x-dashboard.dashboard-card-04 :eCatalog="$e_catalog" />
			</div>
            <!-- Permohonan kontrak baru -->
			
			
        </div>
        
    </div>
</x-app-layout>
