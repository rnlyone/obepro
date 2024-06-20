@include('app.app', ['kriteria_active' => 'active', 'title' => 'Data Kriteria'])

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            {{-- directory content --}}
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Data Kriteria</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="Kriteria">Data Kriteria</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard Analytics Start -->
            <section class="app-user-list">
                <!-- list section start -->
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Error</h4>
                    <div class="alert-body">
                        {{$error}}
                    </div>
                  </div>
                @endforeach
                @endif
                <div class="card">
                    <div style="margin: 10pt">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="card-header p-0">
                                <div class="head-label"><h5 class="mt-1">Tabel Data Kriteria</h5></div>
                                <div class="dt-action-buttons text-end">
                                    <button data-toggle="modal" data-bs-toggle="modal" data-bs-target="#tambah-kriteria" href="javascript:void(0)" class="btn btn-success" id="tombol-tambah">
                                        <i data-feather='plus'></i>
                                    </button>
                                </div>
                            </div>
                            <table class="user-list-table table" id="kriteriatable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>tipe</th>
                                        <th>target</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- list section end -->
            </section>
            @if (session()->get('success'))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Sukses</h4>
                <div class="alert-body">
                    {{session('success')}}
                </div>
              </div>
            @elseif (session()->get('error'))
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Error</h4>
                <div class="alert-body">
                    {{session('error')}}
                </div>
              </div>
            @endif

        </div>
    </div>
</div>
<!-- END: Content-->

{{-- MODALS --}}
<!-- Modal to add new user starts-->
<div class="modal fade text-start" id="tambah-kriteria" tabindex="-1" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Tambah Kriteria</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('kriteria.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <label>Id Kriteria: </label>
                    <div class="mb-1">
                        <input type="number" name="id" class="touchspin-min-max" value="{{$latestkriteria_id+1}}"/>
                    </div>

                    <label>Nama Kriteria: </label>
                    <div class="mb-1">
                        <input type="text" name="nama" placeholder="Nama Kriteria" value="{{old('nama')}}" class="form-control" />
                    </div>

                    <label>Jenis Kriteria : </label>
                    <div class="mb-1">
                        <div class="demo-inline-spacing">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="tipe" id="inlineRadio1" value="range" checked="">
                              <label class="form-check-label" for="inlineRadio1">Jangkauan (Range)</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="tipe" id="inlineRadio2" value="kelas">
                              <label class="form-check-label" for="inlineRadio2">Kelas</label>
                            </div>
                          </div>
                    </div>

                    <label>Target Kriteria: </label>
                    <div class="mb-1">
                        <input type="number" name="target" class="touchspin-min-max" value="0"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>
 <!-- Modal to add new user Ends-->


@foreach ($kriteriadata as $krd)
<div class="modal fade text-start" id="modaledit{{$krd->id}}" tabindex="-1" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Edit Kriteria</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('kriteria.edit')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="text" value="{{$krd->id}}" name="id" hidden>
                    <label>Nama Kriteria: </label>
                    <div class="mb-1">
                        <input type="text" name="nama" placeholder="Nama Kriteria" value="{{$krd->nama}}" class="form-control" />
                    </div>

                    <label>Jenis Kriteria : </label>
                    <div class="mb-1">
                        <div class="demo-inline-spacing">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="tipe" id="inlineRadio1" value="range" checked="">
                              <label class="form-check-label" for="inlineRadio1">Range</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="tipe" id="inlineRadio2" value="kelas">
                              <label class="form-check-label" for="inlineRadio2">Kelas</label>
                            </div>
                          </div>
                    </div>

                    <label>Target Kriteria: </label>
                    <div class="mb-1">
                        <input type="number" name="target" class="touchspin-min-max" value="0"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($kriteriadata as $krd)
<div class="modal fade text-start" id="modalfaktor{{$krd->id}}" tabindex="-1" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Penentuan Faktor {{$krd->nama}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('kriteria.faktor.edit')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="text" value="{{$krd->id}}" name="id" hidden>


                    @foreach ($alternatifdata as $al)
                        <label>{{ $al->nama }} :</label>
                        <div class="mb-2">
                            <div class="demo-inline-spacing">
                                @php
                                    // Cari data Alterkrit untuk id_alternatif dan id_kriteria tertentu
                                    $alterkrit = \App\Models\Alterkrit::where('id_alternatif', $al->id)
                                                                    ->where('id_kriteria', $krd->id)
                                                                    ->first();
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="{{ $krd->id .'_'. $al->id }}" id="inlineRadio1" value="core"
                                    @if ($alterkrit && $alterkrit->faktor == 'core') checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">Core Factor</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="{{ $krd->id .'_'. $al->id }}" id="inlineRadio2" value="secondary"
                                    @if ($alterkrit && $alterkrit->faktor == 'secondary') checked @endif>
                                    <label class="form-check-label" for="inlineRadio2">Secondary Factor</label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($kriteriadata as $krd)
<div class="modal fade text-start modal-danger" id="modaldel{{$krd->id}}" tabindex="-1" aria-labelledby="myModalLabel140"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel140">Konfirmasi Hapus Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apabila Kriteria dihapus, maka semua Sub-Kriteria dan Penilaian yang berhubungan dengan Kriteria tersebut akan terhapus, Yakin tetap menghapus?
            </div>
            <div class="modal-footer">
                <a href="kriteria/destroy/{{$krd->id}}" class="btn btn-danger">Ya</a>
            </div>
        </div>
    </div>
</div>
@endforeach



@include('app.footer')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/forms/form-number-input.min.js')}}"></script>
<script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    $(document).ready(function(){
        const table = $('#kriteriatable').DataTable(
            {
                serverSide : true,
                processing : true,
                language : {
                    processing : "<div class='spinner-border text-primary' role='status'> <span class='visually-hidden'>Loading...</span></div>"
                },

                ajax : {
                    url: '{{ route('kriteria.index') }}',
                    type: 'GET'
                },

                columns : [
                    {data: 'id'},
                    {data: 'kode'},
                    {data: 'nama'},
                    {data: 'tipe'},
                    {data: 'target'},
                    {data: 'action'}
                ],

                order: [[0, 'asc']],
                "drawCallback" : function( settings ) {
                    feather.replace();
                }
            })
        });
    </script>




{{-- MODAL SPACES --}}
