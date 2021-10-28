@extends('layouts.app', [
    'class' => '',
    'title' => 'Input Absensi Siswa - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Input Absensi Siswa',
    'elementActive' => 'ias'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('store.absensi') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('post')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><strong>Absensi Siswa Kelas {{ $mapel->Kelas_Mapel }}</strong></h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="guru_pengampu" class="form-control-label">Guru Pengampu</label>
                                    <input type="text" value="{{ $mapel->Guru_Pengampu }}" id="guru_pengampu" name="guru_pengampu" placeholder="Guru Pengampu" class="input-sm form-control-sm form-control" readonly required>
                                </div>
                                <div class="form-group col-md-6">
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
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="mapel" class="form-control-label">Mata Pelajaran</label>
                                    <input type="text" value="{{ $mapel->Nama_Mapel }}" id="mapel" name="mapel" placeholder="Mata Pelajaran" class="input-sm form-control-sm form-control" readonly required>
                                    <input type="hidden" name="id_mapel" id="id_mapel" value="{{ $mapel->Id_Mapel }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal" class=" form-control-label">Tanggal</label>
                                    <input type="date" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="kelas" class="form-control-label">Kelas</label>
                                    <input type="text" value="{{ $mapel->Kelas_Mapel }}" id="kelas" name="kelas" placeholder="Kelas" class="input-sm form-control-sm form-control" readonly required>
                                </div>
                                <div class="form-group col-md-6">
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
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-dot-circle-o"></i> {{ __('Simpan') }}
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Tabel Absensi Siswa Kelas') }} {{ $mapel->Kelas_Mapel }}</h4>
                        </div>
                        <div class="card-body card-block">
                            <!-- DATA TABLE-->
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
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIS</th>
                                        <th class="text-center">Nama Siswa</th>
                                        <th class="text-center">JK</th>
                                        <th class="text-center">hadir</th>
                                        <th class="text-center">sakit</th>
                                        <th class="text-center">izin</th>
                                        <th class="text-center">alpa</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1 ?>
                                        @foreach($siswa as $absensi)
                                            <tr>
                                                <td class="text-center"><?php echo $no ?></td>
                                                <td class="text-center">
                                                    {{ $absensi->NIS }}
                                                    <input type="text" value="{{ $absensi->NIS }}" name="nis[]" id="nis" hidden>
                                                    <input type="hidden" value="{{ $absensi->Id_Kelas }}" name="id_kelas" id="id_kelas">
                                                </td>
                                                <td>{{ $absensi->Nama_Siswa }}</td>
                                                <td class="text-center">{{ $absensi->Jenis_Kelamin }}</td>
                                                <?php $i=$loop->index; ?>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline">
                                                        <label for="hadir[{{$i}}]" class="form-check-label">
                                                            <input type="hidden" name="hadir[{{$i}}]" value=0>
                                                            <input type="checkbox" value="1" id="hadir[{{$i}}]" name="hadir[{{$i}}]" class="form-check-input">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline">
                                                        <label for="sakit[{{$i}}]" class="form-check-label">
                                                            <input type="hidden" name="sakit[{{$i}}]" value=0>
                                                            <input type="checkbox" value="1" id="sakit[{{$i}}]" name="sakit[{{$i}}]" class="form-check-input">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline">
                                                        <label for="izin[{{$i}}]" class="form-check-label">
                                                            <input type="hidden" name="izin[{{$i}}]" value=0>
                                                            <input type="checkbox" value="1" id="izin[{{$i}}]" name="izin[{{$i}}]" class="form-check-input">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline">
                                                        <label for="alpa[{{$i}}]" class="form-check-label ">
                                                            <input type="hidden" name="alpa[{{$i}}]" value=0>
                                                            <input type="checkbox" value="1" id="alpa[{{$i}}]" name="alpa[{{$i}}]" class="form-check-input">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no=$no+1 ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END DATA TABLE-->
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