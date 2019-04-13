@extends("_layout")

@section("title")
Create New Account
@endsection

@section("content")

<div class="row">
    <div class="col-sm-8">
        <form method="post" action="/accounteq" class="form-horizontal">
            {{csrf_field()}}
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input autofocus value="{{old("email")}}" type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
            </div>
          </div>
          <div class="form-group">
            <label for="fullname" class="col-sm-2 control-label">Full Name</label>
            <div class="col-sm-10">
              <input value="{{old("fullname")}}" type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Full Name">
            </div>
          </div>
            
          <div class="form-group">
            <label for="country" class="col-sm-2 control-label">Country</label>
            <div class="col-sm-10">
                <select name="country" id="country" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $c)
                    <option {{old("country")==$c->id?"selected":""}} value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
            </div>
          </div>
            
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>
            <div class="col-sm-10">
                <div class="radio">
                <label>
                  <input value="M" name="gender" {{old("gender")=="M"?"checked":""}} type="radio"> Male
                </label>
                
                <label>
                  <input value="F" name="gender" {{old("gender")=="F"?"checked":""}} type="radio"> Female
                </label>
                </div>
            </div>
          </div>
            
            
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input  {{old("active")?"checked":""}} name="active" type="checkbox"> Active
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Create</button>
                <a href="/accounteq" class="btn btn-default">Cancel</a>
            </div>
          </div>
        </form>
    </div>
</div>

@endsection()