<!-- resources/views/plants/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('plants.index') }}" class="text-green-500 hover:text-green-600 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Tanaman') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <form method="POST" action="{{ route('plants.update', $plant) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <!-- Current Photo -->
                        @if($plant->photo)
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Foto Saat Ini</label>
                            <img src="{{ asset('storage/' . $plant->photo) }}" alt="{{ $plant->name }}" 
                                 class="w-48 h-48 object-cover rounded-lg shadow-md">
                        </div>
                        @endif

                        <!-- Photo Update -->
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">
                                {{ $plant->photo ? 'Ganti Foto' : 'Tambah Foto' }}
                            </label>
                            <input type="file" name="photo" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   accept="image/*">
                        </div>

                        <!-- Basic Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Nama Tanaman *</label>
                                <input type="text" name="name" value="{{ old('name', $plant->name) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                       required>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Jenis/Spesies *</label>
                                <input type="text" name="species" value="{{ old('species', $plant->species) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                       required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Kategori *</label>
                            <select name="category" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    required>
                                <option value="Hias Dalam" {{ $plant->category == 'Hias Dalam' ? 'selected' : '' }}>Hias Dalam</option>
                                <option value="Hias Luar" {{ $plant->category == 'Hias Luar' ? 'selected' : '' }}>Hias Luar</option>
                                <option value="Sayuran" {{ $plant->category == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                                <option value="Buah" {{ $plant->category == 'Buah' ? 'selected' : '' }}>Buah</option>
                                <option value="Herbal" {{ $plant->category == 'Herbal' ? 'selected' : '' }}>Herbal</option>
                                <option value="Sukulen" {{ $plant->category == 'Sukulen' ? 'selected' : '' }}>Sukulen</option>
                                <option value="Umum" {{ $plant->category == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Catatan</label>
                            <textarea name="notes" rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                      placeholder="Catatan tentang tanaman...">{{ old('notes', $plant->notes) }}</textarea>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6">
                            <a href="{{ route('plants.index') }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center">
                                <i class="fas fa-save mr-2"></i>Perbarui Tanaman
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>