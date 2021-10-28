@extends('layouts.app', [
    'class' => '',
    'title' => 'Edit Jurnal Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Edit Jurnal Guru',
    'elementActive' => 'ljg'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @foreach($edit as $jurnalguru)
                    <form action="{{ route('update.jurnalguru') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('post')
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
                                            <input type="text" value="{{ Auth::user()->nama }}" id="guru_pengampu" name="guru_pengampu" placeholder="Guru Pengampu" class="input-sm form-control-sm form-control" readonly required>
                                            <input type="text" value="{{ $jurnalguru->Id_Jurnal_Guru }}" id="id_jurnal_guru" name="id_jurnal_guru" class="input-sm form-control-sm form-control" hidden required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2">
                                            <label for="hari" class="form-control-label">Hari</label>
                                            <select name="hari" id="hari" class="form-control" required>
                                                <optgroup label="Value :">
                                                    <option value="{{ $jurnalguru->Hari }}" selected>{{ $jurnalguru->Hari }}</option>
                                                </optgroup>    
                                                <optgroup label="Pilih Hari:">
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jum'at">Jum'at</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="tanggal" class="form-control-label">Tanggal</label>
                                            <input type="date" value="{{ $jurnalguru->Tanggal }}" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" class="input-sm form-control-sm form-control" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2">
                                            <label for="sesi" class=" form-control-label">Sesi</label>
                                            <select name="sesi" id="sesi" class="form-control" required>
                                                <optgroup label="Value :">
                                                    <option value="{{ $jurnalguru->Sesi }}" selected>{{ $jurnalguru->Sesi }}</option>
                                                </optgroup>
                                                <optgroup label="Pilih Sesi:">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6">
                                            <label for="materi_mapel" class="form-control-label">Materi Mata Pelajaran</label>
                                            <textarea value="{{ $jurnalguru->Materi_Mapel }}" name="materi_mapel" id="materi_mapel" rows="9" placeholder="Isi Materi..." class="form-control" required>{{ $jurnalguru->Materi_Mapel }}</textarea>
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