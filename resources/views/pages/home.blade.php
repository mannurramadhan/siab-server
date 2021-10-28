@extends('layouts.app', [
    'class' => '',
    'title' => 'Beranda - SIAB SMAN 2 Kota Balikpapan',
    'titlepage' => 'Beranda',
    'elementActive' => 'home'
])

@section('content')
@if(Auth::user()->jabatan == "Administrator")
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Selamat Datang <strong>Administrator!</strong></h5>
                        <p class="card-category">
                            Anda berhasil masuk sebagai <strong>{{ Auth::user()->nama }}</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <?php
                    $s_laki = DB::table('siswa')
                            ->where('Jenis_Kelamin', '=', 'L')
                            ->get();
                    $s_perempuan = DB::table('siswa')
                            ->where('Jenis_Kelamin', '=', 'P')
                            ->get();
                    $g_laki = DB::table('guru')
                            ->where('Jenis_Kelamin', '=', 'L')
                            ->get();
                    $g_perempuan = DB::table('guru')
                            ->where('Jenis_Kelamin', '=', 'P')
                            ->get();
                    $ipa = DB::table('kelas')
                            ->where('Jurusan', '=', "IPA")
                            ->get();
                    $ips = DB::table('kelas')
                            ->where('Jurusan', '=', "IPS")
                            ->get();
                    $absensi = DB::table('absensi')->get();
                    $jurnalguru = DB::table('jurnalguru')->get();
                ?>
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-ruler-pencil text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Siswa</p>
                                    <p class="card-title">{{ $siswa->count() }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            Laki-laki : {{ $s_laki->count() }} Orang <br> Perempuan : {{ $s_perempuan->count() }} Orang
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-layout-11 text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Kelas</p>
                                    <p class="card-title">{{ $kelas->count() }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            IPA : {{ $ipa->count() }} Kelas <br> IPS : {{ $ips->count() }} Kelas
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-hat-3 text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Guru</p>
                                    <p class="card-title">{{ $guru->count() }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            Laki-laki : {{ $g_laki->count() }} Orang <br> Perempuan : {{ $g_perempuan->count() }} Orang 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-box text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Rekap</p>
                                    <p class="card-title">{{ $rekap }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            Absensi Siswa : {{ $absensi->count() }} Dokumen <br> Jurnal Guru : {{ $jurnalguru->count() }} Dokumen
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Users Behavior</h5>
                        <p class="card-category">24 Hours performance</p>
                    </div>
                    <div class="card-body ">
                        <canvas id=chartHours width="400" height="100"></canvas>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Email Statistics</h5>
                        <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-body ">
                        <canvas id="chartEmail"></canvas>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-primary"></i> Opened
                            <i class="fa fa-circle text-warning"></i> Read
                            <i class="fa fa-circle text-danger"></i> Deleted
                            <i class="fa fa-circle text-gray"></i> Unopened
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> Number of emails sent
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-title">NASDAQ: AAPL</h5>
                        <p class="card-category">Line Chart with Points</p>
                    </div>
                    <div class="card-body">
                        <canvas id="speedChart" width="400" height="100"></canvas>
                    </div>
                    <div class="card-footer">
                        <div class="chart-legend">
                            <i class="fa fa-circle text-info"></i> Tesla Model S
                            <i class="fa fa-circle text-warning"></i> BMW 5 Series
                        </div>
                        <hr />
                        <div class="card-stats">
                            <i class="fa fa-check"></i> Data information certified
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
@elseif(Auth::user()->jabatan == "Guru")
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Selamat Datang <strong>Bapak/Ibu Guru!</strong></h5>
                        <p class="card-category">
                            Anda berhasil masuk sebagai <strong>{{ Auth::user()->nama }}</strong>.<br>
                            Silahkan pilih fitur yang ingin digunakan!
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('kelas.absensi') }}">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="card-title"><strong>Absensi Siswa</strong></h5>
                        </div>
                        <div class="card-body">
                            <input style="width:200px" type="image" src="{{ asset('paper') }}/images/absensi-siswa.jpg" alt="absensi-siswa">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('kelas.jurnalguru') }}">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="card-title"><strong>Jurnal Guru</strong></h5>
                        </div>
                        <div class="card-body">
                            <input style="width:200px" type="image" src="{{ asset('paper') }}/images/jurnal-guru.jpg" alt="jurnal-guru">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
@endpush