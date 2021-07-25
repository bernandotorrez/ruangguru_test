@extends('layouts.main')

@section('title', 'Submission')

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

            <input type="hidden" id="is_eligible" name="is_eligible">

            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="user_id" class="text-danger">User ID *</label>
                    <input type="text" class="form-control" maxlength="50" id="user_id" name="user_id"
                        placeholder="Ex : bernand001" tabindex="1" autocomplete="off" autofocus>
                    <div class="text-danger validation" data-field="userId"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="contact_person">Name</label>
                    <input type="text" class="form-control" maxlength="100" id="contact_person"
                    name="contact_person" readonly>
                    <div class="text-danger validation" data-field="contact_person"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="user_email">Email</label>
                    <input type="text" class="form-control" maxlength="100" id="user_email"
                    name="user_email" readonly>
                    <div class="text-danger validation" data-field="user_email"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="contact_number">Phone</label>
                    <input type="text" class="form-control" maxlength="15" id="contact_number"
                    name="contact_number" readonly>
                    <div class="text-danger validation" data-field="contact_number"></div>
                </div>
                <div class="form-group col-md-12">
                    <label for="delivery_address" class="text-danger">Delivery Address *</label>
                    <textarea name="delivery_address" id="delivery_address" cols="5" rows="5"
                    class="form-control" tabindex="2"
                    placeholder="Ex : Jl. Moh Kahfi 1"></textarea>
                    <div class="text-danger validation" data-field="delivery_address"></div>
                </div>
                <div class="form-group col-md-12">
                    <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                        <div class="offset-md-4 col-md-8 text-nowrap">
                            <button class="btn btn-info btn-bold px-4" type="submit" id="submit" disabled>
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
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#response-message').html('')
                $('#submit').prop('disabled', true)
                $('#user_id').prop('readonly', true)
                $('#contact_person').val('Searching...')
                $('#user_email').val('Searching...')
                $('#contact_number').val('Searching...')
                $('#is_eligible').val('')

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

                    $('#submit').prop('disabled', false)
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

                    $('#submit').prop('disabled', true)
                }

                $('#response-message').html(message)
                $('#user_id').prop('readonly', false)
                $('#contact_person').val(user.userName)
                $('#user_email').val(user.userEmail)
                $('#contact_number').val(user.userPhoneNumber)
                $('#is_eligible').val(isEligible)

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
                $('#contact_person').val('')
                $('#user_email').val('')
                $('#contact_number').val('')
                $('#is_eligible').val('')
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

                        var {status, message} = response

                        if (status == 'success') {
                            Swal.fire(message, "", "success")
                            $('.swal2-confirm').click(function () {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(message, "", "error")
                        }
                    },
                    error: function (err) {
                        if(err.status == 422) {
                            Swal.fire("Oops, Please fill some Red field", "", "error")
                            $.each(err.responseJSON.errors, function (i, error) {
                                $('[data-field="'+i+'"]').html(error[0])
                            });
                        } else {
                            Swal.fire("Oops, Something went Wrong", "", "error")
                        }

                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {

        })
    })
</script>
@endpush
