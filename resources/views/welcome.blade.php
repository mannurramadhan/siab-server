@extends('layouts.app', [
    'class' => 'login-page',
    'title' => 'Sistem Informasi Absensi Siswa - SMAN 2 Kota Balikpapan',
    'titlepage' => '',
    'elementActive' => ''
])

@section('content')
    <div class="content col-md-12 ml-auto mr-auto">
        <div class="header py-2 pb-7 pt-lg-9">
            <div class="container col-md-10">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-12 pt-5">
                            <h4 class="@if(Auth::guest()) text-white @endif">{{ __('Selamat Datang, Bapak/Ibu Guru!') }}</h4>
                            <h3 class="@if(Auth::guest()) text-white @endif">{{ __('SMAN 2 Kota Balikpapan') }}</h3>
                            <!--<p class="@if(Auth::guest()) text-white @endif text-lead mt-3 mb-0">
                                {{ __('
                                    Sistem Informasi Absensi Siswa (SIAB) adalah sebuah sistem informasi yang berbasis website 
                                    untuk melakukan absensi siswa, mengisi jurnal guru, serta melakukan rekapitulasi absensi siswa dan jurnal guru
                                    di SMAN 2 Balikpapan.
                                ') }}
                            </p>-->
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
            demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
