@include('app.app', ['dash_active' => 'active', 'title' => 'Dashboard'])

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
                          <h5>Congratulations 🎉 John!</h5>
                          <p class="card-text font-small-3">You have won gold medal</p>
                          <h3 class="mb-75 mt-2 pt-50">
                            <a href="#">$48.9k</a>
                          </h3>
                          <button type="button" class="btn btn-primary waves-effect waves-float waves-light">View Sales</button>
                          <img src="../../../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic">
                        </div>
                      </div>
                    </div>
                    <!--/ Medal Card -->

                    <!-- Statistics Card -->
                    <div class="col-xl-8 col-md-6 col-12">
                      <div class="card card-statistics">
                        <div class="card-header">
                          <h4 class="card-title">Statistics</h4>
                          <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                          </div>
                        </div>
                        <div class="card-body statistics-body">
                          <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                              <div class="d-flex flex-row">
                                <div class="avatar bg-light-primary me-2">
                                  <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up avatar-icon"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                  </div>
                                </div>
                                <div class="my-auto">
                                  <h4 class="fw-bolder mb-0">230k</h4>
                                  <p class="card-text font-small-3 mb-0">Sales</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                              <div class="d-flex flex-row">
                                <div class="avatar bg-light-info me-2">
                                  <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user avatar-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                  </div>
                                </div>
                                <div class="my-auto">
                                  <h4 class="fw-bolder mb-0">8.549k</h4>
                                  <p class="card-text font-small-3 mb-0">Customers</p>
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
                                  <h4 class="fw-bolder mb-0">1.423k</h4>
                                  <p class="card-text font-small-3 mb-0">Products</p>
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
                                  <h4 class="fw-bolder mb-0">$9745</h4>
                                  <p class="card-text font-small-3 mb-0">Revenue</p>
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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                              <h4 class="card-title">Contoh Alternatif</h4>
                            </div>
                            {{-- <div class="card-body">
                              <p class="card-text">
                                Add <code>.table-bordered</code> for borders on all sides of the table and cells. For Inverse Dark Table, add
                                <code>.table-dark</code> along with <code>.table-bordered</code>.
                              </p>
                            </div> --}}
                            @php
                                $alt = ['AlfaMidi', 'AlfaMart', 'Indomaret', 'Cicle K', 'MiniMart', 'Hypermart', 'Lottemart', 'Kios/Pedagang Kaki 5', 'Percetakan', 'Sablon'];
                                $ket = ['Retail Modern', 'Pasar Tradisional'];

                            @endphp
                            <div class="table-responsive">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>No.</th>
                                    <th>Keterangan</th>
                                    <th>Alternatif</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alt as $a => $al)
                                        <tr>
                                            <td>
                                                {{$a+1}}
                                            </td>
                                            <td >@if ($a < 7) {{$ket[0]}} @else {{$ket[1]}} @endif</td>
                                            <td>{{$al}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                    </div>
                </div>

                @if (auth()->user()->role == 'admin')
                    {{-- mini button start --}}
                    {{-- <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a class="card" href="alternatif">
                                <div class="card-header">
                                    <div>
                                        <p class="card-text fw-bolder">Data Alternatif</p>
                                    </div>
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <img data-feather="database">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a class="card" href="kriteria">
                                <div class="card-header">
                                    <div>
                                        <p class="card-text fw-bolder">Data Kriteria</p>
                                    </div>
                                    <div class="avatar bg-light-info p-50 m-0">
                                        <div class="avatar-content">
                                            <img data-feather="check-square">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a class="card" href="subkriteria">
                                <div class="card-header">
                                    <div>
                                        <p class="card-text fw-bolder">Data Sub-Kriteria</p>
                                    </div>
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <img data-feather="check-circle">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a class="card" href="wp">
                                <div class="card-header">
                                    <div>
                                        <p class="card-text fw-bolder">Data Hitung WP</p>
                                    </div>
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <img data-feather="file-text">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                    {{-- mini button end --}}
                    {{-- mini button start --}}
                    {{-- <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a class="card" href="owa">
                                <div class="card-header">
                                    <div>
                                        <p class="card-text fw-bolder">Data Hitung OWA</p>
                                    </div>
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <img data-feather="folder">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a class="card" href="hasil">
                                <div class="card-header">
                                    <div>
                                        <p class="card-text fw-bolder">Data Hasil Akhir</p>
                                    </div>
                                    <div class="avatar bg-light-info p-50 m-0">
                                        <div class="avatar-content">
                                            <img data-feather="archive">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a class="card" href="user">
                                <div class="card-header">
                                    <div>
                                        <p class="card-text fw-bolder">User Management</p>
                                    </div>
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <img data-feather="user">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <a class="card" href="dash">
                                <div class="card-header">
                                    <div>
                                        <p class="card-text fw-bolder">Setting</p>
                                    </div>
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <img data-feather="settings">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                    {{-- mini button end --}}
                @endif


            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div>
<!-- END: Content-->

@include('app.footer')
