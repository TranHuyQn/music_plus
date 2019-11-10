<div style="background-color: white">
    <div class="row mt-5">
        <div class="col-6">
                        <span class="float-left font-weight-bold ml-5">
                            <h3>Singers</h3>
                        </span>
        </div>
    </div>
    <div id="singersSlide" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active text-center">
                <div class="row ml-5 mr-5">
                    @foreach($singers[0] as $singer)
                    <div class="col-3">
                        <img
                            src="{{asset('/storage/images/singer/'.$singer->image)}}"
                            height="150" width="150"
                            class="border rounded-circle">
                        <p class="mt-1">{{$singer->name}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="carousel-item text-center">
                <div class="row ml-5 mr-5">
                    @foreach($singers[1] as $singer)
                        <div class="col-3">
                            <img
                                src="{{asset('/storage/images/singer/'.$singer->image)}}"
                                height="150" width="150"
                                class="border rounded-circle">
                            <p class="mt-1">{{$singer->name}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#singersSlide" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#singersSlide" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<!-- space -->
<div><hr></div>
