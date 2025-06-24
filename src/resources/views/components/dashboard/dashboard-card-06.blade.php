<div class="w-full md:max-w-sm ">
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-sm rounded-xl">
            <div class="px-5 pt-5">
                <header class="flex items-center gap-2 ">
                    <i class="fa fa-user"></i>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Kepala Dinas</h2>
                </header>
            </div>
            <form method="post" class="flex flex-col p-5 gap-4" action="{{ route('admin.dashboard.update', 1) }}">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-4">
                    <x-input type="text" name="nama_pimpinan" placeholder="Nama"  value="{{$profilePimpinan->nama_pimpinan}}"
                    />
                    <x-input type="text" name="nip" placeholder="NIP"  value="{{$profilePimpinan->nip}}"
                    />
                    <x-input type="text" name="jabatan" placeholder="Jabatan" value="{{$profilePimpinan->jabatan}}"
                    />
                    <x-input type="text" name="website" placeholder="Link" value="{{$profilePimpinan->website}}"
                    />
                    <x-input type="email" name="email" placeholder="Email" value="{{$profilePimpinan->email}}"
                    />
                    <x-input type="tel" name="telp" placeholder="Phone" value="{{$profilePimpinan->telp}}"
                    />
                    <x-input type="tel" name="klpd" placeholder="KLPD" value="{{$profilePimpinan->klpd}}"
                    />
                </div>
                <x-button type="submit" class="">Simpan</x-button>
            </form>
        </div>
</div>
