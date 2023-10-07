<x-app-layout>
    <x-slot name="title">
        {{ __('E-Vote HIMATIKOM') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
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
                    <a href="{{ route('dashboard.vote.show', ['votes' => $vote->id]) }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Detail
                        <i class="fa-solid fa-arrow-right pl-2"></i>
                    </a>
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
        })
    </script>
</x-app-layout>
