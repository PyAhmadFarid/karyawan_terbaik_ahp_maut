@extends('template.admin')

@section('content')
    <div class="flex justify-between">
        <div class=" font-bold text-2xl py-5">Pelinaian</div>
        {{-- <button class="">Add jobs</button> --}}
    </div>

    <div class="flex">
        <div class=" bg-white border rounded-lg">
            {{-- <div class="p-5 font-semibold border-b">Data Pegawai :</div> --}}
            <form class=" " method="POST">
                @csrf
                <div class="p-5">
                    <table class=" table-fixed w-full">
                        <thead class="border-b">
                            <tr>
                                <th class=" text-left p-2 align-bottom w-20" rowspan="2">No</th>
                                <th class=" text-left p-2 align-bottom w-52" rowspan="2">Nama</th>
                                @foreach ($kriteria as $y => $kr)
                                    @if ($y + 1 != $kriteria->count())
                                        <th  class=" text-left p-2 {{ $y % 2 == 0 ? 'bg-blue-50' : '' }}" colspan="4">
                                            {{ $kr->nama }}

                                        </th>
                                    @else
                                        <th class=" w-52 text-left p-2 align-top {{ $y % 2 == 0 ? 'bg-blue-50' : '' }}"
                                            rowspan="2">
                                            {{ $kr->nama }}

                                        </th>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>

                                @foreach ($kriteria as $y => $kr)
                                    @if ($y + 1 != $kriteria->count())
                                        @for ($kk = 0; $kk < 4; $kk++)
                                            <td class="text-left p-2 {{ $y % 2 == 0 ? 'bg-blue-50' : '' }}">
                                                {{ $kk + 1 }}</td>
                                        @endfor
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $i => $pgw)
                                <tr class="border-b">
                                    <td class="p-2">{{ $i + 1 }}</td>
                                    <td class="p-2 text-sm">{{ $pgw->nama }}</td>
                                    @foreach ($kriteria as $j => $kr)
                                        @if ($j + 1 != $kriteria->count())
                                            @for ($kk = 0; $kk < 4; $kk++)
                                                <td class="p-2 {{ $j % 2 == 0 ? 'bg-blue-50' : '' }}">
                                                    <input type="radio" name="{{ $pgw->id . ':' . $kr->id }}" value="{{$kk+1}}" required {{$nil[$pgw->id][$kr->id] == $kk+1?'checked':''}}>
                                                </td>
                                            @endfor
                                        @else
                                            <td class="p-2 {{ $y % 2 == 0 ? 'bg-blue-50' : '' }}">
                                                <input value="{{$nil[$pgw->id][$kr->id]}}" type="number" class="p-3 rounded border w-full" name="{{ $pgw->id . ':' . $kr->id }}" required>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="p-5 border-t flex justify-end">
                    <button class="font-semibold p-3 rounded bg-blue-300 text-blue-900 ">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
