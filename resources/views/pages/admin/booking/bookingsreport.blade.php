@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header mt-2 flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">List Booking</h4>
                        <p class="m-0 subtitle">Add <code>Patient</code> class with <code>datatables</code></p>
                    </div>
                    {{-- <ul class="nav nav-tabs dzm-tabs" id="myTab-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" id="add-btn" class="nav-link active">Add</button>
                        </li>
                    </ul> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-list" class="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Booking Date</th>
                                    <th>No Booking</th>
                                    <th>Customers Name</th>
                                    {{-- <th>Category (Package)</th> --}}
                                    
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Duration(Minutes)</th>
                                    <th>Total Price(Rp)</th>
                                    {{-- <th>Discount</th>
                                    <th>Total Price</th> --}}
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <script src="{{ $javascriptFile }}"></script>
@endpush
