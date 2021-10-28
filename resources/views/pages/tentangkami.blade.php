@extends('layouts.app', [
    'class' => '',
    'title' => 'Tentang Kami - SIAB SMAN 2 Kota Balikpapan',
    'titlepage' => 'Tentang Kami',
    'elementActive' => ''
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Tentang Sekolah, <strong>SMAN 2 Kota Balikpapan!</strong></h5>
                        <p class="card-category text-justify">
                            SMA Negeri (SMAN) 2 Balikpapan, merupakan salah satu Sekolah Menengah Atas Negeri 
                            yang ada di Kota Balikpapan, Provinsi Kalimantan Timur, Indonesia. SMAN 2 Balikpapan
                            didirikan pada tanggal 22 Desember 1978 berdasarkan Surat Keputusan SK Mendikbud RI No. SK: 
                            037/0/1978. Beralamat di Jalan Soekarno-Hatta Start 4, Kel. Gunung Samarinda, Kec. Balikpapan Utara,
                            Kota Balikpapan 76125
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Tentang Aplikasi, <strong>SIAB!</strong></h5>
                        <p class="card-category text-justify">
                            Sistem Informasi Absensi Siswa (SIAB) adalah sebuah sistem informasi yang berbasis website 
                            untuk melakukan absensi siswa, mengisi jurnal guru, serta melakukan rekapitulasi absensi siswa dan jurnal guru
                            di SMAN 2 Balikpapan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Tim Kami, <strong>Kel.2 KPPL IS-ITK Student's!</strong></h5>
                        <p class="card-category text-justify">
                            Tim ini beranggotakan 5 orang mahasiswa program studi Sistem Informasi Institut Teknologi Kalimantan, di antaranya yaitu:
                            Amalia Ika Nur Fauziati Abdullah, Bestin Septia Sinambela, Eidelwiana Ramadhani, Fery Darmawan, dan Mohammad Annur Ramadhan. 
                            Tim ini dibentuk untuk menyelesaikan proyek tugas besar dari mata kuliah konstruksi pengembangan perangkat lunak.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper') }}/img/banner-siab.png" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="{{ asset('paper') }}/images/foto/ainfa.png" alt="...">
                            <hr>
                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <input type="file" class="form-control">
                                </div>
                            </form>
                            <h5 class="title">{{ __('Amalia Ika Nur Fauziati Abdullah') }}</h5>
                            <h6 class="description">
                                As <strong>{{ __('DESIGNER') }}</strong><br>
                                <br>NIM. <strong>{{ __('10171004') }}</strong>
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper') }}/img/banner-siab.png" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="{{ asset('paper') }}/images/foto/bss.jpg" alt="...">
                            <hr>
                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <input type="file" class="form-control">
                                </div>
                            </form>
                            <h5 class="title">{{ __('Bestin Septia Sinambela') }}</h5>
                            <h6 class="description">
                                As <strong>{{ __('DESIGNER') }}</strong><br>
                                <br>NIM. <strong>{{ __('10171010') }}</strong>
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper') }}/img/banner-siab.png" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="{{ asset('paper') }}/images/foto/er.jpg" alt="...">
                            <hr>
                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <input type="file" class="form-control">
                                </div>
                            </form>
                            <h5 class="title">{{ __('Eidelwiana Ramadhani') }}</h5>
                            <h6 class="description">
                                As <strong>{{ __('ANALYSER') }}</strong><br>
                                <br>NIM. <strong>{{ __('10171023') }}</strong>
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper') }}/img/banner-siab.png" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="{{ asset('paper') }}/images/foto/fd.jpg" alt="...">
                            <hr>
                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <input type="file" class="form-control">
                                </div>
                            </form>
                            <h5 class="title">{{ __('Fery Darmawan') }}</h5>
                            <h6 class="description">
                                As <strong>{{ __('PROJECT MANAGER') }}</strong><br>
                                <br>NIM. <strong>{{ __('10171028') }}</strong>
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper') }}/img/banner-siab.png" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <img class="avatar border-gray" src="{{ asset('paper') }}/images/foto/mar.jpg" alt="...">
                            <hr>
                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <input type="file" class="form-control">
                                </div>
                            </form>
                            <h5 class="title">{{ __('Mohammad Annur Ramadhan') }}</h5>
                            <h6 class="description">
                                As <strong>{{ __('PROGRAMMER') }}</strong><br>
                                <br>NIM. <strong>{{ __('10171046') }}</strong>
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection