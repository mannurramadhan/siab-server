@extends('layouts.app', [
    'class' => '',
    'title' => 'Cetak Jurnal Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Cetak Jurnal Guru',
    'elementActive' => 'cjg'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <?php use Illuminate\Support\Facades\DB;?>
                <div class="card" style="width: 29rem;">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Kategori :') }}</h4>
                        <?php
                            $idKelas=0;
                            $namaMapel=0;
                        ?>  
                        <form action="{{ route('filterprint.jurnalguru') }}" method="GET">
                            <div class="form-group">
                                <select class="form-control" id="filterKelas" name="id1" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $k)
                                        <?php $list = DB::table('kelas')->where('Id_Kelas', '=', $k->Id_Kelas)->first(); ?>
                                        <option value="{{ $list->Id_Kelas }}">{{$list->Tingkat_Kelas}} {{$list->Jurusan}} {{$list->Nomor_Kelas}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="filterMapel" name="id2" required>
                                    <option value="">Pilih Mapel</option>
                                    @foreach($mapel as $m)
                                        <?php $list = DB::table('matapelajaran')->where('Id_Mapel', '=', $m->Id_Mapel)->first(); ?>
                                        <option value="{{ $list->Nama_Mapel }}">{{ $list->Nama_Mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">
                                <i class="zmdi zmdi-filter-list"></i>filter
                            </button>
                        </form>
                        <form action="{{ route('print.jurnalguru') }}" method="GET" target="_blank">
                            <input type="text" name="id1" id="kelas" value="{{ $id1 }}" hidden>
                            <input type="text" name="id2" id="mapel" value="{{ $id2 }}" hidden>
                            <button type="submit" id="cetak" class="btn btn-info">
                                <i class="zmdi zmdi-print"></i>cetak
                            </button>
                        </form>
                    </div>
                </div>
                @if(session('success'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success" role="alert">
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    </div>
                @elseif(session('failed'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                <span>{{ session('failed') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tabel Rekapan Jurnal Guru') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tabel">
                                <thead>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Mata Pelajaran</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Sesi</th>
                                    <th class="text-center">Guru Pengampu</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                    ?>
                                    @foreach($index as $rekapjurnalguru)
                                        <?php
                                            $jurnal = DB::table('jurnalguru')
                                                    ->where('Id_Jurnal_Guru', '=', $rekapjurnalguru->Id_Jurnal_Guru)
                                                    ->first();

                                            $guru = DB::table('guru')
                                                    ->where('Id_Guru', '=', $jurnal->Id_Guru)
                                                    ->first();
                                        
                                            $mapel = DB::table('matapelajaran')
                                                    ->where('Id_Mapel', '=', $rekapjurnalguru->Id_Mapel)
                                                    ->where('Guru_Pengampu', '=', $guru->Nama_Lengkap)
                                                    ->first();
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <td class="text-center">{{ $mapel->Kelas_Mapel }}</td>
                                            <td class="text-center">{{ $mapel->Nama_Mapel }}</td>
                                            <td class="text-center">{{ $jurnal->Hari }}, <?php echo(date('d-m-Y', strtotime($rekapjurnalguru->Bulan))) ?></td>
                                            <td class="text-center">{{ $jurnal->Sesi }}</td>
                                            <td class="text-center">{{ $mapel->Guru_Pengampu }}</td>
                                        </tr>
                                        <?php $no=$no+1 ?>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $index->links() }}
                        </div>
                    </div>
                </div>
                <!-- END DATA TABLE-->
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