@extends("_layout")
@section("title")
Search Accounts
@endsection()


@section("content")
<div class="row">
    <div class="col-sm-6">
        <form method="get" action="/accounteq/search" class="input-group">
          <input autofocus value="{{$q}}" name="q" type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">Go!</button>
          </span>
        </form>
    </div>
    <div class="col-sm-6 text-right"><a class="btn btn-success" href="/accounteq/create">Create New Account</a></div>
</div>

<hr>
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
@endsection()