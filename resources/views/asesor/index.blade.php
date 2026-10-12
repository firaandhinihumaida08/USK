<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Asesor Sertifikasi') }}
        </h2>
    </x-slot>
    {{-- =====================================================
        TOAST NOTIFICATION
    ====================================================== --}}
    @if (session('success'))
        <div id="successToast"
            class="fixed top-6 right-6 z-[9999] w-[380px] max-w-[calc(100%-30px)] bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden toast-enter">
            <div class="flex items-start gap-3 p-4">
                {{-- ICON SUCCESS --}}
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                {{-- PESAN --}}
                <div class="flex-1 pt-0.5">
                    <h3 class="text-sm font-semibold text-gray-900">
                        Berhasil!
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ session('success') }}
                    </p>
                </div>
                {{-- TOMBOL CLOSE --}}
                <button type="button" id="closeSuccessToast"
                    class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition duration-200 cursor-pointer"
                    aria-label="Tutup notifikasi">
                    <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            {{-- PROGRESS BAR 5 DETIK --}}
            <div class="h-1 bg-green-500 toast-progress"></div>
        </div>
    @endif
    {{-- =====================================================
        CONTENT
    ====================================================== --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                {{-- =====================================================
                    FORM PENCARIAN
                ====================================================== --}}
                <div
                    style="
                        display: flex;
                        justify-content: flex-end;
                        margin-bottom: 20px;
                    ">
                    <form action="{{ route('asesor.index') }}" method="GET"
                        style="
                            display: flex;
                            gap: 8px;
                            align-items: center;
                        ">
                        <input type="text" name="cari" value="{{ $search ?? '' }}" placeholder="Cari Asesor..."
                            style="
                                border: 1px solid #d1d5db;
                                border-radius: 6px;
                                padding: 7px 12px;
                                font-size: 14px;
                                outline: none;
                                width: 220px;
                            ">
                        <button type="submit"
                            style="
                                background-color: #111827;
                                color: #ffffff;
                                padding: 8px 16px;
                                border-radius: 6px;
                                font-size: 14px;
                                font-weight: 500;
                                border: none;
                                cursor: pointer;
                            ">
                            Cari
                        </button>
                    </form>
                </div>
                {{-- =====================================================
                    TABEL DAFTAR ASESOR
                ====================================================== --}}
                <table class="w-full border-collapse border border-gray-300 text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">
                                No
                            </th>
                            <th class="border p-2">
                                Nama Asesor
                            </th>
                            <th class="border p-2">
                                No Registrasi / MET
                            </th>
                            <th class="border p-2">
                                Keahlian
                            </th>
                            <th class="border p-2">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($asesors as $index => $asesor)
                            <tr>
                                {{-- NOMOR --}}
                                <td class="border p-2">
                                    {{ $asesors->firstItem() + $index }}
                                </td>
                                {{-- NAMA --}}
                                <td class="border p-2 font-medium">
                                    {{ $asesor->nama_asesor }}
                                </td>
                                {{-- NO REGISTRASI --}}
                                <td class="border p-2">
                                    {{ $asesor->no_registrasi ?? '-' }}
                                </td>
                                {{-- KEAHLIAN --}}
                                <td class="border p-2">
                                    {{ $asesor->keahlian ?? '-' }}
                                </td>
                                {{-- AKSI --}}
                                <td class="border p-2">
                                    <div class="flex gap-2 items-center">
                                        {{-- UBAH --}}
                                        <a href="{{ route('asesor.edit', $asesor->id) }}"
                                            class="text-indigo-600 hover:underline">
                                            Ubah
                                        </a>
                                        {{-- HAPUS --}}
                                        <form action="{{ route('asesor.destroy', $asesor->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data asesor ini?')"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4 text-gray-500">
                                    Belum ada data asesor sertifikasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- =====================================================
                    TOMBOL TAMBAH ASESOR
                ====================================================== --}}
                <div
                    style="
                        margin-top: 20px;
                        margin-bottom: 20px;
                    ">
                    <a href="{{ route('asesor.create') }}"
                        style="
                            background-color: #2563eb;
                            color: #ffffff;
                            padding: 8px 16px;
                            border-radius: 6px;
                            text-decoration: none;
                            font-weight: 500;
                            display: inline-block;
                        ">
                        + Tambah Asesor
                    </a>
                </div>
                {{-- =====================================================
                    PAGINATION
                ====================================================== --}}
                <div class="mt-4">
                    {{ $asesors->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- =====================================================
        TOAST CSS
    ====================================================== --}}
    <style>
        /*
        ============================================
        ANIMASI TOAST MASUK
        ============================================
        */
        .toast-enter {
            animation:
                toastEnter 0.4s ease-out forwards;
        }

        /*
        ============================================
        ANIMASI TOAST KELUAR
        ============================================
        */
        .toast-exit {
            animation:
                toastExit 0.4s ease-in forwards;
        }

        /*
        ============================================
        PROGRESS BAR 5 DETIK
        ============================================
        */
        .toast-progress {
            animation:
                toastProgress 5s linear forwards;
        }

        /*
        ============================================
        ANIMASI MASUK
        ============================================
        */
        @keyframes toastEnter {
            from {
                opacity: 0;
                transform:
                    translateX(100px);
            }

            to {
                opacity: 1;
                transform:
                    translateX(0);
            }
        }

        /*
        ============================================
        ANIMASI KELUAR
        ============================================
        */
        @keyframes toastExit {
            from {
                opacity: 1;
                transform:
                    translateX(0);
            }

            to {
                opacity: 0;
                transform:
                    translateX(100px);
            }
        }

        /*
        ============================================
        PROGRESS BAR
        ============================================
        */
        @keyframes toastProgress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>
    {{-- =====================================================
        TOAST JAVASCRIPT
    ====================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /*
            ============================================
            AMBIL ELEMENT TOAST
            ============================================
            */
            const toast =
                document.getElementById('successToast');
            const closeButton =
                document.getElementById('closeSuccessToast');
            /*
            ============================================
            KALAU TOAST TIDAK ADA
            ============================================
            */
            if (!toast) {
                return;
            }
            /*
            ============================================
            FUNGSI MENUTUP TOAST
            ============================================
            */
            function hideToast() {
                /*
                Hapus animasi masuk
                */
                toast.classList.remove(
                    'toast-enter'
                );
                /*
                Tambahkan animasi keluar
                */
                toast.classList.add(
                    'toast-exit'
                );
                /*
                Hapus element setelah
                animasi selesai
                */
                setTimeout(function() {
                    if (toast) {
                        toast.remove();
                    }
                }, 400);
            }
            /*
            ============================================
            TOMBOL X
            ============================================
            */
            if (closeButton) {
                closeButton.addEventListener(
                    'click',
                    function() {
                        hideToast();
                    }
                );
            }
            /*
            ============================================
            OTOMATIS HILANG 5 DETIK
            ============================================
            */
            setTimeout(function() {
                /*
                Cek apakah toast
                masih ada
                */
                if (
                    document.getElementById(
                        'successToast'
                    )
                ) {
                    hideToast();
                }
            }, 5000);
        });
    </script>
</x-app-layout>
