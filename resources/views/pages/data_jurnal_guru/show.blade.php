@extends('layouts.app', [
    'class' => '',
    'title' => 'Lihat Jurnal Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Lihat Jurnal Guru',
    'elementActive' => ''
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @foreach($show as $jurnalguru)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Formulir Jurnal Guru') }}</h4>
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
                                    <label for="guru_pengampu" class="form-control-label">Guru Pengampu</label>
                                    <input type="text" value="{{ Auth::user()->nama_admin }}" id="guru_pengampu" name="guru_pengampu" placeholder="Guru Pengampu" class="input-sm form-control-sm form-control" readonly required>
                                    <input type="text" value="{{ $jurnalguru->Id_Jurnal_Guru }}" id="id_jurnal_guru" name="id_jurnal_guru" class="input-sm form-control-sm form-control" hidden required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="hari" class=" form-control-label">Hari</label>
                                    <select name="hari" id="hari" class="form-control" readonly required>
                                        <option value="{{ $jurnalguru->Hari }}" selected>{{ $jurnalguru->Hari }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="tanggal" class=" form-control-label">Tanggal</label>
                                    <input type="date" value="{{ $jurnalguru->Tanggal }}" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" class="input-sm form-control-sm form-control" readonly required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="sesi" class=" form-control-label">Sesi</label>
                                    <select name="sesi" id="sesi" class="form-control" readonly required>
                                        <option value="{{ $jurnalguru->Sesi }}" selected>{{ $jurnalguru->Sesi }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-6">
                                    <label for="materi_mapel" class=" form-control-label">Materi Mata Pelajaran</label>
                                    <textarea value="{{ $jurnalguru->Materi_Mapel }}" name="materi_mapel" id="materi_mapel" rows="9" placeholder="Isi Materi..." class="form-control" readonly required>{{ $jurnalguru->Materi_Mapel }}</textarea>
                                </div>
                            </div>                          
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('view.jurnalguru') }}">
                                <button class="btn btn-primary">
                                    <i class="fa fa-dot-circle-o"></i> {{ __('Kembali') }}
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
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