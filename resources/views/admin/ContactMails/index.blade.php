
@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')


@endsection

@section('content')

    <div class="d-flex flex-wrap justify-content-end mb-3">
        <div class="p-2">
            <select class="form-select shadow-lg" id="changeFilter">
                <option value="" disabled selected>إختر</option>
                <option value="today" {{$request->filter=='today'?'selected':''}}>Today </option>
                <option value="thisWeek" {{$request->filter=='thisWeek'?'selected':''}}>This week</option>
                <option value="lastWeek" {{$request->filter=='lastWeek'?'selected':''}}>Last week</option>
                <option value="lastMonth" {{$request->filter=='lastMonth'?'selected':''}}>Last month</option>
                <option value="thisMonth" {{$request->filter=='thisMonth'?'selected':''}}>This month</option>
                <option value="lastYear" {{$request->filter=='lastYear'?'selected':''}}>Last year</option>
                <option value="thisYear" {{$request->filter=='thisYear'?'selected':''}}>This year</option>
            </select>
        </div>
        <div class="p-2">
            <input type="month" class="form-control"  id="choseMonth" value="{{$request->month}}">

        </div>

    </div>


    <!------------------------------------------------------------------>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.alerts.success')
                    @include('admin.alerts.errors')
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 text-center">
                            <thead>
                            <tr>
                                <th scope="col"> تاريخ الارسال </th>
                                <th scope="col"> اسم الشركة </th>
                                <th scope="col"> رقم الجوال </th>
                                <th scope="col"> البريد الالكترونى </th>
                                <th scope="col"> النص </th>
                                <th scope="col"> حذف </th>


                            </tr>
                            </thead>

                            <tbody>

                            @isset($ContactMails)

                                @foreach($ContactMails as $ContactMail)
                            <tr>
                                <td>
                                    {{$ContactMail-> date}}
                                </td>
                                <td>
                                    {{$ContactMail->name}}
                                </td>
                                <td>{{$ContactMail->phone}}</td>
                                <td>{{$ContactMail->email}}</td>
                                <td>{{$ContactMail->discription}}</td>
                                <td>
                                    <div class="col p-2">
                                        <div class="actionsIcons">
                                            <a href="{{route('admin.ContactMail.delete',$ContactMail->id)}}" class="delete"> <i class="fas fa-trash-alt"></i> </a>
                                        </div>
                                </td>

                            </tr>
                            @endforeach
                            @endisset
                            </tbody>

                        </table>

                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        {{$ContactMails->onEachSide(1)->links()}}
        <!-- end col -->
    </div>

</section>

    <!-- navigation -->
{{--    <nav class="d-flex justify-content-end">--}}
{{--        <ul class="pagination">--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="#" aria-label="Previous">--}}
{{--                    <span aria-hidden="true">&laquo;</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="page-item"><a class="page-link active" href="#">1</a></li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">4</a></li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">5</a></li>--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="#" aria-label="Next">--}}
{{--                    <span aria-hidden="true">&raquo;</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </nav>--}}

@endsection
@section('js')
    <script>


        $('#changeFilter').on('change',function(){
            var val = $(this).val();
            var myUrl = "{{route('admin.ContactMail')}}?month={{date('Y-m')}}&type=filter&filter="+val
            window.location = myUrl
        });
        $('#choseMonth').on('keyup keydown change', function(){
            var val = $(this).val();
            var myUrl = "{{route('admin.ContactMail')}}?month="+val+"&type=month";
            window.location = myUrl
        });
    </script>

@endsection

