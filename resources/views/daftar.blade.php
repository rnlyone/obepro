@include('app.app-guest', ['daftar_active' => 'active'])

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <div class="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Sebagai Pemain</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('pemain.store')}}" method="POST" class="form form-horizontal">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="first-name">Nama Lengkap</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="first-name" class="form-control" name="nama"
                                                        placeholder="Nama Lengkap">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="tempatlahir-id">Tempat
                                                        Lahir</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" id="tempatlahir" class="form-control"
                                                        name="tempatlahir" placeholder="Cth. Makassar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="borndate-info">Tanggal
                                                        Lahir</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="date" id="borndate" class="form-control"
                                                        name="borndate" placeholder="Mobile">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="alamat">Alamat</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="alamat" id="alamat" class="form-control" name="alamat"
                                                        placeholder="Alamat">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="No Telepon">No Telepon</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="number" id="nohp" class="form-control" name="nohp"
                                                        placeholder="No Telepon">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="email">Email</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit"
                                                class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                                            <button type="reset"
                                                class="btn btn-outline-secondary waves-effect">Reset</button>
                                        </div>
                                    </div>
                                </form>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div style="margin: 10pt">
                                <div class="card-datatable table-responsive pt-0">
                                    <div class="card-header p-0">
                                        <div class="head-label">
                                            <h5 class="mt-1">Pemain yang telah terdaftar</h5>
                                        </div>
                                    </div>
                                    <table class="user-list-table table" id="altertable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($alternatif as $a => $alt)
                                            <tr>
                                                <td>{{$a+1}}</td>
                                                <td>{{$alt->nama}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal to add new user starts-->

                            </div>
                            <!-- Modal to add new user Ends-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('app.footer');
