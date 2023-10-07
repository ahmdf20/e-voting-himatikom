<x-app-layout>
    <x-slot name="title">
        {{ __('E-Vote HIMATIKOM') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Voting') }}
        </h2>
    </x-slot>

    <div class="p-12">

        <div class="grid gap-4 justify-center">
            @foreach ($votes as $key => $vote)
                <div
                    class="w-[30rem] sm:max-w-sm md:max-w-md p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $vote->event_name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dibuat pada {{ $vote->voting_date }}</p>
                    <a href="{{ route('votes.show', ['votes' => $vote->id]) }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Detail
                        <i class="fa-solid fa-arrow-right pl-2"></i>
                    </a>
                </div>
            @endforeach

            <div
                class="grid mx-auto max-w-sm max-h-sm bg-white border border-slate-400 rounded-lg shadow dark:bg-gray-800 content-center p-5 border-dashed">
                <button class="p-5 dark:text-white text-black rounded-md" onclick="handleAdd()">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
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
        })

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
