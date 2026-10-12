
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Informasi Login -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Container Utama -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-8">

                <!-- Tabel Kompeten -->
                <div>
                    <h3 class="text-base font-semibold text-green-600 mb-3 flex items-center">
                        <span class="w-2.5 h-2.5 bg-green-500 rounded-full mr-2"></span>
                        Kompeten
                    </h3>

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50">
                                <tr class="text-sm text-gray-700 border-b border-gray-200">
                                    <th class="py-3 px-4 font-semibold border-r border-gray-200 w-1/2">
                                        Nama Lengkap
                                    </th>
                                    <th class="py-3 px-4 font-semibold">
                                        Skema Sertifikasi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="text-sm divide-y divide-gray-200">
                                @forelse($mahasiswaKompeten ?? [] as $mhs)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 text-gray-800 border-r border-gray-200">
                                            {{ $mhs->nama_lengkap }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">
                                            {{ $mhs->skema->nama_skema ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-4 px-4 text-center text-gray-400">
                                            Tidak ada data.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tabel Belum Kompeten -->
                <div>
                    <h3 class="text-base font-semibold text-red-600 mb-3 flex items-center">
                        <span class="w-2.5 h-2.5 bg-red-500 rounded-full mr-2"></span>
                        Belum Kompeten
                    </h3>

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50">
                                <tr class="text-sm text-gray-700 border-b border-gray-200">
                                    <th class="py-3 px-4 font-semibold border-r border-gray-200 w-1/2">
                                        Nama Lengkap
                                    </th>
                                    <th class="py-3 px-4 font-semibold">
                                        Skema Sertifikasi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="text-sm divide-y divide-gray-200">
                                @forelse($mahasiswaBelumKompeten ?? [] as $mhs)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 text-gray-800 border-r border-gray-200">
                                            {{ $mhs->nama_lengkap }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">
                                            {{ $mhs->skema->nama_skema ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-4 px-4 text-center text-gray-400">
                                            Tidak ada data.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tabel Menunggu -->
                <div>
                    <h3 class="text-base font-semibold text-yellow-600 mb-3 flex items-center">
                        <span class="w-2.5 h-2.5 bg-yellow-500 rounded-full mr-2"></span>
                        Menunggu
                    </h3>

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50">
                                <tr class="text-sm text-gray-700 border-b border-gray-200">
                                    <th class="py-3 px-4 font-semibold border-r border-gray-200 w-1/2">
                                        Nama Lengkap
                                    </th>
                                    <th class="py-3 px-4 font-semibold">
                                        Skema Sertifikasi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="text-sm divide-y divide-gray-200">
                                @forelse($mahasiswaMenunggu ?? [] as $mhs)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 text-gray-800 border-r border-gray-200">
                                            {{ $mhs->nama_lengkap }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">
                                            {{ $mhs->skema->nama_skema ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-4 px-4 text-center text-gray-400">
                                            Tidak ada data.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>