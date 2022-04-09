<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/alpinejs.min.js') }}"></script>
    {{-- <script src="{{ asset('js/chart.min.js') }}"></script> --}}

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> --}}
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> --}}

</head>
@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<body class="antialiased">
    <div x-data="{'active':{{ session('message') ? 'true' : 'false' }}}" x-show='active'
        class="fixed w-screen h-screen z-10 bg-black bg-opacity-20">
        <div class="flex w-full h-full justify-center items-center">
            <div class="bg-white  rounded-md flex flex-col">
                <span class="font-semibold text-xl p-5">
                    {{ session('message') ?? 'no message' }}
                </span>
                <div class="p-5 border-t flex justify-end">
                    <button x-on:click='active=false'
                        class="font-semibold bg-blue-500 text-white p-3 rounded">OK</button>
                </div>
            </div>
        </div>
    </div>


    <div class="  w-screen h-screen flex">
        <div class=" bg-white w-48 border-r">
            <div class="w-full">
                {{-- <img src="{{ asset('images/logo.jpg') }}" alt="logo"> --}}
                {{-- <div class=" bg-white font-bold text-blue-500 text-3xl flex justify-center py-5 px-5">PT FOKUS JASA MITRA</div> --}}
            </div>
            <div class=" bg-white flex flex-col justify-center h-full">

                <div
                    class="{{ Request::is('dashboard') ? 'border-r-4' : '' }} py-2 px-4  my-2 w-full flex items-center space-x-5 border-blue-500  hover:bg-gray-100 transition-all  font-semibold">

                    <svg xmlns="http://www.w3.org/2000/svg" width="30" data-name="Layer 1" viewBox="0 0 24 24">
                        <path fill="#6b7280"
                            d="M19.088,4.95453c-.00732-.00781-.00952-.01819-.01715-.02582s-.01819-.00995-.02606-.01733a9.97886,9.97886,0,0,0-14.08948,0c-.00787.00738-.01837.00964-.02606.01733s-.00983.018-.01715.02582a10,10,0,1,0,14.1759,0ZM12,20a7.9847,7.9847,0,0,1-6.235-3H9.78027a2.9636,2.9636,0,0,0,4.43946,0h4.01532A7.9847,7.9847,0,0,1,12,20Zm-1-5a1,1,0,1,1,1,1A1.001,1.001,0,0,1,11,15Zm8.41022.00208L19.3999,15H15a2.99507,2.99507,0,0,0-2-2.81573V9a1,1,0,0,0-2,0v3.18427A2.99507,2.99507,0,0,0,9,15H4.6001l-.01032.00208A7.93083,7.93083,0,0,1,4.06946,13H5a1,1,0,0,0,0-2H4.06946A7.95128,7.95128,0,0,1,5.68854,7.10211l.65472.65473A.99989.99989,0,1,0,7.75732,6.34277l-.65466-.65466A7.95231,7.95231,0,0,1,11,4.06946V5a1,1,0,0,0,2,0V4.06946a7.95231,7.95231,0,0,1,3.89734,1.61865l-.65466.65466a.99989.99989,0,1,0,1.41406,1.41407l.65472-.65473A7.95128,7.95128,0,0,1,19.93054,11H19a1,1,0,0,0,0,2h.93054A7.93083,7.93083,0,0,1,19.41022,15.00208Z" />
                    </svg>
                    <a href="{{ route('dashboard') }}" class=" w-full  text-gray-600">Dashboard</a>
                </div>

                <div
                    class="{{ Request::is('bobot') ? 'border-r-4' : '' }} py-2 px-4  my-2 w-full flex items-center space-x-5 border-blue-500  hover:bg-gray-100 transition-all  font-semibold">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30">
                        <path  fill="#6b7280"
                            d="M17.48,6.55v0h0L14.64,3.71a1,1,0,0,0-1.42,0,1,1,0,0,0,0,1.41l2.12,2.12-8.1,8.1L5.12,13.22a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42l2.81,2.81v0h0l2.81,2.81a1,1,0,0,0,.71.3,1,1,0,0,0,.71-1.71L8.66,16.76l8.1-8.1,2.12,2.12a1,1,0,1,0,1.41-1.42ZM3.71,17.46a1,1,0,0,0-1.42,1.42l2.83,2.83a1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.42Zm18-12.34L18.88,2.29a1,1,0,0,0-1.42,1.42l2.83,2.83a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,5.12Z" />
                    </svg>
                    <a href="{{ route('bobot') }}" class=" w-full  text-gray-600">Bobot</a>
                </div>

                <div
                    class="{{ Request::is('pegawai') ? 'border-r-4' : '' }} py-2 px-4  my-2 w-full flex items-center space-x-5 border-blue-500  hover:bg-gray-100 transition-all  font-semibold">

                    <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 24 24">
                        <path fill="#6b7280"
                            d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z" />
                    </svg>
                    <a href="{{ route('pegawai') }}" class=" w-full  text-gray-600">Pegawai</a>
                </div>

                <div
                    class="{{ Request::is('nilai') ? 'border-r-4' : '' }} py-2 px-4  my-2 w-full flex items-center space-x-5 border-blue-500  hover:bg-gray-100 transition-all  font-semibold">

                    <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 24 24">
                        <path fill="#6b7280"
                            d="M7,16a1.5,1.5,0,0,0,1.5-1.5.77.77,0,0,0,0-.15l2.79-2.79.23,0,.23,0,1.61,1.61s0,.05,0,.08a1.5,1.5,0,1,0,3,0v-.08L20,9.5h0A1.5,1.5,0,1,0,18.5,8a.77.77,0,0,0,0,.15l-3.61,3.61h-.16L13,10a1.49,1.49,0,0,0-3,0L7,13H7a1.5,1.5,0,0,0,0,3Zm13.5,4H3.5V3a1,1,0,0,0-2,0V21a1,1,0,0,0,1,1h18a1,1,0,0,0,0-2Z" />
                    </svg>
                    <a href="{{ route('nilai') }}" class=" w-full  text-gray-600">Pelinaian</a>
                </div>



            </div>
        </div>
        <div class="flex-1 bg-gray-50  flex-col flex">
            <div class="bg-white flex justify-between items-center py-3 px-10">
                {{-- <button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 24 24">
                        <path fill="#00000"
                            d="M3,8H21a1,1,0,0,0,0-2H3A1,1,0,0,0,3,8Zm18,8H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Zm0-5H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z" />
                    </svg>
                </button> --}}
                <a href="{{ route('home') }}" class="font-bold text-green-500 text-xl">PT. Subur jaya </a>
                <div class="flex items-center space-x-5 " x-data="{'isModalOpen': false}">
                    <div class=" font-bold text-xl">Welcome, {{ auth()->user()->name }}!</div>
                    <img x-on:click="isModalOpen = !isModalOpen"
                        class="inline object-cover w-16 h-16 rounded-full cursor-pointer"
                        src="{{ url('/images/default_profil.jpg') }}" alt="Image" />
                    <div class=" fixed p-3 bg-white border rounded-md mt-48 w-52" x-show="isModalOpen" x-transition
                        @click.away="isModalOpen = false">
                        <a href="" class=" bg-gray-200 p-3 w-full mb-4 rounded-md block text-center">Setting</a>
                        <a href="{{ route('logout') }}"
                            class=" bg-red-500 p-3 text-white w-full rounded-md block text-center">Logout</a>
                    </div>
                </div>
            </div>
            <div class="flex-1 overflow-auto px-10 py-5 ">
                @yield('content')
            </div>
        </div>

    </div>
</body>


@yield('script')


</html>
