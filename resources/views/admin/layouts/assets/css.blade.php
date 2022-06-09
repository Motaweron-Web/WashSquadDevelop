<meta charset="utf-8" />
<title>WashSquad</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesdesign" name="author" />
<!-- App favicon -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{url('assets/admin')}}/images/favicon.ico">

<!-- Bootstrap Css  -->
<link href="{{url('assets/admin')}}/css/bootstrap-rtl.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{url('assets/admin')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{url('assets/admin')}}/css/app-rtl.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/admin/css/toastr.min.css')}}" rel="stylesheet">

@yield('css')
