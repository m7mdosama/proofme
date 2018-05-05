@extends('layouts.master')
@section('pageTitle','Welcome')

@section('content')
    <!-- *****************************************************************************************************************
     HEADERWRAP
     ***************************************************************************************************************** -->
    <div id="headerwrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Show your Desgines For Review</h3>
                    <h1>Design Upload Review</h1>
                    <h5> share your images with their chosen reviewers for feedback and approval. Reviewers use
                        ProofMe’s robust set of annotation tools to mark up individual proofs and leave comments for the
                        proof owner.</h5>

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
                    <h4>About Laravel</h4>
                    <p>Laravel is a web application framework with expressive, elegant syntax. We believe development
                        must be an enjoyable and creative experience to be truly fulfilling.</p>
                    <p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-flask"></i>
                    <h4>Learning Laravel</h4>
                    <p>Laravel has the most extensive and thorough documentation and video tutorial library of any
                        modern web application framework.</p>
                    <p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-trophy"></i>
                    <h4> Laravel Sponsors</h4>
                    <p>We would like to extend our thanks to the following sponsors for helping fund on-going Laravel
                        development. If you are interested in becoming a sponsor.</p>
                    <p>
                </div>
            </div>
        </div>
        <! --/container -->
    </div><! --/service -->

    <!-- *****************************************************************************************************************
     TESTIMONIALS
     ***************************************************************************************************************** -->
    <div id="twrap">
        <div class="container centered">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <i class="fa fa-comment-o"></i>
                    <p>If you discover a security vulnerability within Laravel, please don't hesitate to contact us. All
                        security vulnerabilities will be promptly addressed.ProofMe radically simplifies content review
                        and approval. Intuitive to use, yet powerful enough for pros, ProofMe is the only platform built
                        to handle all your videos, images and text. Go from v1 to done in record time.</p>

                </div>
            </div>
            <! --/row -->
        </div>
        <! --/container -->
    </div><! --/twrap -->



    @include('layouts.footer')

@endsection

@section('javascript')

@endsection
