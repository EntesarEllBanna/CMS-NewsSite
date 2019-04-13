@extends("_felayout")
@section("title")
الصفحة الرئيسية
@endsection()
@section("content")
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
        <?php $i=0 ?>
        @foreach($sliders as $s)
            <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="{{$i++==0?"active":""}}"></li>
        @endforeach()
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php $i=0 ?>
    @foreach($sliders as $s)
    <div class="item {{$i++==0?"active":""}}">
      <a {{$s->newwindow?"target='_blank'":""}} href="{{$s->url}}">
          <img src="/uploads/{{$s->image}}" alt="{{$s->title}}">
          <div class="carousel-caption">
              <h2>{{$s->title}}</h2>
              <p>{{$s->summary}}</p>
          </div>
      </a>
    </div>
    @endforeach()
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<h1 class="page-header">آخر المقالات</h1>
<div class="row">
    @foreach($articles as $s)
    <div class="col-md-3 col-sm-6">
        <div class="img-thumbnail">
            
            <a class="" href="/article/{{$s->id}}">
                <img class="img-responsive" src="/thumb.php?src=./uploads/{{$s->image}}&size=400x250" />
                 <h5>
                    <b>
                        {{$s->title}}
                    </b>
                </h5>

            </a>
            
                <i class="glyphicon glyphicon-calendar "></i>
                {{date('d-m-Y', strtotime($s->created_at))}}
        </div>
        <br><br>
    </div>
    @endforeach
    
</div>


@endsection()

