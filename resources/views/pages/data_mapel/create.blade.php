@extends('layouts.app', [
    'class' => '',
    'title' => 'Input Data Mata Pelajaran - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Input Data Mata Pelajaran',
    'elementActive' => 'idm'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('store.mapel') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('post')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Formulir Data Mata Pelajaran') }}</h4>
                        </div>
                        <div class="card-body card-block">
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
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="nama_mapel" class=" form-control-label">Nama Mata Pelajaran</label>
                                <input type="text" id="nama_mapel" name="nama_mapel" placeholder="Nama Mata Pelajaran" class="input-sm form-control-sm form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="kelas_mapel" class=" form-control-label">Kelas Mata Pelajaran</label>
                                <select name="kelas_mapel" id="kelas_mapel" class="form-control" required>
                                    <option value="">Pilih Kelas Mapel</option>
                                    <optgroup label="Kelas XII IPA:">
                                        @foreach($kelas as $k)
                                            @if($k->Tingkat_Kelas == "XII" AND $k->Jurusan == "IPA")
                                                <option value="{{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}">
                                                    {{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Kelas XII IPS:">
                                        @foreach($kelas as $k)
                                            @if($k->Tingkat_Kelas == "XII" AND $k->Jurusan == "IPS")
                                                <option value="{{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}">
                                                    {{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Kelas XI IPA:">
                                        @foreach($kelas as $k)
                                            @if($k->Tingkat_Kelas == "XI" AND $k->Jurusan == "IPA")
                                                <option value="{{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}">
                                                    {{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Kelas XI IPS:">
                                        @foreach($kelas as $k)
                                            @if($k->Tingkat_Kelas == "XI" AND $k->Jurusan == "IPS")
                                                <option value="{{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}">
                                                    {{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Kelas X IPA:">
                                        @foreach($kelas as $k)
                                            @if($k->Tingkat_Kelas == "X" AND $k->Jurusan == "IPA")
                                                <option value="{{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}">
                                                    {{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Kelas X IPS:">
                                        @foreach($kelas as $k)
                                            @if($k->Tingkat_Kelas == "X" AND $k->Jurusan == "IPS")
                                                <option value="{{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}">
                                                    {{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="guru_pengampu" class=" form-control-label">Guru Pengampu</label>
                                <select name="guru_pengampu" id="guru_pengampu" class="form-control" required>
                                    <option value="">Pilih Guru Pengampu</option>
                                    @foreach($guru as $g)
                                        <option value="{{ $g->Id_Guru }}">{{ $g->Nama_Lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="jenis_kelas" class=" form-control-label">Jenis Kelas</label>
                                <select name="jenis_kelas" id="jenis_kelas" class="form-control" required>
                                    <option value="">Pilih Jenis Kelas</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-dot-circle-o"></i> {{ __('Simpan') }}
                            </button>
                        </div>
                    </div>
                </form>
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