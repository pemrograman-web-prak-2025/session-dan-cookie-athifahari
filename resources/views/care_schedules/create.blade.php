<!-- resources/views/care_schedules/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ url()->previous() }}" class="text-green-500 hover:text-green-600 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Jadwal Perawatan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <form method="POST" action="{{ route('care-schedules.store') }}">
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
                                <option value="{{ $plant->id }}" {{ old('plant_id', request('plant_id')) == $plant->id ? 'selected' : '' }}>
                                    {{ $plant->name }} ({{ $plant->species }})
                                </option>
                                @endforeach
                            </select>
                            @error('plant_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Schedule Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Jenis Perawatan *</label>
                                <select name="type" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('type') border-red-500 @enderror"
                                        required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="siram" {{ old('type') == 'siram' ? 'selected' : '' }}>Siram</option>
                                    <option value="pupuk" {{ old('type') == 'pupuk' ? 'selected' : '' }}>Pupuk</option>
                                    <option value="potong" {{ old('type') == 'potong' ? 'selected' : '' }}>Potong/Pangkas</option>
                                    <option value="semprot_hama" {{ old('type') == 'semprot_hama' ? 'selected' : '' }}>Semprot Hama</option>
                                </select>
                                @error('type')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Interval (hari) *</label>
                                <input type="number" name="interval_days" value="{{ old('interval_days') }}" min="1"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('interval_days') border-red-500 @enderror"
                                       placeholder="Contoh: 7" required>
                                @error('interval_days')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Tanggal Berikutnya *</label>
                            <input type="date" name="next_date" value="{{ old('next_date') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('next_date') border-red-500 @enderror"
                                   required>
                            @error('next_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Catatan</label>
                            <textarea name="notes" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                                      placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4 pt-6">
                            <a href="{{ url()->previous() }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center">
                                <i class="fas fa-save mr-2"></i>Simpan Jadwal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>