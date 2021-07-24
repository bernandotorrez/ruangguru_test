@extends('layouts.main')

@section('content')
<div class="page-content container container-plus">
    <!-- page header and toolbox -->
    <div class="page-header pb-2">
        <h1 class="page-title text-primary-d2 text-150">
            Get your prizes now!
        </h1>
    </div>

    <div class="card-body px-3 pb-1">
        <form id="submission-form" name="submission-form" method="post">
            <div id="response-message" class="text-center"></div>

            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="user_id">User ID</label>
                    <input type="text" class="form-control" maxlength="50" id="user_id" name="user_id"
                        placeholder="Contoh : bernand001" tabindex="1" autocomplete="off" autofocus>
                    <div class="text-danger validation" data-field="userId"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" maxlength="100" id="name" name="name" readonly>
                    <div class="invalid-feedback validation" data-field="name"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" maxlength="100" id="email" name="email" readonly>
                    <div class="invalid-feedback validation" data-field="email"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" maxlength="100" id="phone" name="phone" readonly>
                    <div class="invalid-feedback validation" data-field="phone"></div>
                </div>
                <div class="form-group col-md-12">
                    <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                        <div class="offset-md-4 col-md-8 text-nowrap">
                            <button class="btn btn-info btn-bold px-4" type="submit" id="submit">
                                <i class="fa fa-check mr-1"></i>
                                Submit
                            </button>

                            <button class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4" type="reset">
                                <i class="fa fa-undo mr-1"></i>
                                Reset
                            </button>
                        </div>
                    </div>
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
        getUser(userId)
    }));

    function getUser(userId) {
        var url = '{{ route('home.check-eligible') }}'
        var validationEl = $('.validation')

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            data: {
                userId: userId
            },
            beforeSend: function() {
                $('#response-message').html('')
                $('#submit').prop('disabled', false)
                $('#user_id').prop('readonly', true)
                $('#name').val('Searching...')
                $('#email').val('Searching...')
                $('#phone').val('Searching...')

                $.each(validationEl, function(key, val) {
                    val.innerHTML = ''
                })
            },
            success: function(response) {
                var {user, isEligible, eligiblePrizes} = response

                if(isEligible == 1) {
                    var eligiblePrize = []
                    eligiblePrizes.forEach(prize => {
                        eligiblePrize.push(prize.prize_name)
                    });

                    var message = `<div
                        class="alert d-flex bgc-green-l4 brc-green-m4 border-1 border-l-0 pl-3 radius-l-0" role="alert">
                        <div class="position-tl h-102 border-l-4 brc-green mt-n1px"></div>
                        <i class="fa fa-check mr-3 text-180 text-green"></i>

                        <span class="align-self-center text-green-d2 text-120">
                            Hooray, you're Eligible and you will get : <strong>${eligiblePrize.toString()}</strong>
                        </span>
                    </div>`
                } else {
                    var message = `
                    <div class="alert d-flex bgc-danger-l4 text-dark-tp3 radius-0 text-120 brc-danger-l2" role="alert">
                      <div class="position-tl h-102 ml-n1px border-l-4 brc-danger-tp2 m-n1px"></div>

                      <i class="fas fa-exclamation-circle mr-3 fa-2x text-orange-d1"></i>
                      <span class="align-self-center">
                        Unfortunately, you're not Eligible to get the Prizes
                      </span>
                    </div>
                    `
                }

                $('#response-message').html(message)
                $('#user_id').prop('readonly', false)
                $('#name').val(user.userName)
                $('#email').val(user.userEmail)
                $('#phone').val(user.userPhoneNumber)

            },
            error: function(err){
                if(err.status == 404) {
                    var message = `<div class="alert d-flex bgc-danger-l4 text-dark-tp3 radius-0 text-120 brc-danger-l2" role="alert">
                      <div class="position-tl h-102 ml-n1px border-l-4 brc-danger-tp2 m-n1px"></div>

                      <i class="fas fa-exclamation-circle mr-3 fa-2x text-orange-d1"></i>
                      <span class="align-self-center">
                        Sorry, we can find <strong>${userId}</strong> user
                      </span>
                    </div>`
                    $('#response-message').html(message)
                    console.log('not found')

                } else if(err.status == 422) {
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('[data-field="'+i+'"]').html(error[0])
                    });
                } else {
                    console.log('something error')
                }

                $('#submit').prop('disabled', true)
                $('#user_id').prop('readonly', false)
                $('#name').val('')
                $('#email').val('')
                $('#phone').val('')

            }
        })
    }

    $('#submission-form').submit(function(e) {
        e.preventDefault()
        var fd = new FormData(document.getElementById('submission-form'))

        Swal.fire({
            title: 'Submit this Submission?',
            text: "Please ensure then click Confirm",
            type: "info",
            icon: 'question',
            showCancelButton: true,
            reverseButtons: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: '{{ route('home.submit-submission') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: fd,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {

                        var status = response.status
                        var message = response.message

                        if (status == 'success') {
                            Swal.fire(message, "", "success")
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
    })
</script>
@endpush
