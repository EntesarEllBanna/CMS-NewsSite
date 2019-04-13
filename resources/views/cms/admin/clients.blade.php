@extends("cms._layout")



@section("content")
<h2> اداره الزائرين</h2>
<br>
<form class="row">
    <div class="col-sm-4">
      <input value="{{$q}}" type="text" autofocus name="q" placeholder=" ابحث باسم الزائر  او بريده الالكتروني " class="form-control" />
    </div>
    <div class="col-sm-2">
        <select class="form-control" name="is_active">
            <option value="">جميع الحالات({{$items->count()}})</option>
            <option {{$active=="1"?"selected":""}} value="1">فعال</option>
            <option {{$active=="0"?"selected":""}} value="0">غير فعال</option>
        </select>
    </div>
    
    <div class="col-sm-2">
      <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> بحث</button>
   
    
    </div>
    
   

</form> 
<br>

@if($items->count()>0)
<table class="table table-striped table-hover">
    <thead>
        <tr><th>اسم الزائر </th><th>البريد الالكتروني</th><th width="12%">فعال؟</th><th width="20%">تاريخ الانشاء</th>
            
        </tr>
    </thead>
    <tbody>
        
        @foreach($items as $i)
        <tr>
            <td>{{$i->name}}</td>
            <td>{{$i->email}}</td>
            <td><input class="cbActive" value="{{$i->id}}" type="checkbox" 
                       {{$i->is_active?"checked":""}} /></td>
            <td>{{$i->created_at}}</td>
            <td class="text-right"><a href="/cms/clients/{{$i->id}}/delete"   class="btn Confirm btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
{{$items->links()}}
@else
<br><br>
<div class="alert alert-warning">لا يوجد بيانات لعرضها </div>
@endif
@endsection


   @section("js")
<script>
    $(function(){
        $(".cbActive").click(function(){
            var id=$(this).val();
            $.get("/cms/clients/active/"+id,function(json){
                ShowMessage(json.msg,"ادارة الزائرين");
            },"json");
        });
    });

 $(function(){
                //$("#Confirm").modal("show");
                $(document).on("click",".Confirm",function(){
                    $("#Confirm").modal("show");
                    $("#Confirm .btn-danger").attr("href",$(this).attr("href"));
                    return false;
                });
            });
</script>

@endsection


