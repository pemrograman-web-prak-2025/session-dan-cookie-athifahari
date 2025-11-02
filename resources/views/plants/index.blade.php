<!-- resources/views/plants/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <i class="fas fa-seedling mr-3 text-green-500"></i>
            {{ __('Daftar Tanaman Saya') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <p class="text-gray-600">Kelola semua tanaman Anda di satu tempat</p>
                </div>
                <a href="{{ route('plants.create') }}" 
                   class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Tanaman
                </a>
            </div>

            @if($plants->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($plants as $plant)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                    @if($plant->photo)
                    <img src="{{ asset('storage/' . $plant->photo) }}" alt="{{ $plant->name }}" 
                         class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-green-100 flex items-center justify-center">
                        <i class="fas fa-seedling text-6xl text-green-400"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-800">{{ $plant->name }}</h3>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $plant->category }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 mb-2">
                            <i class="fas fa-leaf mr-2"></i>{{ $plant->species }}
                        </p>
                        
                        @if($plant->notes)
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $plant->notes }}</p>
                        @endif

                        <div class="flex justify-between items-center">
                            <a href="{{ route('plants.show', $plant) }}" 
                               class="text-green-500 hover:text-green-600 font-semibold flex items-center">
                                Detail <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('plants.edit', $plant) }}" 
                                   class="text-blue-500 hover:text-blue-600">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('plants.destroy', $plant) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus tanaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-seedling text-6xl text-green-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada tanaman</h3>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan tanaman pertama Anda</p>
                <a href="{{ route('plants.create') }}" 
                   class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Tanaman Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>