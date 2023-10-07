<x-app-layout>
    <x-slot name="title">
        {{ __('E-Vote HIMATIKOM') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $vote->event_name }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="grid gap-4 justify-center">
            @if (count($sub_vote) == 0)
                <div
                    class="w-[30rem] sm:max-w-sm md:max-w-md p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Belum
                        ada Paslon
                    </h5>
                </div>
            @else
                @foreach ($vote->subvote as $key => $sb)
                    <div
                        class="w-[30rem] sm:max-w-sm md:max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="">
                            <h3 class="text-3xl text-center font-bold tracking-tight text-gray-900 dark:text-white my-3">
                                Pasangan Calon No {{ $key + 1 }}</h3>
                            <div class="flex justify-evenly gap-3 p-3">
                                <img class="rounded-lg object-cover h-[15rem] w-[20rem] border-black border-[1px]"
                                    src="{{ asset('storage/' . $sb->candidate->foto_kahim) }}"
                                    alt="{{ $sb->candidate->nama_kahim }}" title="{{ $sb->candidate->nama_kahim }}" />
                                <img class="rounded-lg object-cover h-[15rem] w-[20rem] border-black border-[1px]"
                                    src="{{ asset('storage/' . $sb->candidate->foto_wakahim) }}"
                                    alt="{{ $sb->candidate->nama_wakahim }}"
                                    title="{{ $sb->candidate->nama_wakahim }}" />
                            </div>
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white mb-6">
                                    {{ $sb->candidate->nama_kahim }} & {{ $sb->candidate->nama_wakahim }}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif

            <form action="{{ route('subvote.store', ['votes' => $vote->id]) }}" method="POST"
                class="w-[30rem] sm:max-w-sm md:max-w-md">
                @csrf
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Paslon
                    untuk memulai voting</label>
                <div class="flex gap-4">
                    <select name="subvote"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        id="add-sub-vote">
                    </select>
                    <button
                        class="bg-green-400 p-2 rounded-lg text-sm border border-green-500 hover:bg-green-500">Tambah</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            if (`{{ Session::get('title') }}`) {
                Swal.fire({
                    icon: `{{ Session::get('icon') }}`,
                    title: `{{ Session::get('title') }}`,
                    text: `{{ Session::get('body') }}`,
                })
            }
            load()
        })

        // Load Candidates
        function load() {
            let html
            $.ajax({
                url: `/candidates/getall`,
                method: "GET",
                success: function(result) {
                    console.log(result)
                    result.forEach((res, index) => {
                        html +=
                            `<option value="${res.id}">${res.nama_kahim} & ${res.nama_wakahim}</option>`
                    });
                    $('#add-sub-vote').html(html)
                },
                error: function(err) {
                    console.log(err)
                }
            })
        }

        function handleAdd() {
            Swal.fire({
                title: 'Masukkan nama acara',
                input: 'text',
                inputAttribute: {
                    autocapitalize: 'off',
                },
                showCancelButton: true,
                confirmButtonText: 'Look up',
                showLoaderOnConfirm: true,
                preConfirm: (event) => {
                    $.ajax({
                        url: `/votes/store`,
                        method: "POST",
                        data: {
                            _token: `{{ csrf_token() }}`,
                            event_name: event
                        },
                        success: function(result) {
                            Swal.fire(
                                'Buat Event',
                                `${result.message}`,
                                'success',
                            ).then((res) => {
                                if (res.isConfirmed) {
                                    location.reload()
                                }
                            })
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                }
            })
        }

        function handleDelete(x) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus paslon ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/candidates/delete/${x}`,
                        method: "GET",
                        success: function(res) {
                            Swal.fire({
                                icon: res.icon,
                                title: res.title,
                                text: res.body
                            }).then((resss) => {
                                if (resss.isConfirmed) {
                                    location.reload()
                                }
                            })
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                }
            })
        }
    </script>
</x-app-layout>
