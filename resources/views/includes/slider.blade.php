<!-- banner -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <!-- Indicators-->
    <ol class="carousel-indicators">
        @for($i=0; $i<$sliders->count(); $i++)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class={{$i==0 ? "active" : ""}}></li>
        @endfor
    </ol>
    <div class="carousel-inner">

        @for($i=0; $i<$sliders->count();$i++)
            <?php
            $slide=str_replace('\\', '/', $sliders[$i]->image);
            $style="background:url('".asset('storage/'.$slide)."') center no-repeat"; ?>

        <div class="carousel-item itemx {{$i==0 ? 'active' : ''}}" style="{{$style}}">
            <div class="container">
                <div class="w3l-space-banner">
                    <div class="carousel-caption p-lg-5 p-sm-4 p-3">
                        <p>{{$sliders[$i]->text_top}}</p>
                        <h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">{{$sliders[$i]->text_bottom}}
                        </h3>
                        <a class="button2" href="product.html">Shop Now </a>
                    </div>
                </div>
            </div>
        </div>
        @endfor

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- //banner -->