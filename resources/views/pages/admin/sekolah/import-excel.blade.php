<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <a href="/admin/sekolah"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    < Kembali </a>
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            Import to Excel
                        </h1>

            </div>
        </div>

        <!-- Import Form Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            @if (session('success'))

                <div role="alert" class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>

                        {{session('success')}}
                    </span>
                </div>
            @endif
            <!-- error message -->

            @if (session('error'))

                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>

                        {{session('error')}}
                    </span>
                </div>
            @endif
            <form action="{{ url('/admin/sekolah/import-sekolah') }}" method="POST" enctype="multipart/form-data"
                class="">
                @csrf
                <div class="flex flex-col space-y-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pilih File Excel
                    </label>
                    <div class="flex gap-4 flex-col items-center ">
                        <input type="file" name="file" required class="block w-full text-sm text-gray-500 dark:text-gray-400
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-medium
                                   file:bg-indigo-50 file:text-indigo-700
                                   hover:file:bg-indigo-100
                                   dark:file:bg-gray-700 dark:file:text-gray-300">
                        <button type="submit" class="btn w-full text-white btn-success">
                            <i class="fa-solid fa-file-import"></i>
                            <span>
                                Import Data
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>