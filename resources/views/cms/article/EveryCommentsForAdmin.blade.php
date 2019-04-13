@extends("cms._layout")




@section("content")
<h2>  اداره تعليقات {{$article->title}}</h2>
<br>
<form class="row">
    <div class="col-sm-4">
      <input value="{{$q}}" type="text" autofocus name="q" placeholder=" ابحث باسم المعلق او جزء من تعليقه " class="form-control" />
    </div>
    <div class="col-sm-2">
        <select class="form-control" name="active">
            <option value="">جميع الحالات({{$comment->count()}})</option>
            <option {{$active=="1"?"selected":""}} value="1">فعال</option>
            <option {{$active=="0"?"selected":""}} value="0">غير فعال</option>
        </select>
    </div>
    
    <div class="col-sm-2">
      <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> بحث</button>
   
    
    </div>
    
    <div class="col-sm-4">
      <a class="btn btn-info" href="/article/{{$article->id}}">لاضافه تعليقك اسفل الخبر السابق</a>
        <a class="btn btn-default" href="/cms/article">رجوع</a>
   
    
    </div>

</form> 

@if($comment->count()>0)
<br><br>

     @foreach($comment as $c)

    <div class="raw">
  <div class="col-sm-2">
           @if($c->client_id!=null)
    <h2><strong> {{$c->client->name}}</strong></h2>
      
         @elseif($c->client_id==null)
      <h2><strong> {{$c->admin->fullname}}</strong></h2>
             @endif
        </div>
   <?php 
        if(isset($admin)){
if($c->admin_id!=null && $admin->isdelete==0 && $admin->active==1){
        $adminId=$admin->id;
        $adminId2=$c->admin_id;
        if($adminId==$adminId2){
        ?>
<div class="col-sm-2">
    <a href="/cms/comment/{{$c->comments_id}}/edit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
     <a href="/cms/comment/{{$c->comments_id}}/delete" class="btn Confirm btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
</div>
        <?php 
        }}}
        ?>
      
       
      <div class=" co-sm-4">
      
      <h5> {{$c->details}}  </h5><br>
     <h5 class="address"> <i class="glyphicon glyphicon-calendar "></i> {{date('d-m-Y', strtotime($c->created_at))}}  <input class="cbActive" value="{{$c->id}}" type="checkbox" 
                       {{$c->isactive?"checked":""}} /></h5>
                 

    
      </div>

       <div class=" co-sm-1">
      
                <br>
        </div>


    
        
      <hr>
        
        
</div>
      @endforeach
   
    
  <br>
  {{$comment->links()}}
  @else
  <div class="alert alert-warning">لا يوجد بيانات لعرضها </div>
  @endif
@endsection

@section("js")
  <script>
      $(document).ready(function () { 
          $(".longString").each(function () {
              var maxwidth = 8;
              if ($(this).text().length > maxwidth) {
                  $(this).text($(this).text().substring(0, maxwidth));
                  $(this).html($(this).html() + '...');
              }
          });
      });
      
      $(function(){
        $(".cbActive").click(function(){
            var id=$(this).val();
            $.get("/admin/admin/active/"+id,function(json){
                ShowMessage(json.msg,"ادارة المستخدمين");
            },"json");
        });
    });
  </script>
endsection

