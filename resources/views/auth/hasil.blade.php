@include('app.app', ['hasil_active' => 'active', 'title' => 'Hasil Akhir'])

@php
    function classify($kgd, $td, $kol){
            $kesimpulan = "";
            $kategori = 0;
            if($kgd <= 3){
                $kesimpulan .= "Menu Diabetes";
                $kategori++;
            }

            if($td <= 3){
                if($kategori >= 1){
                    $kesimpulan .= " + Rendah Natrium";
                }elseif ($kategori == 0){
                    $kesimpulan .= "Menu Rendah Natrium";
                }
            }

            if($kol <= 3){
                if($kategori >= 1){
                    $kesimpulan .= " + Rendah Kolestrol";
                }elseif ($kategori == 0){
                    $kesimpulan .= "Menu Rendah Kolestrol";
                }
            }

            if ($kesimpulan == ""){
                return $kesimpulan = "Menu Normal";
            }

            return $kesimpulan;
        }
@endphp

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
                            <h2 class="content-header-title float-start mb-0">Hasil Akhir</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="hasil">Hasil Akhir</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard Analytics Start -->
            <section class="app-user-list">
                @if (auth()->user()->role != 'admin')
                <section id="card-demo-example">
                    <div class="row match-height">
                    <?php $counter = 0; ?>
                    @foreach ($astotalrank[auth()->user()->id] as $alid => $as)
                        <?php if ($counter == 3) break; ?>
                            <div class="col-md-6 @if($counter == 0) col-xl-12 @else col-xl-6 @endif">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Menu Makanan #{{$as}}</h4>
                                        <h6 class="card-subtitle text-muted">{{$alter->find($alid)->nama}}</h6>
                                    </div>
                                    <img class="img-fluid" src="{{asset('storage/files/gambar/' . $alter->find($alid)->gambar)}}" alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text">{{$alter->find($alid)->caption}}</p>
                                        <p class="card-text">{{$alter->find($alid)->catatan}}</p>
                                        <a href="{{asset('storage/files/gambar/' . $alter->find($alid)->gambar)}}" class="card-link">Lihat Menu Makanan</a>
                                        <a href="{{ asset('storage/files/gambar/' . $alter->find($alid)->gambar) }}" download class="card-link">Download Menu Makanan</a>

                                    </div>
                                </div>
                            </div>
                        <?php $counter++; ?>
                    @endforeach
                    </div>
                  </section>
                @endif
                <section id="accordion-with-margin">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Perhitungan Profile Matching</h4>
                          </div>
                          @if (auth()->user()->role == 'admin')
                            <div class="card-body">
                                @foreach ($users->where('role', '!=', 'admin') as $user)
                                <div class="accordion accordion-margin" id="sdfasdfasd" data-toggle-hover="true">
                                    <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingMargin{{$user->id}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sdfasdfasd{{$user->id}}" aria-expanded="false" aria-controls="sdfasdfasd{{$user->id}}">
                                        User - {{$user->name}} ({{$user->id}})
                                        </button>
                                    </h2>
                                    <div id="sdfasdfasd{{$user->id}}" class="accordion-collapse collapse" aria-labelledby="headingMargin{{$user->id}}" data-bs-parent="#sdfasdfasd">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="wptable user-list-table table">
                                                    <thead>
                                                        <tr>
                                                        <th>No.</th>
                                                        <th>Alternatif</th>
                                                        <th>CF</th>
                                                        <th>SF</th>
                                                        <th>Total</th>
                                                        <th>Menu Makanan</th>
                                                        <th>Rank</th>
                                                        {{-- <th>Label</th>
                                                        <th>Keterangan</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($alter as $a => $alt)
                                                                <tr @if($totalrank[$user->id][$alt->id] <= 3) style="background-color: lightblue;" @endif>
                                                                    <td>{{$a+1}}</td>
                                                                    <td>{{$alt->nama}}</td>
                                                                    <td>{{$corefactor[$user->id][$alt->id]}}</td>
                                                                    <td>{{$secondaryfactor[$user->id][$alt->id]}}</td>
                                                                    <td>{{$total[$user->id][$alt->id]}}</td>
                                                                    <td>{{classify(($nilai->where('id_user', $user->id)->where('id_alternatif', $alt->id)->where('id_kriteria', 2)->first()->nilai ?? 5), ($nilai->where('id_user', $user->id)->where('id_alternatif', $alt->id)->where('id_kriteria', 3)->first()->nilai ?? 5), ($nilai->where('id_user', $user->id)->where('id_alternatif', $alt->id)->where('id_kriteria', 4)->first()->nilai ?? 5))}}</td>
                                                                    <td>{{$totalrank[$user->id][$alt->id]}}</td>
                                                                </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                          @else
                            <div class="card-body">
                                <div class="accordion accordion-margin" id="jtjgsfsdkafnj" data-toggle-hover="true">
                                    <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingMargin{{auth()->user()->id}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#jtjgsfsdkafnj{{auth()->user()->id}}" aria-expanded="false" aria-controls="jtjgsfsdkafnj{{auth()->user()->id}}">
                                        User - {{auth()->user()->name}} ({{auth()->user()->id}})
                                        </button>
                                    </h2>
                                    <div id="jtjgsfsdkafnj{{auth()->user()->id}}" class="accordion-collapse collapse" aria-labelledby="headingMargin{{auth()->user()->id}}" data-bs-parent="#jtjgsfsdkafnj">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="wptable user-list-table table">
                                                <thead>
                                                    <tr>
                                                    <th>No.</th>
                                                    <th>Alternatif</th>
                                                    <th>CF</th>
                                                    <th>SF</th>
                                                    <th>Total</th>
                                                    <th>Rank</th>
                                                    {{-- <th>Label</th>
                                                    <th>Keterangan</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alter as $a => $alt)
                                                            <tr @if($totalrank[auth()->user()->id][$alt->id] <= 3) style="background-color: lightgreen;" @endif>
                                                                <td>{{$a+1}}</td>
                                                                <td>{{$alt->nama}}</td>
                                                                <td>{{$corefactor[auth()->user()->id][$alt->id]}}</td>
                                                                <td>{{$secondaryfactor[auth()->user()->id][$alt->id]}}</td>
                                                                <td>{{$total[auth()->user()->id][$alt->id]}}</td>
                                                                <td>{{$totalrank[auth()->user()->id][$alt->id]}}</td>

                                                            </tr>
                                                    @endforeach
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                </section>

            </section>

        </div>
    </div>
</div>

{{-- MODAL --}}


{{-- MODAL END --}}


<!-- END: Content-->
@include('app.footer')


<!-- BEGIN: Page Vendor JS-->
<script src="/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="/app-assets/vendors/js/charts/chart.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
{{-- <script src="/app-assets/js/scripts/charts/chart-chartjs.min.js"></script> --}}
<!-- END: Page JS-->
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>

    $(document).ready(function(){
        const table = $('.wptable').DataTable({
            searching: false, paging: false, info: false,
        })
        });

        $(document).ready(function(){
        const table = $('.bordatable').DataTable({
            searching: false, paging: false, info: false,
            order: [[3, 'asc']]
        })
        });

</script>
