<?php
    $url = Request::url();
    $breakingnews=\DB::table("breakingnews")->whereRaw("isdelete=0 and expiredate>sysdate() order by id desc limit 3")->get();
//var_dump ($breakingnews);die();
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/bootstrap/favicon.ico">

    <title>@yield("title") | الموقع الاخباري</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="/bootstrap-rtl-master/dist/css/bootstrap-rtl.min.css" rel="stylesheet"/>
      
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
      <link href="/nprogress-master/nprogress.css" rel="stylesheet" type="text/css" />
        <link href="/metronic-rtl/assets/global/plugins/bootstrap-toastr/toastr-rtl.min.css" rel="stylesheet" type="text/css" />
       
      <style>
        body,h1,h2,h3,h4,h5,h6,.dropdown-menu{
            font-family: 'Cairo', sans-serif;
        }
      </style>
    @yield("css")
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">الموقع الاخباري</a>
             @if (Auth::guest())
            <a class="navbar-brand" href="{{ route('login') }}">تسجيل الدخول</a>
                        <a class="navbar-brand" href="/newregister">انشاء حساب جديد</a>
            @else
            
            <?php
                     
        $user = \Auth::user();
        if($user!=NULL){
            $isAdmin=\DB::table("admin")->where("user_id",$user->id)->count();
            $isClient=\DB::table("clients")->where("user_id",$user->id)->count();
            if($isAdmin)
                $wordForUrl="home";
            else 
                $wordForUrl="client";
               }
            
         ?>
            
            
          <ul class="nav navbar-nav  " align="left">
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle navbar-brand" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                {{Auth::user()->name}}
                                <span class="username username-hide-on-mobile">
<!--                                     -->
                                </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="/{{$wordForUrl}}/changepassword">
                                        <i class="icon-user"></i> تغيير كلمة المرور </a>
                                </li>
                               
                              
                                @if($wordForUrl=="home")
                                <li class="divider"> </li>
                                <li>
                                    <a href="/cms/{{$wordForUrl}}">
                                        <i class="icon-user"></i>  اعدادات الموقع </a>
                                </li>
                               
                                @endif
                                  
                                <li class="divider"> </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-lock"></i>
                                            خروج
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                </li>
                            </ul>
                        </li>
              
                        
                    </ul>
                            
                        @endif
        </div>
          
          
          
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php $links=\DB::table("menu")->whereRaw("isdelete=0 and active=1 and parent_id=0")->get(); ?>
            @foreach($links as $link)
            <?php
                $sublinks=\DB::table("menu")->where("parent_id",$link->id)->where("active",1)->where("isdelete",0)
                ->get();
            ?>
            @if(count($sublinks)==0)
              <li><a {{$link->newwindow?"target='_blank'":""}} href="{{$link->url}}">{{$link->title}}</a></li>        
            @else
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$link->title}} <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      @foreach($sublinks as $sublink)
                        <li><a {{$sublink->newwindow?"target='_blank'":""}} href="{{$sublink->url}}">{{$sublink->title}}</a></li>
                      @endforeach
                  </ul>
                </li>
            @endif
            @endforeach()
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">  
        @if(count($breakingnews)>0)
            <div class="alert alert-danger">
                <b>خبر عاجل</b>
                <ul>
                    @foreach ($breakingnews as $b)
                        <li>{{ $b->news }}</li>
                    @endforeach
                </ul>
            </div>
        @endif()
        @if(\Session::get("msg")!=NULL)
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{\Session::get("msg")}}
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
        
        
        @yield("content")
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">coded by Entesar ElBanna {{date("Y")}}.</p>
      </div>
    </footer>
<div id="Confirm" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">تأكيد</h4>
              </div>
              <div class="modal-body">
                <p>هل أنت متأكد من الاستمرار في العملية؟</p>
              </div>
              <div class="modal-footer">
                <a type="button" class="btn btn-default" data-dismiss="modal">الغاء الأمر</a>
                <a type="button" class="btn btn-danger">نعم متأكد</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
      
      
     <script src="/metronic-rtl/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/metronic-rtl/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/metronic-rtl/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="/nprogress-master/nprogress.js" type="text/javascript"></script>
        
        <script src="/metronic-rtl/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
        
        <script src="/js/jquery.form.min.js"></script>
        <script>
        
            
            
            
          toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-bottom-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
           }
           function ShowMessage(msg,title="Jobs"){			
               var color="info";
               if(msg.substring(0,2)=="s:"){
                   color="success";msg=msg.substring(2);
               }
               else if(msg.substring(0,2)=="w:"){
                   color="warning";msg=msg.substring(2);
               }
               else if(msg.substring(0,2)=="e:"){
                   color="danger";msg=msg.substring(2);
               }
               else if(msg.substring(0,2)=="i:"){
                   color="info";msg=msg.substring(2);
               }
               Command: toastr[color](msg,title);
           }
            
            $(function(){
                //$("#Confirm").modal("show");
                $(document).on("click",".Confirm",function(){
                    $("#Confirm").modal("show");
                    $("#Confirm .btn-danger").attr("href",$(this).attr("href"));
                    return false;
                });
            }); 
           
      </script>
      @yield("js")
  </body>
</html>
