@extends("cms._layout")

@section("title")
أضافة مستخدم جديد
@endsection()


@section("content")
<div class="row">
    <div class="col-sm-8">
        <form method="post" action="/cms/admin" class="form-horizontal">
            {{csrf_field()}}
  <div class="form-group">
    <label for="fullname" class="col-sm-2 control-label">اسم المستحدم</label>
    <div class="col-sm-6">
      <input type="fullname" value="{{old("fullname")}}"  class="form-control" name="fullname" id="fullname" placeholder="اسم المستخدم">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">الايميل</label>
    <div class="col-sm-6">
      <input type="email" value="{{old("email")}}" class="form-control" name="email" id="email" placeholder="الايميل">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">كلمة المرور</label>
    <div class="col-sm-6">
      <input type="password" value="{{old("password")}}" class="form-control" name="password" id="password" placeholder="كلمة المرور">
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
      <button type="submit" class="btn btn-primary">إضافة</button>
      <a href="/cms/admin" class="btn btn-default">الغاء الأمر</a>
    </div>
  </div>
</form>
    </div>
</div>
@endsection()