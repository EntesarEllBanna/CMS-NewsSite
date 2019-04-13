@extends("cms._layout")

@section("title")
الأخبار العاجلة
@endsection()


@section("content")

<div class="row">
    <div class="col-sm-10">
        <form method="get" action="/cms/breakingnews" class="row">
            <div class="col-sm-10">
                <input autofocus value="{{$q}}" name="q" type="text" class="form-control" placeholder="بحث عن الخبر...">
            </div>
           
            <div class="col-sm-2">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="col-sm-2 text-right"><a class="btn btn-success" href="/cms/breakingnews/create"><i class="fa fa-plus"></i> اضافة خير جديد</a></div>
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
            <th>الخبر العاجل</th>
            <th width="15%">الفترة</th>
            <th width="20%">تاريخ الاضافة</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $a)
        <tr>
            <td>{{$a->news}}</td>
            <td>{{$a->period}} دقيقة</td>
            <td>{{$a->created_at}}</td>
            <td class="text-right">
                <a href="/cms/breakingnews/{{$a->id}}/edit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="/cms/breakingnews/{{$a->id}}/delete" class="btn Confirm btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        @endforeach()
    </tbody>
</table>
@endif
{{$items->links()}}
@endsection()