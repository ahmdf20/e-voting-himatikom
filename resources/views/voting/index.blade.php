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
            <div
                class="grid max-w-sm max-h-sm bg-white border border-slate-400 rounded-lg shadow dark:bg-gray-800 content-center p-5 border-dashed">
                <a href="{{ route('candidates.add') }}" class="p-5 text-white rounded-md">
                    <i class="fa-solid fa-plus"></i>
                </a>
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
