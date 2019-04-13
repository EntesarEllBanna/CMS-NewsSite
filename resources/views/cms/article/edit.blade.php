@extends("cms._layout")

@section("title")
تعديل  مقال
@endsection()


@section("content")

<div class="row">
    <div class="col-sm-8">
        <form enctype="multipart/form-data" method="post" action="/cms/article/{{$item->id}}" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put" />
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label"> العنوان</label>
            <div class="col-sm-10">
              <input autofocus value="{{$item->title}}" type="text" class="form-control" id="title" name="title" placeholder="ادخل العنوان">
            </div>
          </div>
            
            <div class="form-group">
            <label for="category_id" class="col-sm-2 control-label">التصنيف</label>
            <div class="col-sm-10">
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">اختر التصنيف</option>
                    @foreach($categorylist as $c)
                    <option {{$item->category_id==$c->id?"selected":""}} value="{{$c->id}}">{{$c->title}}</option>
                    @endforeach()
                </select>
            </div>
          </div>
        
          <div class="form-group">
            <label for="summary" class="col-sm-2 control-label"> الملخص</label>
            <div class="col-sm-10">
                <textarea id="summary" rows="3" class="form-control" placeholder="أدخل الملخص" name="summary">{{$item->summary}}</textarea>
            </div>
          </div>
            
            
            
          <div class="form-group">
            <label for="details" class="col-sm-2 control-label"> التفاصيل</label>
            <div class="col-sm-10">
                <textarea id="details" rows="10" class="form-control" placeholder="أدخل التفاصيل" name="details">{{$item->details}}</textarea>
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
              <div class="checkbox">
                <label>
                  <input  {{$item->active?"checked":""}} name="active" type="checkbox"> فعال
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">اضافة</button>
                <a href="/cms/article" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
        </form>
    </div>
</div>
@endsection()