@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')



@endsection

@section('content')

            <!-- breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item active"> <a href="{{route('admin.AppSettingFaq')}}"> الأسئلة المتكررة </a> </li>
                </ol>
                <a href="{{route('admin.AppSettingFaq.creat')}}" class="btn mainBtn"> اضافة جديد   <i class="fas fa-plus-circle ms-2"></i> </a>
            </div>
            <!-- end breadcrumb -->
            <!--packages  -->
            @include('admin.alerts.success')
            @include('admin.alerts.errors')
            <section class="packages">
                <!-- singlePackage -->
                @isset($AppSettingFaqs)
                    @foreach($AppSettingFaqs as $AppSettingFaq)
                <div class="singlePackage">



                        <div class="row">
                                <div class="col p-2">

                            <div class="packageData text-start">
                                <h6 class="title"> {{$AppSettingFaq->ar_title}}  </h6>
                                <p>{{$AppSettingFaq->ar_content }}</p>
                            </div>
                        </div>
                        <div class="col p-2">
                            <div class="packageData text-start">
                                <h6 class="title">   {{$AppSettingFaq->en_title}}</h6>
                                <p> this site work all days of the week {{$AppSettingFaq->en_content}} </p>
                            </div>
                        </div>
                        <div class="col p-2">
                            <div class="actions flex-row ms-auto">

                                <a href="{{route('admin.AppSettingFaq.edit',$AppSettingFaq->id)}}" class="btn edit"> تعديل </a>
                                <a href="{{route('admin.AppSettingFaq.delete',$AppSettingFaq->id)}}" class="btn delete"> حذف </a>
                            </div>
                        </div>

                    </div>

                </div>
                @endforeach
                @endisset
            </section>



                @endsection
                @section('js')


@endsection

