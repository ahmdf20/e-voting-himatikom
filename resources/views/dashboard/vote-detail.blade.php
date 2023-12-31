<x-app-layout>
    <x-slot name="title">
        {{ __('E-Vote HIMATIKOM') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ $vote->event_name }}
        </h2>
    </x-slot>

    <div class="p-12">

        <div class="flex flex-wrap mb-[4rem] justify-evenly text-2xl">
            <h4>Total anggota yang belum memilih : {{ $token_unused }}</h4>
            <h4>Total anggota yang telah memilih : {{ $token_used }}</h4>
        </div>

        <div class="flex flex-wrap gap-4 justify-center">
            @foreach ($vote->subvote as $key => $sb)
                <div
                    class="w-[30rem] sm:max-w-sm md:max-w-md bg-white border rounded-lg shadow-xl dark:bg-gray-800 dark:border-gray-700">
                    <a href="">
                        <h3 class="text-3xl text-center font-bold tracking-tight text-gray-900 dark:text-white my-4">
                            Pasangan Calon No. {{ $key + 1 }}</h3>
                        <div class="flex flex-wrap justify-evenly gap-3 p-3">
                            <img class="rounded-lg object-cover h-[15rem] w-[10rem]"
                                src="{{ asset('storage/' . $sb->candidate->foto_kahim) }}"
                                alt="{{ $sb->candidate->nama_kahim }}" title="{{ $sb->candidate->nama_kahim }}" />
                            <img class="rounded-lg object-cover h-[15rem] w-[10rem]"
                                src="{{ asset('storage/' . $sb->candidate->foto_wakahim) }}"
                                alt="{{ $sb->candidate->nama_wakahim }}" title="{{ $sb->candidate->nama_wakahim }}" />
                        </div>
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <div class="text-center mb-6">
                                <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-3">
                                    {{ $sb->candidate->nama_kahim }}</h5>
                                <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-3">
                                    &</h5>
                                <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-3">
                                    {{ $sb->candidate->nama_wakahim }}</h5>
                            </div>

                        </a>
                        <div class="text-center my-3">
                            <h4 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-3">
                                Total Suara : </h4>
                            <h4 class="text-6xl font-extrabold">{{ $sb->score }}</h4>
                        </div>

                    </div>
                </div>
            @endforeach
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
