@extends('admin.layouts.master')
@section('title')
    All Admin Details - Derick Veliz admin
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
                        <h3 class="page-title">Admin Information</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-0">Admin Details</h4>
                            </div>
                            
                        </div>
                    </div>

                    <hr />
                    <div class="table-responsive">
                        @if($total_data->count() > 0)
                        <table id="myTable" class="dd table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($total_data as $key =>$total)
                                
                                <tr>
                                    <td>{{ $total['id']}}</td>
                                    <td>{{ $total->number}}</td>
                                </tr>
                               
                                @endforeach
                            </tbody>

                        </table>
                        <div>
                            {{ $total_data->links() }}
                        </div>
                        @else
                        <h3 class="text-center">No Data Found</h3>
                        @endif
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
            "pageLength": 20,
        });

    });
</script>
@endpush
