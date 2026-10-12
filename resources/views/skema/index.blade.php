<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Skema Sertifikasi') }}
        </h2>
    </x-slot>

    {{-- Toast Success --}}
    @if (session('success'))
        <div id="successToast"
            class="fixed top-6 right-6 z-[9999] w-[380px] max-w-[calc(100%-30px)] bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden toast-enter">

            <div class="flex items-start gap-3 p-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="flex-1">
                    <h3 class="text-sm font-semibold text-gray-900">Berhasil!</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ session('success') }}</p>
                </div>

                <button type="button" id="closeSuccessToast"
                    class="text-gray-400 hover:text-gray-600 transition"
                    aria-label="Tutup notifikasi">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="h-1 bg-green-500 toast-progress"></div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">

                {{-- Search --}}
                <div class="flex justify-between mb-4">
                    <a href="{{ route('skema.create') }}"
                        style="background-color: #2563eb; color: #ffffff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; display: inline-block;">
                        + Tambah Skema
                    </a>

                    <form action="{{ route('skema.index') }}" method="GET" class="flex gap-2">
                        <input type="text" name="cari" value="{{ $search ?? '' }}"
                            placeholder="Cari Kode atau Nama Skema..."
                            class="border rounded px-3 py-1">

                        <button class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-1 rounded">
                            Cari
                        </button>
                    </form>
                </div>

                {{-- Table --}}
                <table class="w-full border-collapse border border-gray-300 text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">No</th>
                            <th class="border p-2">Kode Skema</th>
                            <th class="border p-2">Nama Skema</th>
                            <th class="border p-2">Jenis</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($skemas as $index => $skema)
                            <tr>
                                <td class="border p-2">
                                    {{ $skemas->firstItem() + $index }}
                                </td>

                                <td class="border p-2 font-medium">
                                    {{ $skema->kode_skema ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $skema->nama_skema }}
                                </td>

                                <td class="border p-2">
                                    {{ $skema->jenis ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    <div class="flex gap-2">
                                        <a href="{{ route('skema.edit', $skema->id) }}"
                                            class="text-indigo-600 hover:underline">
                                            Ubah
                                        </a>

                                        <form action="{{ route('skema.destroy', $skema->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus skema ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="text-red-600 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4 text-gray-500">
                                    Belum ada data skema sertifikasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Add Button --}}
                <div class="my-5">
                    <a href="{{ route('skema.create') }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded font-medium hover:bg-blue-700">
                        + Tambah Skema
                    </a>
                </div>

                {{-- Pagination --}}
                {{ $skemas->withQueryString()->links() }}

            </div>
        </div>
    </div>

    {{-- Toast Style --}}
    <style>
        .toast-enter {
            animation: toastEnter .4s ease-out forwards;
        }

        .toast-exit {
            animation: toastExit .4s ease-in forwards;
        }

        .toast-progress {
            animation: toastProgress 5s linear forwards;
        }

        @keyframes toastEnter {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes toastExit {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }

        @keyframes toastProgress {
            from {
                width: 100%;
            }

            to {
                width: 0;
            }
        }
    </style>

    {{-- Toast Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('successToast');
            const close = document.getElementById('closeSuccessToast');

            if (!toast) return;

            const hideToast = () => {
                toast.classList.remove('toast-enter');
                toast.classList.add('toast-exit');

                setTimeout(() => toast.remove(), 400);
            };

            close?.addEventListener('click', hideToast);
            setTimeout(hideToast, 5000);
        });
    </script>

</x-app-layout>
