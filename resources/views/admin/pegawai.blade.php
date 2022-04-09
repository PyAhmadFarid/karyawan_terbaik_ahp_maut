@extends('template.admin')

@section('content')
    <div class="flex justify-between">
        <div class=" font-bold text-2xl py-5">Pegawai</div>
        {{-- <button class="">Add jobs</button> --}}
    </div>


    <div class=" bg-white border rounded-lg ">
        {{-- <div class="p-5 font-semibold border-b">Data Pegawai :</div> --}}
        <form class="p-5" method="POST">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th class=" text-left p-3">No</th>
                        <th class=" text-left p-3">Nama</th>
                        <th class=" text-left p-3">Jenis Kelamin</th>
                        <th class=" text-left p-3">Umur</th>
                        <th class=" text-left p-3">...</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="p-3">#</td>
                        <td class="p-3">
                            <input type="text" class="p-3 border rounded" placeholder="Nama Pegawai" name='nama'>
                        </td>
                        <td class="p-3">
                            <select class="p-3 border rounded" name='jk'>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </td>
                        <td class="p-3">
                            <input type="number" class="p-3 border rounded" placeholder="Umur Pegawai" name="umur">
                        </td>
                        <td class="p-3">
                            <button class="font-semibold bg-blue-300 p-3 rounded text-blue-900 w-full">Add</button>

                        </td>
                    </tr>

                    @foreach ($pegawais as $i => $pegawai)
                        <tr>
                            <td class="p-3 font-semibold">A{{ $i+1 }}</td>
                            <td class="p-3">{{ $pegawai->nama }}</td>
                            <td class="p-3">
                                {{ $pegawai->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                            </td>
                            <td class="p-3">{{$pegawai->umur}}</td>
                            <td class="p-3 flex space-x-3">
                                <a href="{{route('pegawai.edit',['pegawaiid'=>$pegawai->id])}}" class="font-semibold bg-green-300 p-3 rounded text-green-900">Edit</a>
                                <a href="{{route('pegawai.delete',['pegawaiid'=>$pegawai->id])}}" class="font-semibold bg-red-300 p-3 rounded text-red-900">Delet</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </form>
    </div>
@endsection
