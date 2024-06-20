@include('app.app', ['penilaian_active' => 'active', 'title' => 'Data Informasi Diri'])

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
                            <h2 class="content-header-title float-start mb-0">Data Informasi Diri</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/penilaian">Data Informasi Diri</a>
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
                        <form action="{{route('penilaian.store')}}" method="post">
                            @csrf
                            <div class="card-datatable table-responsive pt-0">
                                <div class="card-header p-0">
                                    <div class="head-label"><h5 class="mt-1">Tabel Data Kriteria</h5></div>
                                </div>
                                <table class="user-list-table table" id="kriteriatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Inputan</th>
                                            <th>Klasifikasi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-12 dt-action-buttons text-end">
                                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Simpan Perubahan</button>
                            </div>
                        </form>
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
                ordering: false,
                paging: false,
                searching: false,


                ajax : {
                    url: '{{ route('penilaian.index') }}',
                    type: 'GET'
                },

                columns : [
                    {data: 'id'},
                    {data: 'kode'},
                    {data: 'nama'},
                    {data: 'action'},
                    {data: 'klasifikasi'}
                ],

                order: [[0, 'asc']],
                "drawCallback" : function( settings ) {
                    feather.replace();
                }
            })
        });

    </script>
<script>
    $(document).ready(function() {
        // Handle change on range inputs using event delegation
        $(document).on('input', '.range-input', function() {
            var $input = $(this);
            var kriteriaId = $input.data('kriteria-id');
            var value = parseFloat($input.val());
            var isValid = false;

            var $dropdown = $('#klasifikasiSelect_' + kriteriaId);
            if (!$dropdown.length) return;

            // Iterate through options and select the appropriate one
            $dropdown.find('option').each(function() {
                var $option = $(this);
                var rangeAwal = parseFloat($option.data('range-awal'));
                var rangeAkhir = parseFloat($option.data('range-akhir'));

                // Handle '>200' or '<70' cases
                if (!isNaN(value)) {
                    if ((isNaN(rangeAkhir) && value > rangeAwal) ||
                        (isNaN(rangeAwal) && value < rangeAkhir) ||
                        (value >= rangeAwal && value <= rangeAkhir)) {
                        $option.prop('selected', true);
                        isValid = true;
                    } else {
                        $option.prop('selected', false);
                    }
                }
            });

            // Validate input value and show error if not valid
            if (!isValid) {
                $input.addClass('is-invalid');
                $dropdown.prop('disabled', true); // Disable dropdown if input is invalid
            } else {
                $input.removeClass('is-invalid');
                $dropdown.prop('readonly', true); // Enable dropdown if input is valid
            }
        });
    });
</script>








{{-- MODAL SPACES --}}
