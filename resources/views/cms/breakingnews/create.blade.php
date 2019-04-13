@extends("cms._layout")

@section("title")
اضافة خبر عاجل جديد
@endsection()


@section("content")
<div class="row">
    <div class="col-sm-8">
        <form method="post" action="/cms/breakingnews" class="form-horizontal">
            {{csrf_field()}}
  <div class="form-group">
    <label for="news" class="col-sm-2 control-label">الخبر</label>
    <div class="col-sm-6">
      <input type="news" value="{{old("news")}}"  class="form-control" name="news" id="news" placeholder="الخبر">
    </div>
  </div>
  <div class="form-group">
    <label for="period" class="col-sm-2 control-label">الفترة</label>
    <div class="col-sm-3">
      <input type="number" min="1" max="200" value="{{old("period")}}" class="form-control" name="period" id="period" placeholder="الفترة">
    </div> 
      <div class="col-sm-2">دقيقة</div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">إضافة</button>
      <a href="/cms/breakingnews" class="btn btn-default">الغاء الأمر</a>
    </div>
  </div>
</form>
    </div>
</div>
@endsection()