@extends("_felayout")
@section("title")
{{$item->title}}
@endsection()
@section("content")
<ol class="breadcrumb">
  <li><a href="/">الرئيسية</a></li>
  <li class="active">{{$item->title}}</li>
</ol>
<h1 class="page-header">{{$item->title}}</h1>
<div class="row">
    <div class="col-sm-8 text-justify">
        {!!str_replace("\n","<br/>",$item->details)!!}
    </div>
    <div class="col-sm-4">
        <img src="/thumb.php?src=./uploads/{{$item->image}}&size=600x500" alt="{{$item->title}}" class="img-responsive img-thumbnail" />
    </div>
</div>

@endsection()