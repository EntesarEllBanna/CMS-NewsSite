@extends("cms._layout")

@section("title")
ادارة القائمة الرئيسية 
@if($mTitle!="")
- {{$mTitle}}
@endif
@endsection()


@section("content")

<div class="row">
    <div class="col-sm-10">
        @if($id>0)
        <a href="/cms/menu" class="btn btn-default">عودة</a>
        @endif
    </div>
    <div class="col-sm-2 text-right"><a class="btn btn-success" href="/cms/menu/create/{{$id}}"><i class="fa fa-plus"></i> اضافة قائمة جديد</a></div>
</div>

<hr>
@if(count($items)==0)
<div class="alert alert-warning">
    نأسف, لايوجد نتائج لعرضها 
</div>
@else
<table class="table table-hover">
    <thead>
        <tr>
            <th>العنوان</th>
          
            <th width="20%">تاريخ الاضافة</th>
            <th width="10%">فعال؟</th>
            <th width="10%">نافذة جديدة</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $a)
        <tr>
            <td>{{$a->title}}</td>
        
            <td>{{$a->created_at}}</td>
            <td><input type="checkbox" disabled {{$a->active?"checked":""}} /></td>
            <td><input type="checkbox" disabled {{$a->newwindow?"checked":""}} /></td>
            <td class="text-right">
                @if($id==0)
                <a href="/cms/menu/{{$a->id}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-list"></i></a>
                @endif
                <a href="/cms/menu/{{$a->id}}/edit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="/cms/menu/{{$a->id}}/delete" class="btn Confirm btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        @endforeach()
    </tbody>
</table>
@endif
@endsection()