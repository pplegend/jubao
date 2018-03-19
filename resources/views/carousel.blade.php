<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img class="d-block w-100" src="{{ asset('storage/bg1.png')}}" alt="First slide">
        </div>
        <div class="item">
            <img class="d-block w-100" src="{{ asset('storage/bg2.png')}}" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>hello world</h5>
                <p>i am paragraph</p>
            </div>
        </div>
        <div class="item">
            <img class="d-block w-100" src="{{ asset('storage/bg3.png')}}" alt="Third slide">
        </div>
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