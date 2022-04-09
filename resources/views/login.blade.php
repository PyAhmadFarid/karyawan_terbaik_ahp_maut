@extends('template.default')
@section('content')
    <div class="flex flex-1 justify-center items-center py-20 bg-gray-100">
        <div class=" bg-white py-20 px-10 w-4/12 flex flex-col space-y-10">
            <div class="">
                <span class="text-2xl font-semibold">Login to your Account</span>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="flex flex-col pb-5 space-y-3">
                    <span class="font-semibold text-gray-500">Email</span>
                    <input name="email" type="email" class="p-3 border rounded-md">
                </div>
                <div class="flex flex-col  space-y-3 text-gray-500">
                    <span class="font-semibold">Password</span>
                    <input name="password" type="password" class="p-3 border rounded-md">
                </div>
                <div class="flex py-5 w-full justify-between">
                    <div>
                        <input type="checkbox" name="remember">
                        <span class="text-gray-400">Remember me</span>
                    </div>
                    <a href="" class="text-blue-500">forget password ?</a>
                </div>
                <button
                    class=" flex justify-center bg-green-500 w-full p-3 rounded-md text-white font-semibold">Login</button>

            </form>
        </div>
    </div>
@endsection
