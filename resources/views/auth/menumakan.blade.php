@include('app.app', ['menu_active' => 'active', 'title' => 'Menu Makanan'])

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
                            <h2 class="content-header-title float-start mb-0">Menu Makanan</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="owa">Menu Makanan</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Analytics Start -->
            <section class="app-user-list">

                <section id="accordion-with-margin">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Menu Makanan</h4>
                          </div>
                          <div class="card-body">
                            <div class="accordion accordion-margin" id="accordionMargin" data-toggle-hover="true">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingMarginOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginOne" aria-expanded="false" aria-controls="accordionMarginOne">
                                      Menu Makanan Normal
                                    </button>
                                  </h2>
                                  <div id="accordionMarginOne" class="accordion-collapse collapse" aria-labelledby="headingMarginOne" data-bs-parent="#accordionMargin" style="">
                                    <div class="accordion-body">
                                      <img src="/menu/Normal.jpeg" style="width: 40vh" alt="">
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingMarginTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginTwo" aria-expanded="false" aria-controls="accordionMarginTwo">
                                      Menu Makanan Rendah Kolestrol
                                    </button>
                                  </h2>
                                  <div id="accordionMarginTwo" class="accordion-collapse collapse" aria-labelledby="headingMarginTwo" data-bs-parent="#accordionMargin">
                                    <div class="accordion-body">
                                      <img src="/menu/Menu Rendah Kolestrol.png" style="max-width: -webkit-fill-available" alt="">
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingMarginThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginThree" aria-expanded="false" aria-controls="accordionMarginThree">
                                      Menu Makanan Rendah Kalori
                                    </button>
                                  </h2>
                                  <div id="accordionMarginThree" class="accordion-collapse collapse" aria-labelledby="headingMarginThree" data-bs-parent="#accordionMargin">
                                    <div class="accordion-body">
                                    <img src="/menu/Menu Rendah Kalori.png" style="max-width: -webkit-fill-available" alt="">
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingMarginFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginFour" aria-expanded="false" aria-controls="accordionMarginFour">
                                      Menu Makanan Diet DM 1700 Kkal
                                    </button>
                                  </h2>
                                  <div id="accordionMarginFour" class="accordion-collapse collapse" aria-labelledby="headingMarginFour" data-bs-parent="#accordionMargin">
                                    <div class="accordion-body">
                                        <img src="/menu/Menu Diet DM 1700 Kkal.png" style="max-width: -webkit-fill-available" alt="">
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingMargin-5">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMargin-5" aria-expanded="false" aria-controls="accordionMargin-5">
                                        Menu Makanan Diet DM + Rendah Natrium
                                      </button>
                                    </h2>
                                    <div id="accordionMargin-5" class="accordion-collapse collapse" aria-labelledby="headingMargin-5" data-bs-parent="#accordionMargin">
                                      <div class="accordion-body">
                                          <img src="/menu/Menu Diet DM Rendah Natrium.png" style="max-width: -webkit-fill-available" alt="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingMargin-6">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMargin-6" aria-expanded="false" aria-controls="accordionMargin-6">
                                        Menu Makanan Diet DM + Rendah Natrium + Rendah Kolestrol
                                      </button>
                                    </h2>
                                    <div id="accordionMargin-6" class="accordion-collapse collapse" aria-labelledby="headingMargin-6" data-bs-parent="#accordionMargin">
                                      <div class="accordion-body">
                                          <img src="/menu/Menu Diet DM Rendah Natrium Rendah Kolestrol.png" style="max-width: -webkit-fill-available" alt="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingMargin-7">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMargin-7" aria-expanded="false" aria-controls="accordionMargin-7">
                                        Menu Makanan Diet DM + Rendah Kolestrol
                                      </button>
                                    </h2>
                                    <div id="accordionMargin-7" class="accordion-collapse collapse" aria-labelledby="headingMargin-7" data-bs-parent="#accordionMargin">
                                      <div class="accordion-body">
                                          <img src="/menu/Menu Diet DM Rendah Kolestrol.png" style="max-width: -webkit-fill-available" alt="">
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>

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

{{-- MODAL --}}


{{-- MODAL END --}}


<!-- END: Content-->
@include('app.footer')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $(document).ready(function(){
        const table = $('.wptable').DataTable({
            searching: false,
            paging: true,
            info: false,
        })
        });
</script>



