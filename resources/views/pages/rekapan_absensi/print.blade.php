<!DOCTYPE html>
<html>
<head>
    <?php
        use Illuminate\Support\Facades\DB;
        $no = 1;
        $siswa = 0;

        $absensi = DB::table('absensi')
                ->where('Id_Kelas', '=', $id1)
                ->where('Id_Mapel', '=', $id2->Id_Mapel)
                ->get();

        $mapel = DB::table('matapelajaran')
                ->where('Id_Mapel', '=', $get->Id_Mapel)
                ->where('Id_Guru', '=', $get->Id_Guru)
                ->first();

    ?>
    <title>Absensi Siswa_{{ $mapel->Kelas_Mapel }}_{{ $mapel->Nama_Mapel }}_<?php echo date('Y-m-d h:i:s');?></title>
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
                    <h2>REKAPAN ABSENSI SISWA</h2>
                    <h6>
                        Mata Pelajaran : {{ $mapel->Nama_Mapel }} | Kelas : {{ $mapel->Kelas_Mapel }} | Bulan : <?php echo date('F Y', strtotime($get->Tanggal)) ?> | Guru Pengampu : {{ $id2->Guru_Pengampu }}
                    </h6>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
		            <thead>
			            <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">NIS</th>
                            <th class="text-center">Nama Siswa</th>
                            <th class="text-center">JK</th>
                            <th class="text-center">Hadir</th>
                            <th class="text-center">Sakit</th>
                            <th class="text-center">Izin</th>
                            <th class="text-center">Alpa</th>
    			        </tr>
	    	        </thead>
		            <tbody>
                        @foreach($index as $print)
                            <?php
                                $h = 0;
                                $s = 0;
                                $i = 0;
                                $a = 0;

                                foreach($absensi as $loop){
                                    $h = ($h)+(unserialize($loop->Hadir)[$siswa]);
                                    $s = ($s)+(unserialize($loop->Sakit)[$siswa]);
                                    $i = ($i)+(unserialize($loop->Izin)[$siswa]);
                                    $a = ($a)+(unserialize($loop->Alpa)[$siswa]);
                                }  
                            ?>
	    		            <tr>
                                <td class="text-center"><?php echo $no ?></td>
                                <td class="text-center">{{ $print->NIS }}</td>
                                <td class="text-center">{{ $print->Nama_Siswa }}</td>
                                <td class="text-center">{{ $print->Jenis_Kelamin}}</td>
                                <td class="text-center">{{ $h }}</td>
                                <td class="text-center">{{ $s }}</td>
                                <td class="text-center">{{ $i }}</td>
                                <td class="text-center">{{ $a }}</td>
                            </tr>
                            <?php $no=$no+1; $siswa=$siswa+1 ?>
                        @endforeach
    		        </tbody>
	            </table>
            </div>
        </div>
    </div>
</body>
</html>