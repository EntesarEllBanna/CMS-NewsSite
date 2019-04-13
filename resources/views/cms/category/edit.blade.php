@extends("cms._layout")

@section("title")
تعديل تصنيف مقال
@endsection()


@section("content")

<div class="row">
    <div class="col-sm-8">
        <form method="post" action="/cms/category/{{$item->id}}" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put" />
          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">ادخل التصنيف</label>
            <div class="col-sm-10">
              <input autofocus value="{{$item->title}}" type="text" class="form-control" id="title" name="title" placeholder="ادخل التصنيف">
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
              <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="/cms/category" class="btn btn-default">الغاء الأمر</a>
            </div>
          </div>
        </form>
    </div>
</div>
@endsection()