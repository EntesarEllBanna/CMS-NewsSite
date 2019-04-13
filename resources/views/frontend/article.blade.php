@extends("_felayout")
@section("title")
{{$item->title}}
@endsection()
@section("content")
<ol class="breadcrumb">
  <li><a href="/">الرئيسية</a></li>
  <li><a href="/articles">الاخبار</a></li>
  <li><a href="/articles?id={{$item->category_id}}">{{$category}}</a></li>
  <li class="active">{{$item->title}}</li>
</ol>
<h1 class="page-header">{{$item->title}} <small>{{date('d-m-Y', strtotime($item->created_at))}}</small></h1>
<div class="row">
    <div class="col-sm-8 text-justify">
        {!!str_replace("\n","<br/>",$item->details)!!}
    </div>
    <div class="col-sm-4">
        <img src="/thumb.php?src=./uploads/{{$item->image}}&size=600x500" alt="{{$item->title}}" class="img-responsive img-thumbnail" />
    </div>
</div>
@if(count($articles)>0)

<h1 class="page-header">اقرأ ايضا</h1>
<div class="row">
    @foreach($articles as $s)
    <div class="col-md-3 col-sm-6">
        <div class="img-thumbnail">
            
            <a class="" href="/article/{{$s->id}}">
                <img class="img-responsive" src="/thumb.php?src=./uploads/{{$s->image}}&size=400x250" />
                 <h5>
                    <b>
                        {{$s->title}}
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
@endif()
<h2 class="page-header">التعليقات</h2>
<div class="row">
    <div class="col-sm-8">
        <form  method="post" action="/cms/comment/{{$item->id}}/addtoall" class="form-horizontal">
            {{csrf_field()}}
            
             <div class=" raw">
                 
            <div class="col-sm-8">
                <textarea id="details" rows="2" class="form-control" placeholder="أدخل التعليق " name="details">{{old("details")}} </textarea> 
                 </div>
                
                
            <div class=" col-sm-2">
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>  اضافه التعليق</button>
               <br><br> 
            </div>
                 
             <div class=" col-sm-2">
        
               <a href="/cms/comment/{{$item->id}}/all" class="btn btn-info ">
                <i class="fa fa-tv"></i>عرض كافه التعليقات
          </a>
            </div>
                 
          </div>
            <br><br>
          
        </form>
        <br><br>
      
        
          </div></div> 
@endsection()