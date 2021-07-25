<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Ace Admin</title>

    <!-- include common vendor stylesheets & fontawesome -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">
    <!-- include vendor stylesheets used in "Login" page. see "/views//pages/partials/page-login/@vendor-stylesheets.hbs" -->

    <!-- include fonts -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">

    <!-- ace.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ace.min.css') }}">


    <!-- "Login" page styles, specific to this page for demo only -->
    <style>
        .body-container {
            background-image: linear-gradient(#6baace, #264783);
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .carousel-item>div {
            height: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        /* these rules are used to make sure in mobile devices, tab panes are not all the same height (for example 'forgot' pane is not as tall as 'signup' pane) */

        @media (max-width: 1199.98px) {
            .tab-sliding .tab-pane:not(.active) {
                max-height: 0 !important;
            }

            .tab-sliding .tab-pane.active {
                min-height: 80vh;
                max-height: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="body-container">

        <div class="main-container container bgc-transparent">

            <div class="main-content minh-100 justify-content-center">
                <div class="p-2 p-md-4">
                    <div class="row" id="row-1">
                        <div class="col-12 col-xl-6 offset-xl-3 bgc-white shadow radius-1 overflow-hidden">

                            <div class="tab-content tab-sliding border-0 p-0" data-swipe="right">

                                <div class="tab-pane active show mh-100 px-3 px-lg-0 pb-3" id="id-tab-login">
                                    <!-- show this in desktop -->
                                    <div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0">
                                        <h4 class="text-dark-tp4 border-b-1 brc-secondary-l2 pb-1 text-130 text-center">

                                            Login Admin
                                        </h4>
                                    </div>

                                    <!-- show this in mobile device -->
                                    <div class="d-lg-none text-secondary-m1 my-4 text-center">
                                        <h4 class="text-dark-tp4 border-b-1 brc-secondary-l2 pb-1 text-130 text-center">

                                            Login Admin
                                        </h4>
                                    </div>

                                    <div id="response-message"></div>

                                    <form autocomplete="off" class="form-row mt-4" id="login-form">
                                        <div
                                            class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                                            <div
                                                class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                                <input placeholder="Username" type="text"
                                                    class="form-control form-control-lg pr-4 shadow-none" id="username"
                                                    name="username" autofocus tabindex="1" />
                                                <i class="fa fa-user text-grey-m2 ml-n4"></i>

                                                <label class="floating-label text-grey-l1 ml-n3" for="username">
                                                    Username
                                                </label>
                                            </div>

                                            <div class="text-danger validation" data-field="username"></div>
                                        </div>


                                        <div
                                            class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
                                            <div
                                                class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                                <input placeholder="Password" type="password"
                                                    class="form-control form-control-lg pr-4 shadow-none" id="password"
                                                    name="password" tabindex="2" />
                                                <i class="fa fa-key text-grey-m2 ml-n4"></i>
                                                <label class="floating-label text-grey-l1 ml-n3" for="password">
                                                    Password
                                                </label>
                                            </div>

                                            <div class="text-danger validation" data-field="password"></div>
                                        </div>

                                        <div
                                            class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2">

                                            <button type="submit" id="login"
                                                class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-3">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- .tab-content -->


                        </div><!-- /.row -->


                    </div>
                </div>

            </div>

        </div>

        <!-- include common vendor scripts used in demo pages -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
        <!-- include vendor scripts used in "Login" page. see "/views//pages/partials/page-login/@vendor-scripts.hbs" -->
        <!-- include ace.js -->
        <script src="{{ asset('assets/js/ace.min.js') }}"></script>

        <!-- demo.js is only for Ace's demo and you shouldn't use it -->
        <script src="{{ asset('assets/js/demo.min.js') }}"></script>

        <!-- "Login" page script to enable its demo functionality -->
        <script>
            $('#login-form').submit(function (e) {
                e.preventDefault()

                var fd = new FormData(document.getElementById('login-form'))

                $.ajax({
                    url: '{{ route('login.login') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: fd,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        $('#login').prop('disabled', true)
                    },
                    success: function (response) {
                        var { status, message } = response

                        if (status == 'success') {
                            window.location.replace('{{ route('admin.submission-list') }}')
                        } else {
                            var msg = `<div class="alert d-flex bgc-danger-l4 text-dark-tp3 radius-0 text-120 brc-danger-l2 col-md-6 offset-md-3" role="alert">
                            <div class="position-tl h-102 ml-n1px border-l-4 brc-danger-tp2 m-n1px"></div>

                            <i class="fas fa-exclamation-circle mr-3 fa-2x text-orange-d1"></i>
                            <span class="align-self-center">
                                ${message}
                            </span>
                            </div>`
                            $('#response-message').html(msg)
                        }

                        $('#login').prop('disabled', false)
                    },
                    error: function (err) {
                        if(err.status == 422) {
                            $.each(err.responseJSON.errors, function (i, error) {
                                $('[data-field="'+i+'"]').html(error[0])
                            });
                        } else {
                            alert('Oops, Something went Wrong')
                        }

                        $('#login').prop('disabled', false)
                    }
                })
            })
        </script>
</body>

</html>
