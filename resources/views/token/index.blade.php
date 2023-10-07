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

        <button class="p-3 bg-green-400 hover:bg-green-500 rounded-md mb-4 shadow-xl" onclick="generateToken()">Tambah
            Token</button>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Token
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Terpakai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tokens as $key => $token)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $token->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $token->token }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $token->is_used == 0 ? 'Tidak' : 'Ya' }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $tokens->links() }}


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
