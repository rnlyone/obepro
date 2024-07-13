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
                                        <a href="/menu/Normal.jpeg" target="_blank">
                                            <img src="/menu/Normal.jpeg" style="width: 100vh" alt="Gambar Normal">
                                        </a>
                                    </div>
                                  </div>
                                </div>
                                @foreach ($alter as $i => $a)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingMargin{{$i}}">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMargin{{$i}}" aria-expanded="false" aria-controls="accordionMargin{{$i}}">
                                        {{$a->nama}}
                                      </button>
                                    </h2>
                                    <div id="accordionMargin{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingMargin{{$i}}" data-bs-parent="#accordionMargin" style="">
                                      <div class="accordion-body">
                                        <a href="{{asset('storage/files/gambar/' . $a->gambar)}}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{asset('storage/files/gambar/' . $a->gambar)}}" style="width: 100%" alt="">
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
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



