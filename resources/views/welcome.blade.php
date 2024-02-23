@include('app.app-guest', ['dash_active' => 'active', 'title' => 'Dashboard'])

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row match-height">
                    <!-- Medal Card -->
                    <div class="col-xl-4 col-md-6 col-12">
                      <div class="card card-congratulation-medal">
                        <div class="card-body">
                          <h5>Selamat Datang 🎉 Tamu!</h5>
                          <p class="card-text font-small-3">Sistem Optimalisasi Pemilihan Pemain Futsal</p>
                            <a href="{{route('pemain.daftar')}}" class="btn btn-primary waves-effect waves-float waves-light">Form Pemain</a>
                          <img src="../../../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic">
                        </div>
                      </div>
                    </div>
                    <!--/ Medal Card -->

                    <!-- Statistics Card -->
                    <div class="col-xl-8 col-md-6 col-12">
                      <div class="card card-statistics">
                        <div class="card-header">
                          <h4 class="card-title">Statistik</h4>
                          <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0"></p>
                          </div>
                        </div>
                        <div class="card-body statistics-body">
                          <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                              <div class="d-flex flex-row">
                                <div class="avatar bg-light-primary me-2">
                                  <div class="avatar-content">
                                    <i data-feather="users"></i>
                                  </div>
                                </div>
                                <div class="my-auto">
                                  <h4 class="fw-bolder mb-0">{{$jmlalter}}</h4>
                                  <p class="card-text font-small-3 mb-0">Pemain</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                              <div class="d-flex flex-row">
                                <div class="avatar bg-light-info me-2">
                                  <div class="avatar-content">
                                    <i data-feather="user"></i>
                                  </div>
                                </div>
                                <div class="my-auto">
                                  <h4 class="fw-bolder mb-0">{{$jmlpenilai}}</h4>
                                  <p class="card-text font-small-3 mb-0">Penilai</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                              <div class="d-flex flex-row">
                                <div class="avatar bg-light-danger me-2">
                                  <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                  </div>
                                </div>
                                <div class="my-auto">
                                  <h4 class="fw-bolder mb-0">{{$jmlkrit}}</h4>
                                  <p class="card-text font-small-3 mb-0">Kriteria</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                              <div class="d-flex flex-row">
                                <div class="avatar bg-light-success me-2">
                                  <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign avatar-icon"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                  </div>
                                </div>
                                <div class="my-auto">
                                  <h4 class="fw-bolder mb-0">{{$jmlsubkrit}}</h4>
                                  <p class="card-text font-small-3 mb-0">Sub Kriteria</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--/ Statistics Card -->
                  </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                              <h4 class="card-title">Persyaratan Pemain Inti Tim Futsal Indobarca Makassar</h4>
                            </div>
                            {{-- <div class="card-body">
                              <p class="card-text">
                                Add <code>.table-bordered</code> for borders on all sides of the table and cells. For Inverse Dark Table, add
                                <code>.table-dark</code> along with <code>.table-bordered</code>.
                              </p>
                            </div> --}}
                            <div class="table-responsive">
                              <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        @foreach ($kriteria as $krit)
                                            <th>{{$krit->nama}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($kriteria as $krit)
                                            <td>
                                                @foreach ($krit->subkriteria as $subkriteria)
                                                    {{$subkriteria->nama}}<br><br>
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>

                              </table>
                            </div>
                          </div>
                    </div>
                </div>


            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div>
<!-- END: Content-->

@include('app.footer')
