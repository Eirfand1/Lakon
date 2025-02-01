<div class=" mt-6 md:w-96 ">
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <div class="px-5 pt-5">
                <header class="flex justify-between items-start ">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Profile Pimpinan</h2>
                </header>
            </div>
            <form method="post" class="flex flex-col p-5 gap-4" action="{{ route('admin.dashboard.update', 1) }}">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-4">
                    <input type="text" name="nama_pimpinan" placeholder="Nama"  value="{{$profilePimpinan->nama_pimpinan}}"
                    class="border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-500 p-2">
                    <input type="text" name="nip" placeholder="NIP"  value="{{$profilePimpinan->nip}}"
                    class="border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-500 p-2">
                    <input type="text" name="jabatan" placeholder="Jabatan" value="{{$profilePimpinan->jabatan}}"
                    class="border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-500 p-2">
                    <input type="text" name="website" placeholder="Link" value="{{$profilePimpinan->website}}"
                    class="border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-500 p-2">
                    <input type="email" name="email" placeholder="Email" value="{{$profilePimpinan->email}}"
                    class="border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-500 p-2">
                    <input type="tel" name="telp" placeholder="Phone" value="{{$profilePimpinan->telp}}"
                    class="border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-500 p-2">
                    <input type="tel" name="kipd" placeholder="KIPD" value="{{$profilePimpinan->kipd}}"
                    class="border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-500 p-2">
                </div>
                <button type="submit" class="p-2 rounded bg-gray-800 hover:bg-gray-700 text-white transition-colors dark:bg-gray-200 dark:hover:bg-gray-300 dark:text-gray-900">Simpan</button>
            </form>
        </div>
</div>
