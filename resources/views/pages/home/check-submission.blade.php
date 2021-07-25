@extends('layouts.main')

@section('title', 'Check Submission')

@section('content')
<div class="page-content container container-plus">
    <!-- page header and toolbox -->
    <div class="page-header pb-2">
        <h1 class="page-title text-primary-d2 text-150">
            Check your Submission progress
        </h1>
    </div>

    <div class="card-body px-3 pb-1">
        <form id="submission-form" name="submission-form" method="post">
            <div id="response-message" class="text-center"></div>

            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="user_id" class="text-danger">User ID *</label>
                    <input type="text" class="form-control" maxlength="50" id="user_id" name="user_id"
                        placeholder="Ex : bernand001" tabindex="1" autocomplete="off" autofocus>
                    <div class="text-danger validation" data-field="userId"></div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@push('js')
<script>
    $('#user_id').keyup($.debounce(500, function(e) {
        var userId = $(this).val()
        getSubmission(userId)
    }));

    function getSubmission(userId) {
        var url = '{{ route('home.check-my-submission') }}'
        var validationEl = $('.validation')

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: {
                userId: userId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#response-message').html('')
                $('#user_id').prop('readonly', true)

                $.each(validationEl, function(key, val) {
                    val.innerHTML = ''
                })
            },
            success: function(response) {
                var { status, message, data, progress } = response

                if(status == 'success') {
                    var message = `<div
                        class="alert d-flex bgc-green-l4 brc-green-m4 border-1 border-l-0 pl-3 radius-l-0" role="alert">
                        <div class="position-tl h-102 border-l-4 brc-green mt-n1px"></div>
                        <i class="fa fa-check mr-3 text-180 text-green"></i>

                        <span class="align-self-center text-green-d2 text-120">
                            Your submission progress is : <strong>${progress}</strong>
                        </span>
                    </div>`
                } else {
                    var message = `<div class="alert d-flex bgc-danger-l4 text-dark-tp3 radius-0 text-120 brc-danger-l2" role="alert">
                      <div class="position-tl h-102 ml-n1px border-l-4 brc-danger-tp2 m-n1px"></div>

                      <i class="fas fa-exclamation-circle mr-3 fa-2x text-orange-d1"></i>
                      <span class="align-self-center">
                        Sorry, we can't find your Submission
                      </span>
                    </div>`
                }

                $('#response-message').html(message)
                $('#user_id').prop('readonly', false)

            },
            error: function(err){
                if(err.status == 422) {
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('[data-field="'+i+'"]').html(error[0])
                    });
                } else {
                    console.log('something error')
                }

                $('#user_id').prop('readonly', false)
            }
        })
    }
</script>
@endpush
