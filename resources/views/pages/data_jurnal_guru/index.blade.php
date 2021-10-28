@extends('layouts.app', [
    'class' => '',
    'title' => 'Lihat Jurnal Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Lihat Jurnal Guru',
    'elementActive' => 'ljg'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tabel Jurnal Guru') }}</h4>
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
                                    <th class="text-center">Id</th>
                                    <th class="text-center">hari</th>
                                    <th class="text-center">tanggal</th>
                                    <th class="text-center">sesi</th>
                                    <th class="text-center">guru pengampu</th>
                                    <th class="text-center">mapel</th>
                                    <th class="text-center">aksi</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        use Illuminate\Support\Facades\DB;
                                        $no = 1;
                                    ?>
                                    @foreach($index as $jurnalguru)
                                        <?php
                                            $guru = DB::table('guru')
                                                    ->where('Id_Guru', '=', $jurnalguru->Id_Guru)
                                                    ->first();
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <td class="text-center">{{ $jurnalguru->Hari }}</td>
                                            <td class="text-center">{{ $jurnalguru->Tanggal }}</td>
                                            <td class="text-center">{{ $jurnalguru->Sesi }}</td>
                                            <td class="text-center">{{ $guru->Nama_Lengkap }}</td>
                                            <td>{{ $jurnalguru->Materi_Mapel }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-secondary btn-link btn-sm" href="{{ route('show.jurnalguru', ['id' => $jurnalguru->Id_Jurnal_Guru]) }}" role="button">
                                                    <i class="fa fa-external-link"></i>&nbsp; Lihat</a>
                                                <a class="btn btn-primary btn-link btn-sm" href="{{ route('edit.jurnalguru', ['id' => $jurnalguru->Id_Jurnal_Guru]) }}" role="button">
                                                    <i class="fa fa-edit"></i>&nbsp; Ubah</a>
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