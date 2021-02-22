@extends('layout.main')

@section('content')
    <!--Banner Inner-->
    <section>
        <div class="lgx-banner lgx-banner-inner">
            <div class="lgx-page-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-heading-area">
                                <div class="lgx-heading lgx-heading-white">
                                    <h2 class="heading">Qayta yuklash</h2>
                                </div>
                                <ul class="breadcrumb">
                                    <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i>Asosiy sahifa</a></li>
                                    <li class="active">Qayta yuklash</li>
                                </ul>
                            </div>
                        </div>
                    </div><!--//.ROW-->
                </div><!-- //.CONTAINER -->
            </div><!-- //.INNER -->
        </div>
    </section> <!--//.Banner Inner-->


    <main>
        <div class="lgx-page-wrapper">
            <!--News-->
            <section>
                <div class="container">
                    <div class="row">

                        <div class="col-sm-12 col-md-6 col-md-offset-3">
                            @if(!isset($message))
                                <form method="POST" class="lgx-contactform" id="lgx-contactform" action="/conferences/re-upload" enctype="multipart/form-data">
                                    @if (isset($_GET['hash']))
                                        <div class="form-group">
                                            <input type="hidden" name="hash" class="form-control lgxname" value="{{ $_GET['hash'] }}">
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <input type="file" class="form-control lgxfile" name="file" id="lgxfile" required>
                                        @if($errors->has('file'))
                                            <span class="has-error" style="color: red;">
                                            {{ ($errors->get('file')[0]) }}
                                        </span>
                                        @endif
                                    </div>
                                        <div class="form-group">
                                            <input type="text" placeholder="Versiyaga raqamlang: masalan v1" name="version" class="form-control lgxname">
                                        </div>

                                    <input type="hidden" name="_token" id="lgx_token" value="<?php echo csrf_token(); ?>">


                                    <button type="submit" id="lgx-submit" class="lgx-btn hvr-glow hvr-radial-out lgx-send"><span>Jo'natish</span></button>
                                </form>
                            @else
                            <!-- MODAL SECTION -->
                                <div class="lgx-form-modal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content lgx-modal-content">

                                            <div class="modal-body">
                                                <div class="alert lgx-form-msg" role="alert">{{ $message }}</div>
                                            </div> <!--//MODAL BODY-->

                                        </div>
                                    </div>
                                </div> <!-- //MODAL -->
                            @endif
                        </div> <!--//.COL-->
                    </div>
                </div><!-- //.CONTAINER -->
            </section>
            <!--News END-->
        </div>
    </main>
@endsection
