@include('app.app', ['dash_active' => 'active', 'title' => 'Dashboard'])

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">

            <!-- Greetings Card starts -->
            <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-congratulations">
                    <div class="card-body text-center">
                        <img src="/app-assets/images/elements/decore-left.png" class="congratulations-img-left"
                            alt="card-img-left" />
                        <img src="/app-assets/images/elements/decore-right.png"
                            class="congratulations-img-right" alt="card-img-right" />
                        <div class="avatar avatar-xl bg-primary shadow">
                            <div class="avatar-content">
                                <i data-feather="award" class="font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-1 text-white">Selamat Datang {{auth()->user()->name}},</h1>
                            <p class="card-text m-auto w-75">
                                Selamat datang di Aplikasi OBEPRO, Sistem Pendukung Keputusan Penentuan Rekomendasi Pola Makan Bagi Masyarakat yang Mengalami Obesitas
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @if (auth()->user()->role == 'admin')
            <div class="col-xl-7 col-md-12 col-12">
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
                            <p class="card-text font-small-3 mb-0">Pasien</p>
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
            </div>
            @endif
            <!-- Greetings Card ends -->
            <div class="col-lg-7 col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Kalkulator IMT</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate="">
                            <div class="row g-1">
                                <div class="col-md-6 col-12 mb-3 position-relative">
                                    <label class="form-label" for="weight">Berat (kg)</label>
                                    <input type="number" class="form-control" id="weight" placeholder="Enter your weight" required="">
                                    <div class="invalid-tooltip">Tolong berikan berat yang valid.</div>
                                </div>
                                <div class="col-md-6 col-12 mb-3 position-relative">
                                    <label class="form-label" for="height">Tinggi (cm)</label>
                                    <input type="number" step="0.01" class="form-control" id="height" placeholder="Enter your height" required="">
                                    <div class="invalid-tooltip">Tolong berikan tinggi yang valid.</div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-float waves-light" type="button" onclick="calculateBMI()">Kalkulasi</button>
                        </form>
                        <div class="mt-3">
                            <h5>Your BMI is: <span id="bmiResult"></span></h5>
                            <h5>Status: <span id="bmiStatus"></span></h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row match-height">
                    <!-- Statistics Card -->

                    <!--/ Statistics Card -->
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

<script>
    function calculateBMI() {
        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value);
        const bmiResult = document.getElementById('bmiResult');
        const bmiStatus = document.getElementById('bmiStatus');

        if (isNaN(weight) || isNaN(height) || height <= 0) {
            alert('Tolong Berikan Angka yang valid.');
            return;
        }

        const bmi = (weight / (height * height)) * 10000;
        bmiResult.innerText = bmi.toFixed(2);

        if (bmi < 18.5) {
            bmiStatus.innerText = 'Kekurangan berat badan';
        } else if (bmi >= 18.5 && bmi <= 24.9) {
            bmiStatus.innerText = 'Normal (ideal)';
        } else if (bmi >= 25.0 && bmi <= 29.9) {
            bmiStatus.innerText = 'Kelebihan berat badan';
        } else if (bmi >= 30.0) {
            bmiStatus.innerText = 'Kegemukan (Obesitas)';
        }
    }
</script>
