<!-- resources/views/care_logs/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ url()->previous() }}" class="text-green-500 hover:text-green-600 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Catat Perawatan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <form method="POST" action="{{ route('care-logs.store') }}">
                    @csrf
                    <div class="space-y-6">
                        <!-- Plant Selection -->
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Pilih Tanaman *</label>
                            <select name="plant_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('plant_id') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Tanaman</option>
                                @foreach($plants as $plant)
                                <option value="{{ $plant->id }}" {{ old('plant_id', $plantId) == $plant->id ? 'selected' : '' }}>
                                    {{ $plant->name }} ({{ $plant->species }})
                                </option>
                                @endforeach
                            </select>
                            @error('plant_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Log Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Jenis Perawatan *</label>
                                <select name="action_type" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('action_type') border-red-500 @enderror"
                                        required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="siram" {{ old('action_type') == 'siram' ? 'selected' : '' }}>Siram</option>
                                    <option value="pupuk" {{ old('action_type') == 'pupuk' ? 'selected' : '' }}>Pupuk</option>
                                    <option value="potong" {{ old('action_type') == 'potong' ? 'selected' : '' }}>Potong/Pangkas</option>
                                    <option value="semprot_hama" {{ old('action_type') == 'semprot_hama' ? 'selected' : '' }}>Semprot Hama</option>
                                </select>
                                @error('action_type')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Tanggal Perawatan *</label>
                                <input type="date" name="date" value="{{ old('date', today()->format('Y-m-d')) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('date') border-red-500 @enderror"
                                       required>
                                @error('date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Catatan Perawatan</label>
                            <textarea name="notes" rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                                      placeholder="Deskripsi perawatan yang dilakukan...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-green-500 mr-3"></i>
                                <p class="text-green-800 text-sm">
                                    Dengan mencatat perawatan ini, jadwal berikutnya akan otomatis dihitung berdasarkan interval yang ditetapkan.
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6">
                            <a href="{{ url()->previous() }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>Simpan Catatan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>