@extends("cms._layout")

@section("title")
 
صلاحيات المستخدم
-
{{$item->fullname}}
@endsection()


@section("content")
<style>
    .permission>li{
        float: right;
        width: 25%;
        height: 160px;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <form method="post" action="/cms/admin/{{$item->id}}/setpermission" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="{{$item->id}}" />
            <?php
                $adminId=$item->id;
                $links=\DB::table("link")->where("parent_id",0)->where("active",1)->
                    selectRaw("id,title,(select count(*) from admin_link where admin_id=$adminId and link_id=link.id) as access")->get();
            ?>
            <ul class="list-unstyled permission">
            @foreach($links as $link)
            <?php
                $sublinks=\DB::table("link")->where("parent_id",$link->id)->where("active",1)->
                    selectRaw("id,title,(select count(*) from admin_link where admin_id=$adminId and link_id=link.id) as access")->get();
            ?>
                <li>
                   
                    <label><input {{$link->access==1?"checked":""}} name="link[]" type="checkbox" value="{{$link->id}}" /> 
                        
                        <b>{{$link->title}}</b></label>
                    <ul class="list-unstyled">
                         
                        @foreach($sublinks as $sublink)
                        <li>
                            <label><input {{$sublink->access==1?"checked":""}} name="link[]" type="checkbox" value="{{$sublink->id}}" /> {{$sublink->title}}</label><br>
                        </li>
                        @endforeach()
                        <br><br>
                    </ul>
                </li>
            @endforeach()
            </ul>
  <div class="form-group">
    <div class="col-sm-8">
      <button type="submit" class="btn btn-primary">حفظ</button>
      <a href="/cms/admin" class="btn btn-default">الغاء الأمر</a>
    </div>
  </div>
</form>
    </div>
</div>
@endsection()

@section("js")
<script>
    $(function(){
        $(".permission :checkbox").click(function(){
            $(this).parent().next().find(":checkbox").prop("checked",$(this).prop("checked"));
            $(this).parents("ul").each(function(){
                $(this).prev().find(":checkbox").prop("checked",$(this).find(":checked").size()>0);
            });
        });
    });
</script>
@endsection()