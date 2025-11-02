<!-- resources/views/plants/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('plants.index') }}" class="text-green-500 hover:text-green-600 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Tanaman Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <form method="POST" action="{{ route('plants.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <!-- Photo -->
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Foto Tanaman</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                        <p class="mb-2 text-sm text-gray-500">Klik untuk upload foto</p>
                                        <p class="text-xs text-gray-500">PNG, JPG (Max. 2MB)</p>
                                    </div>
                                    <input id="photo" name="photo" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                            <div id="photo-preview" class="mt-3 hidden">
                                <img id="preview-image" class="max-w-xs rounded-lg shadow-md">
                            </div>
                        </div>

                        <!-- Basic Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Nama Tanaman *</label>
                                <input type="text" name="name" value="{{ old('name') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                       required>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Jenis/Spesies *</label>
                                <input type="text" name="species" value="{{ old('species') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('species') border-red-500 @enderror"
                                       required>
                                @error('species')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Kategori *</label>
                            <select name="category" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('category') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Kategori</option>
                                <option value="Hias Dalam" {{ old('category') == 'Hias Dalam' ? 'selected' : '' }}>Hias Dalam</option>
                                <option value="Hias Luar" {{ old('category') == 'Hias Luar' ? 'selected' : '' }}>Hias Luar</option>
                                <option value="Sayuran" {{ old('category') == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                                <option value="Buah" {{ old('category') == 'Buah' ? 'selected' : '' }}>Buah</option>
                                <option value="Herbal" {{ old('category') == 'Herbal' ? 'selected' : '' }}>Herbal</option>
                                <option value="Sukulen" {{ old('category') == 'Sukulen' ? 'selected' : '' }}>Sukulen</option>
                                <option value="Umum" {{ old('category') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Catatan</label>
                            <textarea name="notes" rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                                      placeholder="Catatan tentang tanaman...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4 pt-6">
                            <a href="{{ route('plants.index') }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center">
                                <i class="fas fa-save mr-2"></i>Simpan Tanaman
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Photo preview
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                    document.getElementById('photo-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>