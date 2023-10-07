<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('image/logo-himatikom.png') }}" type="image/x-icon">

    <!-- Scripts -->
    {{-- <script src="{{ asset('build/assets/app-540823bc.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-55bf8dae.css') }}"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- JQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Page Content -->
        <main>
            <div class="p-12">
                <img src="{{ asset('image/logo-himatikom.png') }}" alt="" class="w-[12rem] mx-auto my-[3rem]">

                <h3 class="text-3xl text-center font-bold tracking-tight text-gray-900 dark:text-white mb-6">
                    {{ $vote->event_name }}
                </h3>
                <div class="flex flex-wrap gap-4 justify-center">
                    <input type="hidden" name="token" id="token">
                    @foreach ($vote->subvote as $key => $sb)
                        <div
                            class="max-h-sm max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="">
                                <div class="flex flex-wrap justify-evenly gap-3 p-3">
                                    <img class="rounded-lg object-cover h-[15rem] w-[10rem] border-black border-[1px]"
                                        src="{{ asset('storage/' . $sb->candidate->foto_kahim) }}"
                                        alt="{{ $sb->candidate->nama_kahim }}"
                                        title="{{ $sb->candidate->nama_kahim }}" />
                                    <img class="rounded-lg object-cover h-[15rem] w-[10rem] border-black border-[1px]"
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
                                <div class="flex justify-center">
                                    <button class="w-20 bg-green-400 p-3 rounded-md hover:bg-green-500"
                                        onclick="pilihPaslon({{ $sb->vote->id }},{{ $sb->candidate->id }})">Pilih</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Harap Masukkan token sebelum memilih',
                input: 'text',
                showCancelButton: false,
                confirmButtonText: 'Submit',
                confirmButtonColor: '#1fcf00',
                showLoaderOnConfirm: true,
                preConfirm: (req) => {
                    $.ajax({
                        url: `/home/token-check`,
                        method: "POST",
                        data: {
                            _token: `{{ csrf_token() }}`,
                            token: req
                        },
                        success: function(result) {
                            if (result.icon == 'error') {
                                Swal.fire({
                                    icon: result.icon,
                                    title: 'Check Token Gagal',
                                    text: result.message,
                                    confirmButtonText: 'Ulangi',
                                    confirmButtonColor: '#26c733',
                                    allowOutsideClick: false
                                }).then((res) => {
                                    if (res.isConfirmed) {
                                        document.location.reload()
                                    }
                                })
                            } else {
                                Swal.fire(
                                    'Check Token Berhasil',
                                    `${result.message}`,
                                    `${result.icon}`
                                )
                                $('#token').val(result.token)
                            }
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                }
            })
        })

        function pilihPaslon(x, y) {
            let token = $('#token').val()
            console.log(token)
            if (!token) {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan pemilihan!',
                    text: 'Anda tidak dapat memilih jika belum menginputkan token!',
                }).then((res) => {
                    if (res.isConfirmed) location.reload()
                })
            } else {
                $.ajax({
                    url: `/subvote/vote/${x}`,
                    method: "POST",
                    data: {
                        _token: `{{ csrf_token() }}`,
                        candidate_id: y,
                    },
                    success: function(result) {
                        Swal.fire({
                            icon: `success`,
                            title: 'Pemilihan Kahim & Wakahim',
                            text: result.message
                        }).then((res) => {
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
        }
    </script>
</body>

</html>
