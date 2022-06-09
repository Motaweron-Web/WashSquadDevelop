<!doctype html>
<html  lang="ar" style="direction: rtl;">

<head>
    {{-- incloude css --}}
    @include('admin.layouts.assets.css')
</head>

<body class="bg-pattern">
<div class="bg-overlay"></div>
<div class="account-pages my-5 pt-5">
    <div class="logo">
        <a href="">
            <img src="{{url('assets/admin')}}/images/Group 1.png" alt="" srcset="">

        </a>
    </div>
    <div class="lang">
        <div class="dropdown">
            <button class="btn   dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                en
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">ar</a></li>
            </ul>
        </div>

    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-8">
                <div class="">
                    <div class="card-body p-4">
                        <div class="">

                            <!-- end row -->
                            <h4 class="font-size-18 text-white  mt-2 text-center">Welcome</h4>
                            <h2 class="mb-5 text-center text-white  fw-bold">Wahsquad  Login</h2>
                            <form class="form-horizontal" action="{{route('admin.login.submit')}}" method="POST" id="Form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <!-- <label class="form-label" for="username">Username</label> -->
                                            <input type="email" class="form-control" id="username" name="email" placeholder="Email">
                                        </div>
                                        <div class="mb-4">
                                            <!-- <label class="form-label" for="userpassword">Password</label> -->
                                            <input type="password" style="direction: ltr" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                                        </div>


                                        <div class="d-grid mt-4">
                                            <button class="btn login-btn btn-primary waves-effect waves-light" id="loginButton" form="Form" type="submit"> <i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> Login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>

    <div class="login-footer">

    </div>
</div>
<!-- end Account pages -->
{{-- incloude css --}}
@include('admin.layouts.assets.js')

<script>

    $("form#Form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = $('#Form').attr('action');
        $.ajax({
            url:url,
            type: 'POST',
            data: formData,
            beforeSend: function(){
                $('#loginButton').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                    ' ></span> <span style="margin-left: 4px;">working</span>').attr('disabled', true);

            },
            complete: function(){


            },
            success: function (data) {
                if (data == 200){
                    toastr.success('تم تسجيل الدخول بنجاح');
                    window.setTimeout(function() {
                        window.location.href='{{route('admin.dashboard')}}';
                    }, 1000);
                }else {
                    toastr.error('خطأ فى كلمة المرور');
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> Login`).attr('disabled', false);
                }

            },
            error: function (data) {
                if (data.status === 500) {
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> Login`).attr('disabled', false);
                    toastr.error('هناك خطأ ما');
                }
                else if (data.status === 422) {
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> Login`).attr('disabled', false);
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                toastr.error(value,key);
                            });

                        } else {
                        }
                    });
                }else {
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> Login`).attr('disabled', false);

                    toastr.error('there in an error');
                }
            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>

</body>
</html>
