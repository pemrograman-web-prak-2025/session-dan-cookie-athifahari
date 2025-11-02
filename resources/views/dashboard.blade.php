<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <i class="fas fa-leaf mr-3 text-green-500"></i>
            {{ __('Dashboard PlantCare') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="fas fa-seedling text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Tanaman</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $plants->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-tasks text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Perawatan Hari Ini</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $todaySchedules->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <i class="fas fa-calendar-alt text-2xl text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Jadwal Mendatang</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $upcomingSchedules->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Today's Schedule -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Perawatan Hari Ini</h2>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ \Carbon\Carbon::today()->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    @if($todaySchedules->count() > 0)
                    <div class="space-y-4">
                        @foreach($todaySchedules as $schedule)
                        <div class="border-l-4 border-green-500 bg-green-50 p-4 rounded-r-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $schedule->plant->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-{{ $schedule->type == 'siram' ? 'tint' : ($schedule->type == 'pupuk' ? 'flask' : 'cut') }} mr-1"></i>
                                        {{ ucfirst($schedule->type) }}
                                    </p>
                                    @if($schedule->notes)
                                    <p class="text-sm text-gray-500 mt-1">{{ $schedule->notes }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('care-logs.create') }}?plant_id={{ $schedule->plant_id }}" 
                                   class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm transition flex items-center">
                                    <i class="fas fa-check mr-1"></i>Selesai
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <i class="fas fa-check-circle text-4xl text-green-300 mb-4"></i>
                        <p class="text-gray-500">Tidak ada jadwal perawatan untuk hari ini</p>
                    </div>
                    @endif
                </div>

                <!-- Upcoming Schedule & Quick Actions -->
                <div class="space-y-6">
                    <!-- Upcoming Schedule -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Jadwal Mendatang</h2>
                        
                        @if($upcomingSchedules->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingSchedules as $schedule)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $schedule->plant->name }}</h3>
                                    <p class="text-sm text-gray-600">
                                        {{ ucfirst($schedule->type) }} • 
                                        {{ $schedule->next_date->translatedFormat('d M') }}
                                    </p>
                                </div>
                                <span class="text-sm text-gray-500">
                                    {{ $schedule->next_date->diffForHumans() }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-4">
                            <p class="text-gray-500">Tidak ada jadwal mendatang</p>
                        </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Aksi Cepat</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('plants.create') }}" 
                               class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center transition duration-300 card-hover">
                                <i class="fas fa-plus text-2xl mb-2"></i>
                                <p class="font-semibold">Tambah Tanaman</p>
                            </a>
                            <a href="{{ route('care-schedules.create') }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center transition duration-300 card-hover">
                                <i class="fas fa-calendar-plus text-2xl mb-2"></i>
                                <p class="font-semibold">Jadwal Baru</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>