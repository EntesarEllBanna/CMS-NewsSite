@extends("cms._layout")

@section("title")
اضافة  شريحة جديدة
@endsection()


@section("content")

<div class="row">
    <div class="col-sm-8">
        <form enctype="multipart/form-data" method="post" action="/cms/slider" class="form-horizontal">
            {{csrf_field()}}
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label"> العنوان</label>
            <div class="col-sm-10">
              <input autofocus value="{{old("title")}}" type="text" class="form-control" id="title" name="title" placeholder="ادخل العنوان">
            </div>
          </div>            
            <div class="form-group">
            <label for="url" class="col-sm-2 control-label"> الرابط</label>
            <div class="col-sm-10">
              <input value="{{old("url")}}" type="text" class="form-control" id="url" name="url" placeholder="ادخل الرابط">
            </div>
          </div>      
          <div class="form-group">
            <label for="details" class="col-sm-2 control-label"> الملخص</label>
            <div class="col-sm-10">
                <textarea id="summary" rows="3" class="form-control" placeholder="أدخل الملخص" name="summary">{{old("summary")}}</textarea>
            </div>
          </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input  {{old("active")?"checked":""}} name="active" type="checkbox"> فعال
                </label>
              </div>
            </div>
          </div>
            
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input  {{old("newwindow")?"checked":""}} name="newwindow" type="checkbox"> نافذة جديد
                </label>
              </div>
            </div>
          </div>
            
            
          <div class="form-group">
            <label for="image" class="col-sm-2 control-label"> الصورة</label>
            <div class="col-sm-10">
                <input type="file" name="image" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">اضافة</button>
                <a href="/cms/slider" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
        </form>
    </div>
</div>
@endsection()