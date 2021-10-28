@extends('layouts.app', [
    'class' => '',
    'title' => 'Input Jurnal Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Input Jurnal Guru',
    'elementActive' => 'ijg'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Pilih Kelas Siswa') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php use Illuminate\Support\Facades\DB; ?>
                            @foreach($kelas as $mapel)
                                <?php 
                                    $kelas = DB::table('kelas')
                                            ->where('Tingkat_Kelas', '=', substr($mapel->Kelas_Mapel, 0, -6))
                                            ->where('Jurusan', '=', substr($mapel->Kelas_Mapel, -5, 3))
                                            ->where('Nomor_Kelas', '=', substr($mapel->Kelas_Mapel, -1))
                                            ->first();
                                ?>
                                <div class="col-3 text-center">
                                    <a href="{{ route('create.jurnalguru', ['id' => $kelas->Id_Kelas]) }}">
                                        <input style="width:100px" type="image" src="{{ asset('paper') }}/images/kelas/{{ $mapel->Kelas_Mapel }}.jpg" alt="{{ $mapel->Kelas_Mapel }}">
                                    </a>
                                    <hr>
                                    <p>{{ $mapel->Nama_Mapel }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);
    </script>
@endpush