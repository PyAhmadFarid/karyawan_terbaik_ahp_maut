@extends('template.admin')

@section('content')
    <div class="flex justify-between">
        <div class=" font-bold text-2xl py-5">Bobot</div>
        {{-- <button class="">Add jobs</button> --}}
    </div>

    <div class=" bg-white border rounded-lg ">
        <div class="p-5 font-semibold border-b">Matrix perbandingan :</div>
        {{-- {{$nilai[1]->nilai}} --}}

        <form method="POST">
            @csrf
            <div class="p-5">
                <table class="w-full table-fixed">
                    <thead class="">
                        <tr>
                            <th class=" text-left p-3">#</th>
                            @foreach ($kriteria as $kri)
                                <th class=" text-left p-3">{{ $kri->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $kri)
                            <tr class="hover:bg-gray-100 transition-all">
                                <td class="p-3 font-bold ">{{ $kri->nama }}</td>
                                @foreach ($kri->Perbandigan as $per)
                                    <td class="p-3 ">
                                        @if ($per->id_kriteria_1 - $per->id_kriteria_2 < 0)
                                            <select class="p-3 border rounded w-full inp"
                                                name="{{ $per->id_kriteria_1 . ':' . $per->id_kriteria_2 }}">
                                                {{-- <option value="0">Kosong</option> --}}
                                                @for ($i = 1; $i < 10; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $per->nilai == $i ? 'selected' : '' }}>{{ $i }}
                                                    </option>
                                                @endfor
                                                {{-- <option value="4" {{ $per->nilai == 4 ? 'selected' : '' }}>4 Sangant Baik</option>
                                            <option value="3" {{ $per->nilai == 3 ? 'selected' : '' }}>3 Baik</option>
                                            <option value="2" {{ $per->nilai == 2 ? 'selected' : '' }}>2 Cupuk Baik</option>
                                            <option value="1" {{ $per->nilai == 1 ? 'selected' : '' }}>1 Kurang</option> --}}
                                            </select>
                                        @else
                                            {{-- {{$per->nilai}} --}}
                                            <input name="{{ $per->id_kriteria_1 . ':' . $per->id_kriteria_2 }}"
                                                type="number" step="any" class="p-3 border rounded w-full bg-gray-100"
                                                value="{{ $per->id_kriteria_1 == $per->id_kriteria_2 ? 1 : (string) $per->nilai }}"
                                                readonly />
                                        @endif

                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr class="hover:bg-gray-100 transition-all">
                            <td class="p-3 font-bold">Total</td>
                            @foreach ($kriteria as $kri)
                                <td class="p-3">
                                    <div class="p-3 border w-full overflow-x-hidden ttl{{ $kri->id }}">0</div>
                                </td>
                            @endforeach
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="flex p-5 border-t justify-end">
                <button class="p-3 font-semibold text-white  bg-green-500 rounded">Generate</button>
            </div>


        </form>
    </div>


@if(isset($bobot))
    <div class="flex pt-5 space-x-5 items-start">
        <div class="bg-white border rounded-lg flex-1">
            <div class="p-5 border-b font-semibold">
                Pv / Bobot :
            </div>
            <div class="p-5">
                <table>
                    <thead>
                        <tr>
                            <th class=" text-left p-3">
                                Kriteria
                            </th>
                            <th class=" text-left p-3">
                                Nilai
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($bobot as $bbt)
                            <tr>
                                <td class="p-3 font-bold">{{ $bbt->Kriteria->nama }}</td>
                                <td class="p-3 ">{{ $bbt->nilai }}</td>
                            </tr>
                            @php
                                $total += $bbt->nilai;
                            @endphp
                        @endforeach
                        <tr>
                            <td class="p-3 font-bold">Total</td>
                            <td class="{{ (string) $total == '1' ? 'bg-green-100 ' : 'bg-red-100' }} p-3 font-semibold">
                                {{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white border rounded-lg flex-1">
            <div class="p-5 border-b font-semibold">
                Rasio Konsistensi :
            </div>
            <div class="p-5">
                <table>
                    <tbody>
                        <tr>
                            <td class="p-3 font-bold">∑max </td>
                            <td class="p-3">{{ $sigmaMax }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-bold">CI </td>
                            <td class="p-3">{{ $ci }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-bold">CR </td>
                            <td class="p-3">{{ $cr }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-bold">Hasil</td>
                            @if ($konsisten)
                                <td class="p-3 font-semibold bg-green-100">Konsisten</td>
                            @else
                                <td class="p-3 font-semibold bg-red-100">Tidak Konsisten</td>
                            @endif

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection


@section('script')
    <script>
        var n = {{ $kriteria->count() }}

        function hitunttl(n) {

            for (let i = 1; i < n + 1; i++) {
                let ttl = 0;
                for (let j = 1; j < n + 1; j++) {
                    let nm = '[name="' + j + ":" + i + '"]';
                    let kk = $(nm).val();
                    ttl += parseFloat(kk);
                    // console.log(nm,kk);
                }
                console.log("berubah ", i, ttl)
                $(".ttl" + i).text(ttl);

            }

            // return ttl;
        }


        hitunttl(n);
        $(".inp").on('change', function() {
            // console.log();
            let name = $(this).attr('name').split(':');
            // console.log(name);

            let nm = name[1] + ':' + name[0];
            $('input[name="' + nm + '"]').val(1 / this.value);
            hitunttl(n);
        });
    </script>
@endsection
