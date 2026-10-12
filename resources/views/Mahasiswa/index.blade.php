<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Sertifikasi Mahasiswa') }}
        </h2>
    </x-slot>

    {{-- =========================
        TOAST NOTIFICATION
    ========================== --}}

    {{-- Notifikasi Berhasil --}}
    @if (session('success'))
        <div id="successToast"
            class="fixed top-6 right-6 z-[9999] flex items-center gap-3
                   bg-green-500 text-white px-5 py-4 rounded-lg shadow-lg
                   transition-all duration-500">

            {{-- Icon Check --}}
            <div class="flex items-center justify-center w-7 h-7 bg-white/20 rounded-full">
                ✓
            </div>

            <div>
                <p class="font-semibold">Berhasil!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>

            {{-- Tombol Close --}}
            <button onclick="closeToast('successToast')"
                class="ml-3 text-white hover:text-gray-200 text-xl leading-none">
                ×
            </button>
        </div>
    @endif


    {{-- Notifikasi Error --}}
    @if (session('error'))
        <div id="errorToast"
            class="fixed top-6 right-6 z-[9999] flex items-center gap-3
                   bg-red-500 text-white px-5 py-4 rounded-lg shadow-lg
                   transition-all duration-500">

            {{-- Icon Error --}}
            <div class="flex items-center justify-center w-7 h-7 bg-white/20 rounded-full">
                !
            </div>

            <div>
                <p class="font-semibold">Gagal!</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>

            {{-- Tombol Close --}}
            <button onclick="closeToast('errorToast')"
                class="ml-3 text-white hover:text-gray-200 text-xl leading-none">
                ×
            </button>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{-- =========================
                    HEADER + SEARCH
                ========================== --}}
                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('mahasiswa.create') }}"
                        style="background-color: #2563eb; color: #ffffff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; display: inline-block;">
                        + Tambah Mahasiswa
                    </a>

                    {{-- Form Pencarian --}}
                    <form action="{{ route('mahasiswa.index') }}"
                        method="GET"
                        class="flex gap-2">
                        <input type="text"
                            name="cari"
                            value="{{ $search ?? '' }}"
                            placeholder="Cari NIM, Nama, Prodi..."
                            class="border border-gray-300 rounded-lg px-3 py-2
                                focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit"
                            class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg transition">
                            Cari
                        </button>
                    </form>
                </div>


                {{-- =========================
                    TABLE DATA MAHASISWA
                ========================== --}}
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-3">
                                    No
                                </th>
                                <th class="border p-3">
                                    NIM
                                </th>
                                <th class="border p-3">
                                    Nama Lengkap
                                </th>
                                <th class="border p-3">
                                    Program Studi
                                </th>
                                <th class="border p-3">
                                    Skema & Status
                                </th>
                                <th class="border p-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($mahasiswas as $key => $m)
                                <tr class="hover:bg-gray-50">
                                    {{-- No --}}
                                    <td class="border p-3">
                                        {{ $mahasiswas->firstItem() + $key }}
                                    </td>

                                    {{-- NIM --}}
                                    <td class="border p-3">
                                        {{ $m->nim }}
                                    </td>

                                    {{-- Nama --}}
                                    <td class="border p-3 font-medium">
                                        {{ $m->nama_lengkap }}
                                    </td>

                                    {{-- Program Studi --}}
                                    <td class="border p-3">
                                        {{ $m->program_studi }}
                                    </td>

                                    {{-- Skema + Status --}}
                                    <td class="border p-3">
                                        <div class="font-medium">
                                            {{ $m->skema->nama_skema ?? '-' }}
                                        </div>
                                        <span
                                            class="inline-block mt-1 text-xs px-2 py-1 rounded-full
                                            @if ($m->status == 'Kompeten')
                                                bg-green-100 text-green-800
                                            @elseif ($m->status == 'Belum Kompeten')
                                                bg-red-100 text-red-800
                                            @else
                                                bg-yellow-100 text-yellow-800
                                            @endif
                                            ">
                                            {{ $m->status }}
                                        </span>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="border p-3">
                                        <div class="flex gap-3 items-center">

                                            {{-- Detail --}}
                                            <a href="{{ route('mahasiswa.show', $m->id) }}"
                                                class="text-blue-600 hover:underline">
                                                Detail
                                            </a>

                                            {{-- Ubah --}}
                                            <a href="{{ route('mahasiswa.edit', $m->id) }}"
                                                class="text-yellow-600 hover:underline">
                                                Ubah
                                            </a>

                                            {{-- Cetak --}}
                                            @if ($m->status != 'Menunggu')
                                                <a href="{{ route('mahasiswa.cetak', $m->id) }}"
                                                    target="_blank"
                                                    class="text-green-600 hover:underline font-semibold">
                                                    Cetak
                                                </a>
                                            @else
                                                <span
                                                    class="text-gray-400 cursor-not-allowed select-none"
                                                    title="Status masih Menunggu, belum dapat dicetak">
                                                    Cetak
                                                </span>
                                            @endif

                                            {{-- Hapus --}}
                                            <form action="{{ route('mahasiswa.destroy', $m->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="text-center p-6 text-gray-500">
                                        Belum ada data mahasiswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- =========================
                    PAGINATION
                ========================== --}}
                <div class="mt-6">
                    {{ $mahasiswas->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>


    {{-- =========================
        TOAST JAVASCRIPT
    ========================== --}}
    <script>
        // Fungsi menutup toast
        function closeToast(id) {
            const toast = document.getElementById(id);
            if (toast) {
                toast.classList.add('opacity-0');
                toast.classList.add('translate-x-10');
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }
        }


        // Toast otomatis hilang setelah 4 detik
        document.addEventListener('DOMContentLoaded', function () {
            const successToast = document.getElementById('successToast');
            const errorToast = document.getElementById('errorToast');
            if (successToast) {
                setTimeout(() => {
                    closeToast('successToast');
                }, 4000);
            }
            if (errorToast) {
                setTimeout(() => {
                    closeToast('errorToast');
                }, 4000);
            }
        });
    </script>
</x-app-layout>