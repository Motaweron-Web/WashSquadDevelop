<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="site content" />
    <meta content="" name="mostafa" />
    <title>WashSquad </title>
    <!--  favicon -->
    <link rel="shortcut icon" href="{{asset('assets/site/imgs/fav-icon.png')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/site/css/bootstrap.rtl.min.css')}}">
    <!-- normalize css -->
    <link rel="stylesheet" href="{{asset('assets/site/css/normalize.css')}}">
    <!-- fontawesome 6 -->
    <link rel="stylesheet" href="{{asset('assets/site/css/all.min.css')}}">
    <!-- file uploader -->
    <link rel="stylesheet" href="{{asset('assets/site/css/dropify.min.css')}}">
    <!-- select -->
    <link rel="stylesheet" href="{{asset('assets/site/css/nice-select.css')}}">
    <!-- slider -->
    <link rel="stylesheet" href="{{asset('assets/site/css/swiper.min.css')}}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('assets/site/css/style.css')}}">

</head>

<body>


<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->

<nav class="navbar navbar-expand-lg navbar-light nav-option fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/site/imgs/logo.png')}}" />
        </a>
        <!-- Collapse button -->
        <button class="navbar-toggler pl-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white d-flex justify-content-center align-items-center"><i
                        class="fas fa-bars fa-1x"></i></span>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services"> خدماتنا </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#order-method">طريقة الطلب </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#companies">تواصل معنا </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#app-download"> دخول الشركات </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.dashboard')}}">دخول الموظفين </a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<!-- ------------------------  hero  ------------------------- -->
<!-- ------------------------   hero  ------------------------- -->
<!-- ------------------------   hero  ------------------------- -->
<!-- ------------------------   hero  ------------------------- -->
<!-- ------------------------   hero  ------------------------- -->
<!-- ------------------------   hero  ------------------------- -->

<section id="hero">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <div class="contents">
                    <h2 class="hero-title"> تطبيق ووش سكواد </h2>
                    <p class="hero-para">
                        اهلاً بك في ووش سكواد خدمة الغسيل بالبخار و التلميع
                        المتنقل حمل التطبيق الان و اطلب الخدمة في مكانك
                    </p>

                    <div class="d-flex justify-content-center">
                        <a class="p-1" href="https://play.google.com/store/apps/details?id=com.creative.share.apps.wash_squad" target="_blank">
                            <img src="{{asset('assets/site/imgs/playstore.png')}}" height="60px" alt="">
                        </a>
                        <a class="p-1" href="https://apps.apple.com/eg/app/washsquad-%D9%88%D9%88%D8%B4-%D8%B3%D9%83%D9%88%D8%A7%D8%AF/id1489576684?l=ar" target="_blank">
                            <img src="{{asset('assets/site/imgs/appstore.png')}}" height="60px" alt="">
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class=" three-imgs d-flex justify-content-center align-items-center">
                    <img class="p-2 on-e" src="{{asset('assets/site/imgs/hero.png')}}" height="350px" alt="">
                    <img  class="p-2 one" src="{{asset('assets/site/imgs/hero-mid.png')}}" height="410px" alt="">
                    <img  class="p-2 on-e" src="{{asset('assets/site/imgs/hero-last.png')}}" height="350px" alt="">
                </div>
            </div>
        </div>
    </div>
</section>











<!-- ------------------------  services  ------------------------- -->
<!-- ------------------------  services  ------------------------- -->
<!-- ------------------------  services  ------------------------- -->
<!-- ------------------------  services  ------------------------- -->
<!-- ------------------------  services  ------------------------- -->
<!-- ------------------------  services  ------------------------- -->



<section id="services" class="py-5 my-5">
    <div class="container">

        <h2 class="serv-title"> خدماتنا </h2>
        <div class="row">
            <div class="col-md-3 col-6 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/car-wash.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            غسيل بخار خارجي
                            <br> مع تنظيف داخلي
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-md-3 col-6 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/car-polish.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            تلميع داخلي مع
                            <br> غسيل بخار خارجي
                        </p>
                    </div>
                </div>
            </div>



            <div class="col-md-3 col-6 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/car-supscribe.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            اشتراك الغسيـــل
                            <br> بالبخـار الشهــري
                        </p>
                    </div>
                </div>
            </div>



            <div class="col-md-3 col-6 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/car-gift.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            ارســال هديـة غسيــل
                            <br> بخار او تلميع لمن تحب
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->

