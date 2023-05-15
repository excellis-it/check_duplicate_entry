@extends('admin.layouts.master')
@section('title')
    All Fresh Data Details - Derick Veliz admin
@endsection


@section('content')
    @php
        use App\Models\User;
    @endphp
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Fresh Data Information</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_admin"><i
                                class="fa fa-file-excel"></i> Import</a>
                    </div>
                </div>
            </div>
            <div class="import-excel" style="display: none;">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-xl-12 mx-auto">
                                    <h6 class="mb-0 text-uppercase">Import Excel File</h6>
                                    <hr>
                                    <div class="card border-0 border-4">
                                        <div class="card-body">
                                            <form action="{{ route('admin.fresh-data.import') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="border p-4 rounded">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="inputEnterYourName" class="col-form-label"> Excel
                                                                <span style="color: red;">*</span></label>
                                                            <input type="file" name="excel" id=""
                                                                class="form-control" placeholder="Enter excel">
                                                            @if ($errors->has('excel'))
                                                                <div class="error" style="color:red;">
                                                                    {{ $errors->first('excel') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6" style="margin-top: 35px; ">
                                                            <button type="submit" class="btn px-5 submit-btn"> <i
                                                                    class="fa fa-file-excel"></i> Import
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Fresh Data</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="javascript:void(0); " id="download-excel"
                                            data-route="{{ route('admin.fresh-data.export') }}"
                                            data-url="{{ route('admin.total-data') }}" class="btn btn-primary float-end"><i
                                                class="fa fa-download"></i> Download</a>
                                    </div>

                                </div>
                            </div>

                            <hr />
                            <div class="table-responsive">
                                <table id="myTable" class="dd table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Number</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fresh_data as $key => $total)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $total->number }}</td>
                                                <td>
                                                    <span class="badge bg-success">
                                                        Fresh
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Duplicate Data </h4>
                                    </div>

                                </div>
                            </div>

                            <hr />
                            <div class="table-responsive">
                                <table id="myTable2" class="dd table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Number</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($duplicate_data as $key => $duplicate)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $duplicate->number }}</td>
                                                <td>
                                                    <span class="badge bg-danger">Duplicate</span>
                                                </td>
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

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //Default data table
            $('#myTable').DataTable({
                "aaSorting": [],
                "columnDefs": [{
                        "orderable": false,
                        "targets": []
                    },
                    {
                        "orderable": true,
                        "targets": [0, 1]
                    }
                ],
                // show data in a paginatoion upto 20 data
                "pageLength": 20,
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            //Default data table
            $('#myTable2').DataTable({
                "aaSorting": [],
                "columnDefs": [{
                        "orderable": false,
                        "targets": []
                    },
                    {
                        "orderable": true,
                        "targets": [0, 1]
                    }
                ],
                // show data in a paginatoion upto 20 data
                "pageLength": 20,
            });

        });
    </script>
    {{-- toggle import-excel --}}
    <script>
        $(document).ready(function() {
            $(".import-excel").hide();
            $(".add-btn").click(function() {
                $(".import-excel").toggle('slow');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#download-excel').on('click', function() {
                var route = $(this).data('route');
                var url = $(this).data('url');
                $.ajax({
                    url: route,
                    type: 'GET',
                    success: function(response) {
                        var link = document.createElement('a');
                        link.href = '/storage/app' + response.file; // Assuming the file is stored in the 'storage' folder
                        link.download = response.file;
                        link.click();
                        window.location.reload();
                    },
                });
            });
        });
    </script>
    <script>
        @if (Session::has('success'))
            window.location.reload();
        @endif
    </script>
@endpush
