<!-- resources/views/plants/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('plants.index') }}" class="text-green-500 hover:text-green-600 mr-4">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $plant->name }}
                    </h2>
                    <p class="text-sm text-gray-600">{{ $plant->species }}</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('plants.edit', $plant) }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition flex items-center">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('care-schedules.create') }}?plant_id={{ $plant->id }}" 
                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition flex items-center">
                    <i class="fas fa-calendar-plus mr-2"></i>Jadwal
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Plant Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Photo & Basic Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @if($plant->photo)
                            <div class="md:col-span-1">
                                <img src="{{ asset('storage/' . $plant->photo) }}" alt="{{ $plant->name }}" 
                                     class="w-full h-64 object-cover rounded-lg shadow-md">
                            </div>
                            @endif
                            <div class="{{ $plant->photo ? 'md:col-span-2' : 'md:col-span-3' }}">
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="text-sm text-gray-500">Kategori</label>
                                        <p class="font-semibold text-gray-800">{{ $plant->category }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-500">Ditambahkan</label>
                                        <p class="font-semibold text-gray-800">{{ $plant->created_at->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                                
                                @if($plant->notes)
                                <div>
                                    <label class="text-sm text-gray-500">Catatan</label>
                                    <p class="text-gray-800 mt-1">{{ $plant->notes }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Care Schedules -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Jadwal Perawatan</h2>
                            <a href="{{ route('care-schedules.create') }}?plant_id={{ $plant->id }}" 
                               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition flex items-center text-sm">
                                <i class="fas fa-plus mr-1"></i>Tambah Jadwal
                            </a>
                        </div>

                        @if($plant->careSchedules->count() > 0)
                        <div class="space-y-4">
                            @foreach($plant->careSchedules as $schedule)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="flex items-center mb-2">
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium mr-3">
                                                {{ ucfirst($schedule->type) }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                Setiap {{ $schedule->interval_days }} hari
                                            </span>
                                        </div>
                                        <p class="text-gray-600">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            Berikutnya: {{ $schedule->next_date->translatedFormat('d F Y') }}
                                        </p>
                                        @if($schedule->notes)
                                        <p class="text-gray-500 text-sm mt-2">{{ $schedule->notes }}</p>
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('care-schedules.edit', $schedule) }}" 
                                           class="text-blue-500 hover:text-blue-600">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('care-schedules.destroy', $schedule) }}" method="POST"
                                              onsubmit="return confirm('Hapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Belum ada jadwal perawatan</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('care-logs.create') }}?plant_id={{ $plant->id }}" 
                               class="w-full bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg transition flex items-center justify-center">
                                <i class="fas fa-plus-circle mr-2"></i>Catat Perawatan
                            </a>
                        </div>
                    </div>

                    <!-- Recent Care Logs -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Perawatan</h3>
                        
                        @if($careLogs->count() > 0)
                        <div class="space-y-3">
                            @foreach($careLogs->take(5) as $log)
                            <div class="border-l-4 border-green-500 bg-green-50 p-3 rounded-r-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ ucfirst($log->action_type) }}</p>
                                        <p class="text-sm text-gray-600">{{ $log->date->translatedFormat('d M Y') }}</p>
                                        @if($log->notes)
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($log->notes, 50) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            @if($careLogs->count() > 5)
                            <div class="text-center mt-4">
                                <a href="{{ route('care-logs.create') }}?plant_id={{ $plant->id }}" 
                                   class="text-green-500 hover:text-green-600 font-semibold text-sm">
                                    Lihat Semua Riwayat
                                </a>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="fas fa-history text-3xl text-gray-300 mb-2"></i>
                            <p class="text-gray-500 text-sm">Belum ada riwayat perawatan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>