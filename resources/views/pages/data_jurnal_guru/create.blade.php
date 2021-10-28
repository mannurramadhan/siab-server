@extends('layouts.app', [
    'class' => '',
    'title' => 'Input Jurnal Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Input Jurnal Guru',
    'elementActive' => ''
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('store.jurnalguru') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="hari" class=" form-control-label">Hari</label>
                                    <select name="hari" id="hari" class="form-control" required>
                                        <option value="">Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jum'at">Jum'at</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="tanggal" class=" form-control-label">Tanggal</label>
                                    <input type="hidden" value="{{ $kelas->Id_Kelas }}" name="id_kelas" id="id_kelas">
                                    <input type="hidden" value="{{ $mapel->Id_Mapel }}" name="id_mapel" id="id_mapel">
                                    <input type="date" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="sesi" class=" form-control-label">Sesi</label>
                                    <select name="sesi" id="sesi" class="form-control" required>
                                        <option value="">Pilih Sesi</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-6">
                                    <label for="materi_mapel" class=" form-control-label">Materi Mata Pelajaran</label>
                                    <textarea name="materi_mapel" id="materi_mapel" rows="9" placeholder="Isi Materi..." class="form-control" required></textarea>
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