<section id="order-method" class="py-5 my-5">
    <div class="container">
        <h2 class="order-method-title"> طريقة الطلب </h2>

        <div class="row d-flex justify-content-center">
            <div class="col-md-2 flex-column col-4 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/order-phone.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            حمل التطبيق

                        </p>
                    </div>
                </div>
            </div>


            <div class="col-md-2 flex-column col-4 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/order-calender.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            احجز موعدك

                        </p>
                    </div>
                </div>
            </div>



            <div class="col-md-2 flex-column col-4 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/order-gps.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            وصول الفنيين

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 flex-column col-4 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/order-car.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            تقديم الخدمة
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 flex-column col-4 mb-2">
                <div class="content">
                    <div class="img-div">
                        <img src="{{asset('assets/site/imgs/order-rate.png')}}" height="85px" alt="">
                    </div>

                    <div class="text">
                        <p>
                            تقييم الخدمة

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->

<section id="companies" class="py-5 ">
    <div class="container">
        <h2 class="companies-title"> الشراكات   </h2>
        <p class="text-center text-white">
            سجل بياناتك و اطلع على العروض
        </p>
        <input type="hidden">

        <div class="row">
            <div class="col-md-6">
                <form id="contact-me" action="" method="post">
                    @csrf
                    <label class="mb-2  mt-4 text-white" for="com-name"> إسم الشركة &nbsp; :   </label>
                    <input class="form-control" type="text" placeholder="" name="name">

                    <label class="mb-2  mt-4 text-white" for="com-name"> رقم الجوال   &nbsp; :   </label>
                    <input class="form-control" type="number" placeholder=""name="phone">

                    <label class="mb-2  mt-4 text-white" for="com-name" style="text-align:right"> البريد الإلكتروني   &nbsp; :   </label>
                    <input class="form-control" type="email" placeholder="" name="email">

                    <label class="mb-2  mt-4 text-white" for="com-name"> الوصف   &nbsp; :   </label>
                    <input class="form-control" type="text"  style="height: 120px" name="discription">


                    <div class="w-100  py-3 d-flex align-items-center justify-content-end">
                        <button class=" btn btn-sub"> إرسال </button>
                    </div>

                </form>
            </div>

            <div class="col-md-6">
                <div class="car">
                    <img src="{{asset('assets/site/imgs/comp-car.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>











<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->


<footer id="footer" class="py-4">
    <div class="container" id="contact-us">
        <div class="row d-flex align-items-center">
            <div class="col-sm-6 mb-2 mb-md-0 d-flex justify-content-md-start justify-content-center">
                <div class="content">
                    <div class="icons">


                        <a href="{{$facebook->link??''}}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>

                        <a href="{{$twitter->link??''}}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="{{$snapchat->link??''}}" target="_blank"><i class="fa-brands fa-snapchat"></i></a>
                        <a href="{{$instagram->link??''}}" target="_blank"><i class="fa-brands fa-instagram "></i></a>
                    </div>
                    <p class="tele">
                        <a href="">{{$phone->link??''}}</a>

                        <i class="fa-solid ps-2 fa-phone"></i>
                    </p>
                </div>
            </div>

            <div class="col-sm-6 mb-2 mb-md-0 d-flex justify-content-md-end justify-content-center">
                <div class="content">


                    <p class="tele">
                        Riyadh , Saudi arabia
                        <i class="fa-solid ps-2 fa-location-arrow"></i>
                    </p>
                    <p class="tele">
                        {{$envelope->link}}
                        <i class="fa-solid ps-2 fa-envelope"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>















<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->
<!-- ------------------------  navbar  ------------------------- -->



<!-- juery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/site/js/jquery.min.js')}}"></script>
<!-- bootstrap -->
<script src="{{asset('assets/site/js/bootstrap.min.js')}}"></script>
<!-- file upload -->
<script src="{{asset('assets/site/js/dropify.min.js')}}"></script>
<!-- select plugin -->
<script src="{{asset('assets/site/js/jquery.nice-select.min.js')}}"></script>
<!-- custom js -->
<script src="{{asset('assets/site/js/swiper-bundle.min.js')}}"></script>
<!-- custom js -->
<script src="{{asset('assets/site/js/main.js')}}"></script>
<script>


    $('#contact-me').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{route('admin.ContactMail.store')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {

                if (res['status'] == true) {
                    swal("  ", "تم ارسال الطلب بنجاح", "success", {button: "حسناً",});

                } else if (res['status'] == 'erorr') {
                    swal("    ", "  يرجي التاكد من البيانات", "warning", {button: "حسناً",});

                }
                else
                    swal("    ", "  يرجي التاكد من البيانات", "warning", {button: "حسناً",});

            },
            error: function (data) {
                swal("    ", "      لاحقا ", "warning", {button: "حسناً",});
            }
        });
    }));



</script>


</body>

</html>
