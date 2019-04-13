@extends("cms._layout")

@section("title")
تعديل مستخدم 
@endsection()


@section("content")
<div class="row">
    <div class="col-sm-8">
        <form method="post" action="/cms/admin/{{$item->id}}" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="patch" />
  <div class="form-group">
    <label for="fullname" class="col-sm-2 control-label">اسم المستحدم</label>
    <div class="col-sm-6">
      <input type="fullname" value="{{$item->fullname}}"  class="form-control" name="fullname" id="fullname" placeholder="اسم المستخدم">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">الايميل</label>
    <div class="col-sm-6">
      <input type="email" readonly value="{{$item->email}}" class="form-control" name="email" id="email" placeholder="الايميل">
    </div>
  </div>
            
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">كلمة المرور</label>
    <div class="col-sm-6">
      <input type="password" class="form-control" name="password" id="password" placeholder="لاعادة كلمة المرور اكتب كلمة جديدة">
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
      <a href="/cms/admin" class="btn btn-default">الغاء الأمر</a>
    </div>
  </div>
</form>
    </div>
</div>
@endsection()