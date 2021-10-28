@extends('layouts.app', [
    'class' => '',
    'title' => 'Cetak Absensi Siswa - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Cetak Absensi Siswa',
    'elementActive' => 'cas'
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
                        <form action="{{ route('filterprint.absensi') }}" method="GET">
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
                        <h4 class="card-title">{{ __('Tabel Cetak Absensi Siswa') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tabel">
                                <thead>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Mata Pelajaran</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Guru Pengampu</th>
                                    <th class="text-center">H</th>
                                    <th class="text-center">S</th>
                                    <th class="text-center">I</th>
                                    <th class="text-center">A</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                    ?>
                                    @foreach($indexprint as $rekapabsensi)
                                        <?php
                                            $absensi = DB::table('absensi')
                                                    ->where('Id_Absen', '=', $rekapabsensi->Id_Absen)
                                                    ->first();
                        
                                            $guru = DB::table('guru')
                                                    ->where('Id_Guru', '=', $absensi->Id_Guru)
                                                    ->first();
                        
                                            $mapel = DB::table('matapelajaran')
                                                    ->where('Id_Mapel', '=', $rekapabsensi->Id_Mapel)
                                                    ->where('Guru_Pengampu', '=', $guru->Nama_Lengkap)
                                                    ->first();

                                            $hadir = (sizeof(unserialize($rekapabsensi->Hadir)))-(array_count_values(unserialize($rekapabsensi->Hadir))['0']);
                                            $sakit = (sizeof(unserialize($rekapabsensi->Sakit)))-(array_count_values(unserialize($rekapabsensi->Sakit))['0']);
                                            $izin = (sizeof(unserialize($rekapabsensi->Izin)))-(array_count_values(unserialize($rekapabsensi->Izin))['0']);
                                            $alpa = (sizeof(unserialize($rekapabsensi->Alpa)))-(array_count_values(unserialize($rekapabsensi->Alpa))['0']);
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <td class="text-center">{{ $mapel->Kelas_Mapel }}</td>
                                            <td class="text-center">{{ $mapel->Nama_Mapel }}</td>
                                            <td class="text-center"><?php echo(date('d-m-Y', strtotime($rekapabsensi->Tanggal))) ?></td>
                                            <td class="text-center">{{ $mapel->Guru_Pengampu }}</td>
                                            <td class="text-center">{{ $hadir }}</td>
                                            <td class="text-center">{{ $sakit }}</td>
                                            <td class="text-center">{{ $izin }}</td>
                                            <td class="text-center">{{ $alpa }}</td>
                                        </tr>
                                        <?php $no=$no+1 ?>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $indexprint->links() }}
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