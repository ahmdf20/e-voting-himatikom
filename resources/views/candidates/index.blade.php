<x-app-layout>
    <x-slot name="title">
        {{ __('E-Vote HIMATIKOM') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kandidat') }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="flex flex-wrap gap-4 justify-center">
            @foreach ($candidates as $key => $candidate)
                <div
                    class="max-h-sm max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="">
                        <div class="flex justify-evenly gap-3 p-3">
                            <img class="rounded-lg object-cover h-[15rem] w-[10rem] border-black border-[1px]"
                                src="{{ asset('storage/' . $candidate->foto_kahim) }}" alt="{{ $candidate->nama_kahim }}"
                                title="{{ $candidate->nama_kahim }}" />
                            <img class="rounded-lg object-cover h-[15rem] w-[10rem] border-black border-[1px]"
                                src="{{ asset('storage/' . $candidate->foto_wakahim) }}"
                                alt="{{ $candidate->nama_wakahim }}" title="{{ $candidate->nama_wakahim }}" />
                        </div>
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white mb-6">
                                {{ $candidate->nama_kahim }} & {{ $candidate->nama_wakahim }}</h5>
                        </a>
                        <div class="flex gap-3 justify-center">
                            <a href="#" onclick=""
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-blue-800">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <a href="#" onclick="openModalEdit({{ $candidate->id }})"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="#" onclick="handleDelete({{ $candidate->id }})"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div
                class="grid max-w-sm max-h-sm bg-white border border-slate-400 rounded-lg shadow dark:bg-gray-800 content-center p-5 border-dashed">
                <a href="{{ route('candidates.add') }}" class="p-5 text-black dark:text-white rounded-md">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div class="fixed inset-0 items-center justify-center z-50 hidden" id="modal-edit">
        <!-- Background overlay -->
        <div class="bg-white rounded-lg shadow-lg p-6 w-[50rem]">
            <!-- Modal content -->

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Nama Calon Ketua
                            </th>
                            <td class="px-6 py-4" id="nama_kahim">
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                NIM
                            </th>
                            <td class="px-6 py-4" id="nim_kahim">
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Nama Calon Wakil Ketua
                            </th>
                            <td class="px-6 py-4" id="nama_wakahim">
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                NIM
                            </th>
                            <td class="px-6 py-4" id="nim_wakahim">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Visi
                            </th>
                            <td class="px-6 py-4" id="visi">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Misi
                            </th>
                            <td class="px-6 py-4" id="misi">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Close button -->
            <button
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-full focus:outline-none focus:ring"
                onclick="hideModal()">
                Close
            </button>
        </div>

        <!-- Modal container -->
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

        function openModalEdit(x) {

            $.ajax({
                url: `/candidate/${x}`,
                method: "GET",
                success: function(result) {
                    $('#nama_kahim').text(`${result.nama_kahim}`)
                    $('#nim_kahim').text(`${result.nim_kahim}`)
                    $('#nama_wakahim').text(`${result.nama_wakahim}`)
                    $('#nim_wakahim').text(`${result.nim_wakahim}`)
                    $('#visi').text(`${result.visi}`)
                    $('#misi').text(`${result.misi}`)
                    console.log(result)
                },
                error: function(err) {
                    console.log(err)
                }
            })
            $('#modal-edit').removeClass('hidden')
            $('#modal-edit').addClass('flex')
        }

        function hideModal() {
            $('#modal-edit').removeClass('flex')
            $('#modal-edit').addClass('hidden')
        }



        // function handle

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
