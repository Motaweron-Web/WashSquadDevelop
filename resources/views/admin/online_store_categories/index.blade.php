@extends('admin.layouts.inc.app')
@section('class')
@endsection
@section('style')

    {{--<style>--}}

    {{--  .w-5{--}}
    {{--      display: none;--}}
    {{--  }--}}






    </style>

@endsection

@section('content')

    <!-- breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item active"> <a href="{{route('admin.OnlineStoreCategories')}}"> التصنيفات</a>
            </li>
        </ol>
        <a href="{{route('admin.OnlineStoreCategories.creat')}}" class="btn mainBtn"> اضافة تصنيف <i
                    class="fas fa-plus-circle ms-2"></i> </a>
    </div>
    <!-- end breadcrumb -->
    <!-- drivers -->
    @include('admin.alerts.success')
    @include('admin.alerts.errors')
    <class="drivers ">
    <!-- table -->
    <class="table-responsive mb-0 rounded" data-pattern="priority-columns">
    <table id="datatable" class="table dt-responsive table-striped nowrap">
        <thead>
        <tr>
            <th> # </th>
            <th> اسم التصنيف </th>
            <th> عدد المنتجات </th>
            <th> </th>
        </tr>
        </thead>

        <tbody>
        @isset($OnlineStoreCategories)
            @foreach($OnlineStoreCategories as $OnlineStoreCategorie)
                <tr class="serv-border">
                    <td> {{$OnlineStoreCategorie ->id }}</td>
                    <td> {{$OnlineStoreCategorie ->title_ar }}  </td>
                    <td>{{count($OnlineStoreCategorie -> products)}}</td>
                    <td>
                        <div class="actionsIcons">
                            <a href="{{route('admin.OnlineStoreCategories.edit',$OnlineStoreCategorie->id)}}" class="edit"> <i class="fas fa-edit"></i> </a>
                            <a href="{{route('admin.OnlineStoreCategories.delete',$OnlineStoreCategorie->id)}}" class="delete"> <i class="fas fa-trash-alt"></i> </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endisset
        </tbody>

    </table>

    {{$OnlineStoreCategories ->onEachSide(1)-> links()}}

    {{--                        <nav class="d-flex justify-content-end">--}}
    {{--                <ul class="pagination">--}}
    {{--                    <li class="page-item">--}}
    {{--                        <a class="page-link" href="#" aria-label="Previous">--}}
    {{--                            <span aria-hidden="true">&laquo;</span>--}}
    {{--                        </a>--}}
    {{--                    </li>--}}
    {{--                    <li class="page-item" id="paginatetable"><a class="page-link active" href="#">1 </a></li>--}}

    {{--                        <a class="page-link" href="#" aria-label="Next">--}}
    {{--                            <span aria-hidden="true">&raquo;</span>--}}
    {{--                        </a>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </nav>--}}

    </div>
    </section>
    <!-- End drivers -->
@endsection
@section('js')


@endsection
