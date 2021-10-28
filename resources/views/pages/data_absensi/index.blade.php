@extends('layouts.app', [
    'class' => '',
    'title' => 'Lihat Absensi Siswa - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Lihat Absensi Siswa',
    'elementActive' => 'las'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tabel Absensi Siswa') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-success" role="alert">
                                        <span>{{ session('success') }}</span>
                                    </div>
                                </div>
                            </div>
                        @elseif (session('failed'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger">
                                        <span>{{ session('failed') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Mata Pelajaran</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Sesi</th>
                                    <th class="text-center">H</th>
                                    <th class="text-center">S</th>
                                    <th class="text-center">I</th>
                                    <th class="text-center">A</th>
                                    <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    <?php
                                        use Illuminate\Support\Facades\DB;
                                        $no = 1;
                                    ?>
                                    @foreach($index as $absensi)
                                    <?php
                                        $guru = DB::table('guru')
                                            ->where('Id_Guru', '=', $absensi->Id_Guru)
                                            ->first();
                        
                                        $mapel = DB::table('matapelajaran')
                                            ->where('Id_Mapel', '=', $absensi->Id_Mapel)
                                            ->where('Guru_Pengampu', '=', $guru->Nama_Lengkap)
                                            ->first();
                                        
                                        $hadir = (sizeof(unserialize($absensi->Hadir)))-(array_count_values(unserialize($absensi->Hadir))['0']);
                                        $sakit = (sizeof(unserialize($absensi->Sakit)))-(array_count_values(unserialize($absensi->Sakit))['0']);
                                        $izin = (sizeof(unserialize($absensi->Izin)))-(array_count_values(unserialize($absensi->Izin))['0']);
                                        $alpa = (sizeof(unserialize($absensi->Alpa)))-(array_count_values(unserialize($absensi->Alpa))['0']);

                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no ?></td>
                                        <td class="text-center">{{ $mapel->Kelas_Mapel }}</td>
                                        <td class="text-center">{{ $mapel->Nama_Mapel }}</td>
                                        <td class="text-center">{{ $absensi->Tanggal }}</td>
                                        <td class="text-center">{{ $absensi->Sesi }}</td>
                                        <td class="text-center">{{ $hadir }}</td>
                                        <td class="text-center">{{ $sakit }}</td>
                                        <td class="text-center">{{ $izin }}</td>
                                        <td class="text-center">{{ $alpa }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-secondary btn-link btn-sm" href="{{ route('show.absensi', ['id'=> $absensi->Id_Absen]) }}" role="button">
                                                <i class="fa fa-external-link"></i>&nbsp; Lihat</a>
                                        </td>
                                    </tr>
                                    <?php $no=$no+1 ?>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $index->links() }}
                        </div>
                        <!-- END DATA TABLE-->
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