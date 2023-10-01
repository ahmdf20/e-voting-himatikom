<x-app-layout>
    <x-slot name="title">
        {{ __('Tambah Kandidat') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Kandidat') }}
        </h2>
    </x-slot>


    <div class="py-12 grid justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="w-full max-w-lg bg-gray-700 p-3 rounded-md text-white mb-6"
                action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="text-center font-bold mb-6">Calon Ketua Himpunan</h2>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2">
                            Foto
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="foto_kahim" id="foto_kahim" type="file">
                        @error('foto_kahim')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2">
                            Nama
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Nama Lengkap" name="nama_kahim" id="nama_kahim" type="text"
                            value="{{ old('nama_kahim') }}">
                        @error('nama_kahim')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2">
                            NIM
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="nim_kahim" id="nim_kahim" type="text" value="{{ old('nim_kahim') }}">
                        @error('nim_kahim')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2" for="grid-state">
                            Kelas
                        </label>
                        <div class="relative">
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="kelas_kahim" name="kelas_kahim">
                                <option>2A</option>
                                <option>2B</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h2 class="text-center font-bold mb-6">Calon Wakil Ketua Himpunan</h2>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2">
                            Foto
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="foto_wakahim" id="foto_wakahim" type="file">
                        @error('foto_wakahim')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2">
                            Nama
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder="Nama Lengkap" name="nama_wakahim" id="nama_wakahim"
                            value="{{ old('nama_wakahim') }}">
                        @error('nama_wakahim')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2">
                            NIM
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="nim_wakahim" name="nim_wakahim" type="text" value="{{ old('nim_wakahim') }}">
                        @error('nim_wakahim')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2" for="grid-state">
                            Kelas
                        </label>
                        <div class="relative">
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="kelas_wakahim" name="kelas_wakahim">
                                <option>2A</option>
                                <option>2B</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h2 class="text-center font-bold mb-6">Visi & Misi</h2>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2">
                            Visi
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="visi" id="visi" placeholder="Visi">
                        @error('visi')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 mb-3">
                        <label class="block uppercase tracking-wide  text-xs font-bold mb-2">
                            Misi
                        </label>
                        <textarea
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="misi" id="misi" rows="10"></textarea>
                        @error('misi')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="w-full mb-3">
                    <button class="p-3 text-white w-full bg-green-500 rounded-md">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
