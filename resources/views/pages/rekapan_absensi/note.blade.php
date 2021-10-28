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
    <title>Absensi_Siswa_{{ $mapel->Kelas_Mapel }}_{{ $mapel->Nama_Mapel }}_<?php echo date('Y-m-d h:i:s');?></title>
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/images/logo-siab.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
</head>
<body>
    <div class="container">
        <div class="row kop">
            <div class="col-2">
                <center>
                    <img width="70%" src="{{ asset('paper') }}/images/logo-pemprov.png" alt="foto-pemprov">
                </center>
            </div>
            <div class="col-10">
                <center>
                    <h4 style="margin-bottom: 1px">YAYASAN PATRA DHARMA MANDIRI (YPDM)<br>
                        SEKOLAH MENENGAH ATAS (SMA) PATRA DHARMA BALIKPAPAN
                    </h4>
                    <h6>
                        Status: "DISAMAKAN" Jenjang Akreditasi "A" (No. 024/BAP-SM/HK/XI/2017) Tanggal 24 November 2017<br>
                        NIS : 300120 | NDS: P 06024001 | NPSN: 30401496 | NSS: 302.1661.04.003<br>
                        Alamat: Jl. Warukin III Panorama Balikpapan 76123 | Telp. 0542-7516510 | Fax. 7516565<br>
                        http: www.smapatradharma-bpp.com       |         E-Mail: sma_patradharma@yahoo.com
                    </h6>
                    <hr>
	            </center>
            </div>
        </div>
        <div class="row judul">
            <div class="col">
                <center>
                    <h4>REKAPITULASI PENGGUNAAN BARANG UMUM<br>
                        TAHUN PELAJARAN 2018/2019
                    </h4>
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