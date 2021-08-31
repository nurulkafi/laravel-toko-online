@extends('admin.layouts.main')
@section('Revenue','active')
@section('content')
<div class="row" id="table-bordered">
    <div class="card">
        <div class="card-header">
        <div class="row">
            <div class="col-md-6"><h4 class="card-title">Table {{ $title }}</h4></div>
        </div>
        </div>
        <div class="card-content">
            <div class="card-body" style="margin-top:-40px">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Month</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        @php
                            $month = ["January","Februry","March","April",
                                      "May" , "June" , "July" , "August",
                                      "Sepetember","October","November","Desember"];
                            $i = 0;
                        @endphp
                        @foreach ($revenue as $item)
                            <tr>
                                <th>{{ $i+1 }}</th>
                                <th>{{ $month[$i++] }}</th>
                                <th> {{$item}} </th>
                            </tr>
                        @endforeach
                        <tbody>
                        </tbody>
                    </table>
                    {{-- modal --}}
                    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title white" id="myModalLabel1">Peringatan</h5>
                                    <button type="button" class="close rounded-pill"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Apakah Anda Yakin Akan Menghapus Data?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">NO</span>
                                    </button>
                                    <a class="btn btn-primary ml-1 yesHapusClickP">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Yes</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('simpleDataTable')
<script src="{{ asset('admin/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1,{
            paging: false,
        });
</script>
@endpush
@endsection
