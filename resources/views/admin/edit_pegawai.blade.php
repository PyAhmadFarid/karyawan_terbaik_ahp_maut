@extends('template.admin')

@section('content')
    <div class="flex justify-between">
        <div class=" font-bold text-2xl py-5">Pegawai</div>
        {{-- <button class="">Add jobs</button> --}}
    </div>


    <div class=" bg-white border rounded-lg ">
        {{-- <div class="p-5 font-semibold border-b">Data Pegawai :</div> --}}
        <form class="" method="POST">
            @csrf
            <div class="p-5 flex flex-col space-y-5">
                <div class="flex flex-col space-y-3">
                    <span class="font-semibold">Nama Pegawai :</span>
                    <input type="text" name="nama" class="p-3 border rounded" value="{{$pegawai->nama}}">
                </div>
                <div class="flex flex-col space-y-3">
                    <span class="font-semibold">Jenis Kelamin :</span>
                    <select class="p-3 border rounded" name='jk'>
                        <option value="L" {{$pegawai->jk == 'L'?'selected':''}}>Laki-Laki</option>
                        <option value="P"{{$pegawai->jk == 'P'?'selected':''}}>Perempuan</option>
                    </select>
                </div>
                <div class="flex flex-col space-y-3">
                    <span class="font-semibold">Umur :</span>
                    <input type="number" name="umur" class="p-3 border rounded" value="{{$pegawai->umur}}">
                </div>
            </div>
            <div class="p-5 border-t flex justify-end space-x-3">
                <a href="{{route('pegawai')}}" class="p-3 rounded  text-red-500 ">Back</a>
                <button class="p-3 rounded font-semibold text-blue-900 bg-blue-300">Save</button>
            </div>
        </form>

    </div>
@endsection
