@extends("_felayout")



@section("content")

<h2>تعديل التعليق الخاص ب{{$item->article->title}} ({{$item->client->name}}) </h2><hr><br>
<div class="row">
   
<div class="col-sm-6">
        <h3>{{$item->created_at}}</h3></div>
</div>

<div class="row">
    <div class="col-sm-8">
        <form  method="post" action="/cms/comment/{{$item->id}}" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put" />
         
          <div class="form-group">
            <label for="details" class="col-sm-2 control-label"> التعليق</label>
            <div class="col-sm-10">
                <textarea id="details" rows="10" class="form-control" placeholder="أدخل التعليق" name="details">{{$item->details}}</textarea>
            </div>
          </div>
            
        
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">تعديل</button>
                <a href="/cms/comment/{{$item->article->id}}/all" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
            
        </form>
        <br>
                       <a href="/cms/comment/{{$item->article->id}}/all" class="btn btn-default">رجوع</a>

    </div>
</div>
@endsection()