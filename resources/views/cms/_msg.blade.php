 @if(\Session::get("msg")!=NULL)
<?php
    $class="info";
    $msg=\Session::get("msg");
    if(strpos($msg,"s:")===0){
        $class="success";
        $msg=substr($msg,2);
    } 
    else if(strpos($msg,"e:")===0){
        $class="danger";
        $msg=substr($msg,2);
    }
    else if(strpos($msg,"w:")===0){
        $class="warning";
        $msg=substr($msg,2);
    }
    else if(strpos($msg,"i:")===0){
        $class="info";
        $msg=substr($msg,2);
    }
?>
    <div class="alert alert-{{$class}} alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{$msg}}
    </div>
@endif


 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif