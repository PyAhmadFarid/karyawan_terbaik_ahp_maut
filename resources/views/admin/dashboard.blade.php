@extends('template.admin')

@section('content')
    <div class="flex justify-between">
        <div class=" font-bold text-2xl py-5">Dashboard</div>
        {{-- <button class="">Add jobs</button> --}}
    </div>
    <div class="  flex  space-x-10">
        <div class=" bg-white border rounded-lg w-full">
            @isset($peringkat)
            <div class="p-5 border-b font-semibold">Daftar Peringkat</div>
            <div class="p-5">
                <table>
                    <thead>
                        <tr>
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Peringkat</th>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $t = 0;
                        
                        @endphp
                        @foreach ($peringkat as $i=> $per)
                        <tr>
                            @php
                            $pgw = $pegawai->find($i);
                            $t++;
                            @endphp
                            <td class="p-3">A{{$i}}</td>
                            <td class="p-3">{{$t}}</td>
                            <td class="p-3">{{$pgw->nama}}</td>
                            <td class="p-3">{{$per}}</td>

                        </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="bg-white border rounded-lg p-5 flex flex-col">
                <span>Bobot belum di tentukan silahkan mengenerate bobot di halaman bobot terlebih dahulu</span>
                <a href="{{route('bobot')}}" class="text-blue-500">Halaman bobot ></a>
            </div>
            @endisset

        </div>
    </div>
@endsection
