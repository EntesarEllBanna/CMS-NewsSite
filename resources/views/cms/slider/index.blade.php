@extends("cms._layout")

@section("title")
ادارة الشرائح 
@endsection()


@section("content")

<div class="row">
    <div class="col-sm-10">
        <form method="get" action="/cms/slider" class="row">
            <div class="col-sm-4">
                <input autofocus value="{{$q}}" name="q" type="text" class="form-control" placeholder="بحث عن العنوان...">
            </div>
            <div class="col-sm-3">
                <select name="active" class="form-control">
                    <option value="">جميع الحالات</option>
                    <option {{$active==1?"selected":""}} value="1">فعال</option>
                    <option {{$active===0?"selected":""}} value="0">غير فعال</option>
                </select>
            </div>
            
            <div class="col-sm-2">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="col-sm-2 text-right"><a class="btn btn-success" href="/cms/slider/create"><i class="fa fa-plus"></i> اضافة شريحة جديد</a></div>
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
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $a)
        <tr>
            <td>{{$a->title}}</td>
        
            <td>{{$a->created_at}}</td>
            <td><input type="checkbox" disabled {{$a->active?"checked":""}} /></td>
            <td class="text-right">
                <a href="/cms/slider/{{$a->id}}/edit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="/cms/slider/{{$a->id}}/delete" class="btn Confirm btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        @endforeach()
    </tbody>
</table>
@endif
{{$items->links()}}
@endsection()