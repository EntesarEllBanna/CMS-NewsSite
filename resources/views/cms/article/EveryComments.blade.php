@extends("_felayout")


@section("content")
<h2>
التعليقات على  {{$article->title}} 
</h2>
<br><br>
  <form class="row">
      
    <div class="col-sm-4">
  <input autofocus value="{{$q}}" class="form-control" type="text" name="q" placeholder="بحث باسم المعلق او جزء من تعليقه">
    </div>
      
    <div class="col-sm-2">
      <button class="btn btn-primary" type="submit">
        <i class="glyphicon glyphicon-search"></i>بحث
      </button>
    </div>
      <a class="btn btn-info" href="/article/{{$article->id}}">لاضافه تعليقك اسفل الخبر السابق</a>
      <a class="btn btn-default" href="/article/{{$article->id}}">رجوع</a>
   

  </form>
  <br>
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
        
        <?php 
       if(isset($client)){
                if($c->admin_id==null && $client->isdelete==0 &&  $client->is_active==1){
        $clientId=$client->id;
        $clientId2=$c->client_id;
        if($clientId==$clientId2){
                ?>
              
        <div class="col-sm-2">
    <a href="/cms/comment/{{$c->comments_id}}/edit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
     <a href="/cms/comment/{{$c->comments_id}}/delete" class="btn Confirm btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
</div>    
                
          <?php   
        }}}
        ?>
      
        
       
      <div class=" co-sm-6">
      
      <h5> {{$c->details}}  </h5><br>
     <h5 class="address"> <i class="glyphicon glyphicon-calendar "></i>{{date('d-m-Y', strtotime($c->created_at))}}</h5>
                <br><br>

    
      <hr></div>
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
  </script>
endsection

