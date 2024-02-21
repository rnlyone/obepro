@include('app.app', ['profmat_active' => 'active', 'title' => 'Perhitungan Profmat'])

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
                            <h2 class="content-header-title float-start mb-0">Perhitungan Profmat</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="owa">Perhitungan Profmat</a>
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
                            <h4 class="card-title">Perhitungan Profile Matching</h4>
                          </div>
                          <div class="card-body">
                            @foreach ($users->where('role', '!=', 'admin') as $user)
                            <div class="accordion accordion-margin" id="accordionMargin" data-toggle-hover="true">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingMargin{{$user->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMargin{{$user->id}}" aria-expanded="false" aria-controls="accordionMargin{{$user->id}}">
                                      User - {{$user->name}} ({{$user->id}})
                                    </button>
                                  </h2>
                                  <div id="accordionMargin{{$user->id}}" class="accordion-collapse collapse" aria-labelledby="headingMargin{{$user->id}}" data-bs-parent="#accordionMargin">
                                    <div class="accordion-body">
                                        <div class="table-responsive">
                                            <table class="wptabl user-list-table table table-striped">
                                              <thead>
                                                <tr>
                                                  <th>No.</th>
                                                  <th>Alternatif</th>
                                                  <th>Kriteria</th>
                                                  <th></th>
                                                  <th></th>
                                                  <th>Sub Kriteria</th>
                                                  <th></th>
                                                  <th></th>
                                                  <th></th>
                                                  <th>Target</th>
                                                  <th>Gap</th>
                                                  <th>Bobot</th>
                                                  <th>CF</th>
                                                  <th>SF</th>
                                                  <th>Total</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach ($alter as $a => $alt)
                                                      @foreach ($krit as $k => $kr)
                                                          <tr>
                                                              @if ($k == 0)
                                                              <td rowspan="{{$krit->count()}}">{{$a}}</td>
                                                              <td rowspan="{{$krit->count()}}">{{$alt->nama}}</td>
                                                              @endif
                                                              <td colspan="3">{{$kr->nama}}</td>
                                                              <td colspan="4">{{$sub->find($nilai->where('id_user', $user->id)->where('id_alternatif', $alt->id)->where('id_kriteria', $kr->id)->first()->id_subkriteria ?? "")->nama ?? 'NULL'}} | ({{$nilai->where('id_user', $user->id)->where('id_alternatif', $alt->id)->where('id_kriteria', $kr->id)->first()->nilai ?? 'NULL'}})</td>
                                                              <td>5</td>
                                                              <td>{{$gap[$user->id][$alt->id][$kr->id]}}</td>
                                                              <td>{{$bobotgap[$user->id][$alt->id][$kr->id]}}</td>
                                                              @if ($k == 0)
                                                                  <td rowspan="{{$krit->count()}}">{{$corefactor[$user->id][$alt->id]}}</td>
                                                                  <td rowspan="{{$krit->count()}}">{{$secondaryfactor[$user->id][$alt->id]}}</td>
                                                                  <td rowspan="{{$krit->count()}}">{{$total[$user->id][$alt->id]}}</td>
                                                              @endif
                                                          </tr>
                                                      @endforeach
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
