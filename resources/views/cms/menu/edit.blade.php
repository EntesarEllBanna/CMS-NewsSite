@extends("cms._layout")

@section("title")
تعديل  قائمة جديدة
@if($mTitle!="")
- {{$mTitle}}
@endif
@endsection()


@section("content")

<div class="row">
    <div class="col-sm-8">
        <form method="post" action="/cms/menu/{{$item->id}}" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="patch" />
            <input type="hidden" name="parent_id" value="{{$item->parent_id}}" />
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
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">اضافة</button>
                <a href="/cms/menu/{{$item->parent_id}}" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
        </form>
    </div>
</div>
@endsection()