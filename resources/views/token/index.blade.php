<x-app-layout>
    <x-slot name="title">
        {{ __('E-Vote HIMATIKOM') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Access Token') }}
        </h2>
    </x-slot>

    <div class="p-12">

        <div class="my-4">
            <button class="p-3 bg-green-400 hover:bg-green-500 rounded-md mb-4 shadow-xl" onclick="generateToken()">Tambah
                Token</button>

            <h4 class="float-right">Total token : {{ count($tokens) }}</h4>
        </div>

        <div class="flex flex-wrap gap-4 justify-center">
            @if (count($tokens) < 0)
            @endif

            @foreach ($tokens as $key => $token)
                <a href="#" onclick="handleDelete({{ $token->id }})"
                    class="block max-w-sm p-3 w-[12rem] h-[6rem] bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $token->token }}</h5>
                    <p class="text-center">{{ $token->is_used == 1 ? 'Terpakai' : 'Belum Terpakai' }}</p>
                </a>
            @endforeach
        </div>



        {{-- {{ $tokens->links() }} --}}


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
        })

        function handleDelete(x) {
            Swal.fire({
                icon: 'question',
                title: 'Menghapus token',
                text: 'Apakah anda yakin ingin menghapus token ini?',
                showCancelButton: true,
                confirmButtonText: 'Hapus!',
                confirmButtonColor: '#d33',
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: `/access-token/delete/${x}`,
                        method: "GET",
                        success: function(result) {
                            Swal.fire({
                                icon: result.icon,
                                title: 'Hapus Token',
                                text: result.message
                            }).then((res) => {
                                if (res.isConfirmed) location.reload()
                            })
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                }
            })



        }

        function generateToken() {
            Swal.fire({
                title: 'Masukkan jumlah token yang ingin dibuat',
                input: 'number',
                inputAttribute: {
                    autocapitalize: 'off',
                },
                showCancelButton: true,
                confirmButtonText: 'Buat',
                showLoaderOnConfirm: true,
                preConfirm: (req) => {
                    $.ajax({
                        url: `/access-token/store`,
                        method: "POST",
                        data: {
                            _token: `{{ csrf_token() }}`,
                            limit: req
                        },
                        success: function(result) {
                            Swal.fire(
                                'Generate Token',
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
    </script>
</x-app-layout>
