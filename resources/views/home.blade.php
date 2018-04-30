@extends('layouts.master')

@section('content')
    <!-- *****************************************************************************************************************
     HEADERWRAP
     ***************************************************************************************************************** -->
    <div id="headerwrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Show your work with this beautiful theme</h3>
                    <h1>Eyecatching Bootstrap 3 Theme.</h1>
                    <h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h5>
                    <h5>More Lorem Ipsum added here too.</h5>
                </div>
                <div class="col-lg-8 col-lg-offset-2 himg">
                    <img src="assets/img/browser.png" class="img-responsive">
                </div>
            </div><!-- /row -->
        </div> <!-- /container -->
    </div><!-- /headerwrap -->

    <!-- *****************************************************************************************************************
     SERVICE LOGOS
     ***************************************************************************************************************** -->
    <div id="service">
        <div class="container">
            <div class="row centered">
                <div class="col-md-4">
                    <i class="fa fa-heart-o"></i>
                    <h4>Handsomely Crafted</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p><br/><a href="#" class="btn btn-theme">More Info</a></p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-flask"></i>
                    <h4>Retina Ready</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p><br/><a href="#" class="btn btn-theme">More Info</a></p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-trophy"></i>
                    <h4>Quality Theme</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p><br/><a href="#" class="btn btn-theme">More Info</a></p>
                </div>
            </div>
        </div><! --/container -->
    </div><! --/service -->

    <!-- *****************************************************************************************************************
     TESTIMONIALS
     ***************************************************************************************************************** -->
    <div id="twrap">
        <div class="container centered">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <i class="fa fa-comment-o"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    <h4><br/>Marcel Newman</h4>
                    <p>WEB DESIGNER - BLACKTIE.CO</p>
                </div>
            </div><! --/row -->
        </div><! --/container -->
    </div><! --/twrap -->

    <!-- *****************************************************************************************************************
     OUR CLIENTS
     ***************************************************************************************************************** -->
    <div id="cwrap">
        <div class="container">
            <div class="row centered">
                <h3>OUR CLIENTS</h3>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <img src="assets/img/clients/client01.png" class="img-responsive">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <img src="assets/img/clients/client02.png" class="img-responsive">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <img src="assets/img/clients/client03.png" class="img-responsive">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <img src="assets/img/clients/client04.png" class="img-responsive">
                </div>
            </div><! --/row -->
        </div><! --/container -->
    </div><! --/cwrap -->

    @include('layouts.footer')

@endsection

@section('javascript')

@endsection
