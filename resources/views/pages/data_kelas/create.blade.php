@extends('layouts.app', [
    'class' => '',
    'title' => 'Input Data Kelas - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Input Data Kelas',
    'elementActive' => 'idk'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('store.kelas') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('post')
                    <div class="card" style="width: 29rem;">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Pilih Kelas :') }}</h4>
                            <div class="form-group">
                                <label for="tingkat_kelas" class=" form-control-label">Tingkat Kelas</label>
                                <select name="tingkat_kelas" id="tingkat_kelas" class="form-control" required>
                                    <option value="">Pilih Tingkat Kelas</option>
                                    <option value="XII">XII</option>
                                    <option value="XI">XI</option>
                                    <option value="X">X</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jurusan" class=" form-control-label">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control" required>
                                    <option value="">Pilih Jurusan</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomor_kelas" class=" form-control-label">Nomor Kelas</label>
                                <select name="nomor_kelas" id="nomor_kelas" class="form-control" required>
                                    <option value="">Pilih Nomor Kelas</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-dot-circle-o"></i> {{ __('Simpan') }}
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Tabel Nama Siswa') }}</h4>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <select class="form-control" name="filter_kelas" id="filter_kelas" onchange="searchKelas()">
                                            <option Value="">Semua Kelas</option>
                                            <option value="Belum Ada Kelas">Belum Ada Kelas</option>
                                            <option value="IPA">IPA</option>
                                            <option value="IPS">IPS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group no-border">
                                        <input type="text" id="myInput" class="form-control" onkeyup="searchNIM()" placeholder="Search for NIM..">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="nc-icon nc-zoom-split"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <!-- USER DATA-->
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <thead>
                                            <th class="text-center">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" onchange="checkAll(this)" class="form-check-input">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">NIS</th>
                                            <th>Nama Siswa</th>
                                            <th class="text-center">Kelas</th>
                                        </thead>
                                        <tbody>
                                            @foreach($create as $kelas)
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input name="list_siswa[]" value="{{ $kelas->Id_Siswa }}" type="checkbox" class="form-check-input">
                                                                <span class="form-check-sign"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $kelas->NIS }}
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6>{{ $kelas->Nama_Siswa }}</h6>
                                                            <span>
                                                                <a href="#">{{ $kelas->NISN }}</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($kelas->Id_Kelas == 0)
                                                            <button class="btn btn-default btn-sm" disabled>
                                                                Belum Ada Kelas
                                                            </button>
                                                        @elseif($kelas->Jurusan == 'IPA')
                                                            <button class="btn btn-success btn-sm" disabled>
                                                                {{ $kelas->Tingkat_Kelas }}
                                                                {{ $kelas->Jurusan }}
                                                                {{ $kelas->Nomor_Kelas }}
                                                            </button>
                                                        @elseif($kelas->Jurusan == 'IPS')
                                                            <button class="btn btn-warning btn-sm" disabled>
                                                                {{ $kelas->Tingkat_Kelas }}
                                                                {{ $kelas->Jurusan }}
                                                                {{ $kelas->Nomor_Kelas }}
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            <!-- END USER DATA-->                         
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function checkAll(ele) {
            var checkboxes = document.getElementsByTagName('input');
            var table = document.getElementById("myTable");
            var tr = table.getElementsByTagName("tr");

            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if(checkboxes[i].type == 'checkbox'){
                        if (checkboxes[i].style.display != "none") {
                            checkboxes[i].checked = true;
                        }
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    if(checkboxes[i].type == 'checkbox'){
                        if (checkboxes[i].style.display != "none") {
                            checkboxes[i].checked = false;
                        }
                    }
                }
            }
        }

        function searchNIM() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function searchKelas() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("filter_kelas");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

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