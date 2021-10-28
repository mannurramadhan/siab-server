<!DOCTYPE html>
<html>
<head>
    <?php
        use Illuminate\Support\Facades\DB;
        $no = 1;

        $jurnalguru = DB::table('jurnalguru')
                    ->rightJoin('rekapjurnalguru', 'jurnalguru.Id_Jurnal_Guru', '=', 'rekapjurnalguru.Id_Jurnal_Guru')
                    ->where('rekapjurnalguru.Id_Kelas', '=', $id1)
                    ->where('rekapjurnalguru.Id_Mapel', '=', $id2->Id_Mapel)
                    ->get();
    ?>
    <title>Jurnal Guru_{{ $id2->Kelas_Mapel }}_{{ $id2->Nama_Mapel }}_<?php echo date('Y-m-d h:i:s');?></title>
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/images/logo-siab.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('paper/css/print.css') }}">
</head>
<body>
    <div class="container">
        <div class="row kop">
            <div class="col-2">
                <center>
                    <img width="80%" src="{{ asset('paper') }}/images/logo-pemprov.png" alt="foto-pemprov">
                </center>
            </div>
            <div class="col-8">
                <center>
                    <h3 style="margin-bottom: 1px">PEMERINTAH PROVINSI KALIMANTAN TIMUR<br>
                        DINAS PENDIDIKAN DAN KEBUDAYAAN<br>
                        SMA NEGERI 2 BALIKPAPAN
                    </h3>
                    <h6>Jl. Soekarno Hatta Strat IV Gunung Samarinda Balikpapan Utara Balikpapan 76125<br>
                        Telp/Fax : (0542) 424686, Web : sman2balikpapan.sch.id<br>
                        E-Mail : school@sman2balikpapan.sch.id
                    </h6>
	            </center>
            </div>
            <div class="col-2">
                <center>
                    <img width="100%" src="{{ asset('paper') }}/images/logo-sma2-400.png" alt="foto-pemprov">
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col"><hr></div>
        </div>
        <div class="row judul">
            <div class="col">
                <center>
                    <h2>REKAPAN JURNAL GURU</h2>
                    <h6>
                        Mata Pelajaran : {{ $id2->Nama_Mapel }} | Kelas : {{ $id2->Kelas_Mapel }} | Bulan : <?php echo date('F Y', strtotime($get->Tanggal)) ?> | Guru Pengampu : {{ $id2->Guru_Pengampu }}
                    </h6>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col" style="width: 100% ">
                <table class="table table-bordered">
		            <thead>
			            <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Hari</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Sesi</th>
                            <th class="text-center">Topik/Materi</th>
    			        </tr>
	    	        </thead>
		            <tbody>
                        @foreach($jurnalguru as $print)
	    		            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <td class="text-center">{{ $print->Hari }}</td>
                                <td class="text-center">{{ $print->Tanggal }}</td>
                                <td class="text-center">{{ $print->Sesi }}</td>
                                <td class="text-center">{{ $print->Materi_Mapel }}</td>
                            </tr>
                            <?php $no=$no+1; ?>
                        @endforeach
    		        </tbody>
	            </table>
            </div>
        </div>
    </div>
</body>
</html>