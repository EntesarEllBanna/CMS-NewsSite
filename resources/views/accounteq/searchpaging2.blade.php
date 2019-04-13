@extends("_layout")
@section("title")
Advanced Search Paging Accounts
@endsection()


@section("content")
<div class="row">
    <div class="col-sm-10">
        <form method="get" action="/accounteq/searchpaging2" class="row">
            <div class="col-sm-3">
                <input autofocus value="{{$q}}" name="q" type="text" class="form-control" placeholder="Search for...">
            </div>
          <div class="col-sm-2">
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option {{$status==1?"selected":""}} value="1">Active</option>
                    <option {{$status===0?"selected":""}} value="0">Inactive</option>
                </select>
            </div>
            <div class="col-sm-2">
                <select name="gender" class="form-control">
                    <option value="">All Gender</option>
                    <option {{$gender=="M"?"selected":""}} value="M">Male</option>
                    <option {{$gender=="F"?"selected":""}} value="F">Female</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="country" class="form-control">
                    <option value="">All Country</option>
                    @foreach($countries as $c)
                        <option {{$country==$c->id?"selected":""}} value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach()
                </select>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary" type="submit">Go!</button>
            </div>
        </form>
    </div>
    <div class="col-sm-2 text-right"><a class="btn btn-success" href="/accounteq/create">Create New Account</a></div>
</div>

<hr>
@if(count($accounts)==0)
<div class="alert alert-warning">
    Sorry, there is no results to display.
</div>
@else
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Active</th>
            <th>Country</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($accounts as $a)
        <tr>
            <td>{{$a->id}}</td>
            <td>{{$a->email}}</td>
            <td>{{$a->fullname}}</td>
            <td>{{$a->gender}}</td>
            <td><input type="checkbox" disabled {{$a->active?"checked":""}} /></td>
            <td>{{$a->country->name}}</td>
            <td>
                <a href="/accounteq/{{$a->id}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-info-sign"></i></a>
                <a href="/accounteq/{{$a->id}}/edit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="/accounteq/{{$a->id}}/delete" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        @endforeach()
    </tbody>
</table>
@endif
{{$accounts->links()}}
@endsection()