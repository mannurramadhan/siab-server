@extends('layouts.app', [
    'class' => '',
    'title' => 'Edit Data Mata Pelajaran - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Edit Data Mata Pelajaran',
    'elementActive' => 'ldm'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('update.mapel') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                                    <input type="text" id="id_mapel" name="id_mapel" value="{{ $mapel->Id_Mapel }}" class="input-sm form-control-sm form-control" hidden>
                                    <input type="text" id="nama_mapel" name="nama_mapel" value="{{ $mapel->Nama_Mapel }}" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="kelas_mapel" class=" form-control-label">Kelas Mata Pelajaran</label>
                                    <select name="kelas_mapel" id="kelas_mapel" class="form-control" required>
                                        <optgroup label="Value :">
                                            <option value="{{ $mapel->Kelas_Mapel }}">{{ $mapel->Kelas_Mapel }}</option>
                                        </optgroup>   
                                        <optgroup label="Pilih Kelas Mapel :">
                                            @foreach($kelas as $k)
                                                <option value="{{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}">
                                                    {{ $k->Tingkat_Kelas }} {{ $k->Jurusan }} {{ $k->Nomor_Kelas }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="guru_pengampu" class=" form-control-label">Guru Pengampu</label>
                                    <select name="guru_pengampu" id="guru_pengampu" class="form-control" required>
                                        <optgroup label="Value :">
                                            <option value="{{ $mapel->Guru_Pengampu }}">{{ $mapel->Guru_Pengampu }}</option>
                                        </optgroup>
                                        <optgroup label="Pilih Guru Pengampu :">
                                            @foreach($guru as $g)
                                                <option value="{{ $g->Id_Guru }}">{{ $g->Nama_Lengkap }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="jenis_kelas" class=" form-control-label">Jenis Kelas</label>
                                    <select name="jenis_kelas" id="jenis_kelas" class="form-control" required>
                                        <optgroup label="Value :">
                                            <option value="{{ $mapel->Jenis_Kelas }}">{{ $mapel->Jenis_Kelas }}</option>
                                        </optgroup>
                                        <optgroup label="Pilih Jenis Kelas :">
                                            <option value="IPA">IPA</option>
                                            <option value="IPS">IPS</option>
                                        </optgroup>
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