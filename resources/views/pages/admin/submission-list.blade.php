@extends('layouts.main')

@section('title', 'Submission List')

@push('css')
<!-- include vendor stylesheets used in "DataTables" page. see "/views//pages/partials/table-datatables/@vendor-stylesheets.hbs" -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

@endpush

@section('content')
<div class="page-content container container-plus">
    <!-- page header and toolbox -->
    <div class="page-header pb-2">
        <h1 class="page-title text-primary-d2 text-150">
            Submission List
        </h1>
    </div>

    <div class="card bcard h-auto w-auto" style="width: 100%;">
        <div class="table-responsive">
            <form autocomplete="off" class="border-t-3 brc-blue-m2">
                <table id="table" class="table table-striped table-bordered"></table>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- include vendor scripts used in "DataTables" page. see "/views//pages/partials/table-datatables/@vendor-scripts.hbs" -->
<!-- include vendor scripts used in "DataTables" page. see "/views//pages/partials/table-datatables/@vendor-scripts.hbs" -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    var column = [
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            title: 'No',
            className: 'text-center'
        },
        {
            data: 'user_id',
            name: 'user_id',
            title: 'User ID'
        },
        {
            data: 'user_email',
            name: 'user_email',
            title: 'User Email',
        },
        {
            data: 'delivery_address',
            name: 'delivery_address',
            title: 'Delivery Address',
        },
        {
            data: 'contact_number',
            name: 'contact_number',
            title: 'Contact Number',
        },
        {
            data: 'contact_person',
            name: 'contact_person',
            title: 'Contact Person',
        },
        {
            data: 'isEligible',
            name: 'isEligible',
            title: 'Eligible?',
            className: 'text-center'
        },
        {
            data: 'statusSubmission',
            name: 'statusSubmission',
            title: 'Status Submission',
            className: 'text-center'
        },
        {
            data: 'createdAt',
            name: 'createdAt',
            title: 'Created Date',
            className: 'text-center'
        },
    ]

    $(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: false,
            order: [[ 2, "asc" ]],
            ajax: '{!! route('admin.data-submission') !!}',
            columns: column
        });
    });

    // For Refresh Datatable if Data has been Inserted / Updated / Deleted
    function redrawDatatable() {
        $('#table').DataTable().destroy();
        $('#table').html('');

        $('#table').DataTable({
            processing: true,
            serverSide: false,
            order: [[ 2, "asc" ]],
            ajax: '{!! route('admin.data-submission') !!}',
            columns: column
        });
    }

    function changeStatusSubmission(e) {
        var id = $(e).attr('data-id')
        var userId = $(e).attr('data-user-id')
        var status = $(e).val()

        Swal.fire({
            title: 'Change this Status Submission?',
            text: "Please ensure then Click Confirm",
            type: "info",
            icon: 'question',
            showCancelButton: true,
            reverseButtons: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: '{{ route('admin.change-status-submission') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        id: id,
                        userId: userId,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {

                        var status = response.status
                        var message = response.message

                        if (status == 'success') {
                            Swal.fire(message, "", "success")
                            //resetButton()
                            redrawDatatable()
                        } else {
                            Swal.fire(message, "", "error")
                        }
                    },
                    error: function (err) {
                        Swal.fire("Oops, Something went Wrong", "", "error")
                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {

        })

        console.log(id, userId)
    }
</script>
@endpush
