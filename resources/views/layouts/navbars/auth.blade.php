<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('page.index', 'home') }}" class="simple-text">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-sidebar.png">
            </div>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if(Auth::user()->jabatan == "Administrator") 
                <li class="{{ $elementActive == 'home' ? 'active' : '' }}">
                    <a href="{{ route('page.index', 'home') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>{{ __('Beranda') }}</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'rjg' || $elementActive == 'ras' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#dataRekapan">
                        <i class="nc-icon nc-box"></i>
                        <p>
                            {{ __('Data Rekapan') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="dataRekapan">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'ras' ? 'active' : '' }}">
                                <a href="{{ route('view.ras') }}">
                                    <span class="sidebar-mini-icon">{{ __('RAS') }}</span>
                                    <span class="sidebar-normal">{{ __(' Rekapan Absensi Siswa ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'rjg' ? 'active' : '' }}">
                                <a href="{{ route('view.rba') }}">
                                    <span class="sidebar-mini-icon">{{ __('RJG') }}</span>
                                    <span class="sidebar-normal">{{ __(' Rekapan Jurnal Guru ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'ldg' || $elementActive == 'idg' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#dataGuru">
                        <i class="nc-icon nc-hat-3"></i>
                        <p>
                            {{ __('Data Guru') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="dataGuru">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'idg' ? 'active' : '' }}">
                                <a href="{{ route('create.guru') }}">
                                    <span class="sidebar-mini-icon">{{ __('IDG') }}</span>
                                    <span class="sidebar-normal">{{ __(' Input Data Guru ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'ldg' ? 'active' : '' }}">
                                <a href="{{ route('view.guru') }}">
                                    <span class="sidebar-mini-icon">{{ __('LDG') }}</span>
                                    <span class="sidebar-normal">{{ __(' Lihat Data Guru ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'lds' || $elementActive == 'ids' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#dataSiswa">
                        <i class="nc-icon nc-ruler-pencil"></i>
                        <p>
                            {{ __('Data Siswa') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="dataSiswa">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'ids' ? 'active' : '' }}">
                                <a href="{{ route('create.siswa') }}">
                                    <span class="sidebar-mini-icon">{{ __('IDS') }}</span>
                                    <span class="sidebar-normal">{{ __(' Input Data Siswa ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'lds' ? 'active' : '' }}">
                                <a href="{{ route('view.siswa') }}">
                                    <span class="sidebar-mini-icon">{{ __('LDS') }}</span>
                                    <span class="sidebar-normal">{{ __(' Lihat Data Siswa ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'ldk' || $elementActive == 'idk' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#dataKelas">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>
                            {{ __('Data Kelas') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="dataKelas">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'idk' ? 'active' : '' }}">
                                <a href="{{ route('create.kelas') }}">
                                    <span class="sidebar-mini-icon">{{ __('IDK') }}</span>
                                    <span class="sidebar-normal">{{ __(' Input Data Kelas ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'ldk' ? 'active' : '' }}">
                                <a href="{{ route('view.kelas') }}">
                                    <span class="sidebar-mini-icon">{{ __('LDK') }}</span>
                                    <span class="sidebar-normal">{{ __(' Lihat Data Kelas ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'ldm' || $elementActive == 'idm' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#dataMapel">
                        <i class="nc-icon nc-atom"></i>
                        <p>
                            {{ __('Data Mapel') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="dataMapel">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'idm' ? 'active' : '' }}">
                                <a href="{{ route('create.mapel') }}">
                                    <span class="sidebar-mini-icon">{{ __('IDM') }}</span>
                                    <span class="sidebar-normal">{{ __(' Input Data Mapel ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'ldm' ? 'active' : '' }}">
                                <a href="{{ route('view.mapel') }}">
                                    <span class="sidebar-mini-icon">{{ __('LDM') }}</span>
                                    <span class="sidebar-normal">{{ __(' Lihat Data Mapel ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'ldu' || $elementActive == 'idu' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#dataUser">
                        <i class="nc-icon nc-single-02"></i>
                        <p>
                            {{ __('Data User') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="dataUser">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'ldu' ? 'active' : '' }}">
                                <a href="{{ route('view.user') }}">
                                    <span class="sidebar-mini-icon">{{ __('LDU') }}</span>
                                    <span class="sidebar-normal">{{ __(' Lihat Data User ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @elseif(Auth::user()->jabatan == "Guru")
                <li class="{{ $elementActive == 'home' ? 'active' : '' }}">
                    <a href="{{ route('page.index', 'home') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>{{ __('Beranda') }}</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'ias' || $elementActive == 'las' || $elementActive == 'cas' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#dataAbsensiSiswa">
                        <i class="nc-icon nc-atom"></i>
                        <p>
                            {{ __('Absensi Siswa') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="dataAbsensiSiswa">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'ias' ? 'active' : '' }}">
                                <a href="{{ route('kelas.absensi') }}">
                                    <span class="sidebar-mini-icon">{{ __('IAS') }}</span>
                                    <span class="sidebar-normal">{{ __(' Input Absensi Siswa ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'las' ? 'active' : '' }}">
                                <a href="{{ route('view.absensi') }}">
                                    <span class="sidebar-mini-icon">{{ __('LAS') }}</span>
                                    <span class="sidebar-normal">{{ __(' Lihat Absensi Siswa ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'cas' ? 'active' : '' }}">
                                <a href="{{ route('viewprint.absensi') }}">
                                    <span class="sidebar-mini-icon">{{ __('CAS') }}</span>
                                    <span class="sidebar-normal">{{ __(' Cetak Absensi Siswa ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'ijg' || $elementActive == 'ljg' || $elementActive == 'cjg' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#dataJurnalGuru">
                        <i class="nc-icon nc-atom"></i>
                        <p>
                            {{ __('Jurnal Guru') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="dataJurnalGuru">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'ijg' ? 'active' : '' }}">
                                <a href="{{ route('kelas.jurnalguru') }}">
                                    <span class="sidebar-mini-icon">{{ __('IJG') }}</span>
                                    <span class="sidebar-normal">{{ __(' Input Jurnal Guru ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'ljg' ? 'active' : '' }}">
                                <a href="{{ route('view.jurnalguru') }}">
                                    <span class="sidebar-mini-icon">{{ __('LJG') }}</span>
                                    <span class="sidebar-normal">{{ __(' Lihat Jurnal Guru ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'cjg' ? 'active' : '' }}">
                                <a href="{{ route('viewprint.jurnalguru') }}">
                                    <span class="sidebar-mini-icon">{{ __('CJG') }}</span>
                                    <span class="sidebar-normal">{{ __(' Cetak Jurnal Guru ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>