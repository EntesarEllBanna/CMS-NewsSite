@extends("cms._layout")

@section("title")
تعديل  شريحة 
@endsection()


@section("content")

<div class="row">
    <div class="col-sm-8">
        <form enctype="multipart/form-data" method="post" action="/cms/slider/{{$item->id}}" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" value="put" name="_method">
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label"> العنوان</label>
            <div class="col-sm-10">
              <input autofocus value="{{$item->title}}" type="text" class="form-control" id="title" name="title" placeholder="ادخل العنوان">
            </div>
          </div>            
            <div class="form-group">
            <label for="url" class="col-sm-2 control-label"> الرابط</label>
            <div class="col-sm-10">
              <input value="{{$item->url}}" type="text" class="form-control" id="url" name="url" placeholder="ادخل الرابط">
            </div>
          </div>      
          <div class="form-group">
            <label for="details" class="col-sm-2 control-label"> الملخص</label>
            <div class="col-sm-10">
                <textarea id="summary" rows="3" class="form-control" placeholder="أدخل الملخص" name="summary">{{$item->summary}}</textarea>
            </div>
          </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input  {{$item->active?"checked":""}} name="active" type="checkbox"> فعال
                </label>
              </div>
            </div>
          </div>
            
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input  {{$item->newwindow?"checked":""}} name="newwindow" type="checkbox"> نافذة جديد
                </label>
              </div>
            </div>
          </div>
            
            
          <div class="form-group">
            <label for="image" class="col-sm-2 control-label"> الصورة</label>
            <div class="col-sm-3">
                <input type="file" name="image" />
                @if($item->image!="")
                <img src="/uploads/{{$item->image}}" class="img-responsive img-thumbnail" />
                @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="/cms/slider" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
        </form>
    </div>
</div>
@endsection()