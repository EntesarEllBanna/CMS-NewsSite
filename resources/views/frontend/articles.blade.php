@extends("_felayout")
@section("title")
الاخبار 
@endsection()
@section("content")
<ol class="breadcrumb">
  <li><a href="/">الرئيسية</a></li>
  <li class="active">الاخبار</li>
</ol>
<h1>الاخبار</h1>




<div class="row">
    <div class="col-sm-12">
        <form method="get" action="/articles" class="row">
            <div class="col-sm-4">
                <input autofocus value="{{$q}}" name="q" type="text" class="form-control" placeholder="بحث عن تصنيف...">
            </div>
            <div class="col-sm-3">
                <select name="id" class="form-control">
                    <option value="">جميع التصنيفات</option>
                    @foreach($categorylist as $c)
                        <option {{$id==$c->id?"selected":""}} value="{{$c->id}}">{{$c->title}}</option>
                    @endforeach()
                </select>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary" type="submit"><i class="glyphicon  glyphicon-search"></i> بحث</button>
            </div>
        </form>
    </div>
</div>

<hr>
@if(count($items)==0)
<div class="alert alert-warning">
    نأسف, لايوجد نتائج لعرضها 
</div>
@else

<div class="row">
    @foreach($items as $item)
    <div class="col-md-3 col-sm-6">
        <div class="img-thumbnail">
            
            <a class="" href="/article/{{$item->id}}">
                <img class="img-responsive" src="/thumb.php?src=./uploads/{{$item->image}}&size=400x250" />
                 <h5>
                    <b>
                        {{$item->title}}
                    </b>
                </h5>

            </a>
            
                <i class="glyphicon glyphicon-calendar "></i>
                {{date('d-m-Y', strtotime($item->created_at))}}
        </div>
        <br><br>
    </div>
    @endforeach
</div>
@endif
{{$items->links()}}

@endsection()