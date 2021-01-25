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
                                <h2 class="heading">Anjumanga ro'yhatdan o'tish</h2>
                            </div>
                            <ul class="breadcrumb">
                                <li><a href="/"><i class="fa fa-home" aria-hidden="true"></i>Asosiy sahifa</a></li>
                                <li class="active">Ro'yhatdan o'tish</li>
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
                        @if(!$message)
                            <form method="POST" class="lgx-contactform" id="lgx-contactform" action="/conferences/create" enctype="multipart/form-data">
                                <div class="form-group">
                                    <select name="category_id" class="form-control lgxname" id="lgxcategory" required>
                                        <option disabled selected>Yo'nalishni tanlang</option>
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }}  </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category_id'))
                                        <span class="has-error" style="color: red;">
                                            {{ ($errors->get('category_id')[0]) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="text" name="username" class="form-control lgxname" id="lgxusername" placeholder="FIO">

                                    @if($errors->has('username'))
                                        <span class="has-error" style="color: red;">
                                            {{ ($errors->get('username')[0]) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control lgxemail" id="lgxemail" placeholder="Emailingizni kiriting" required>
                                    @if($errors->has('email'))
                                        <span class="has-error" style="color: red;">
                                            {{ ($errors->get('email')[0]) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control lgxsubject" id="lgxsubject" placeholder="Maqola mavzusi" required>
                                    @if($errors->has('subject'))
                                        <span class="has-error" style="color: red;">
                                            {{ ($errors->get('subject')[0]) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control lgxmessage" name="note_client" id="lgxnote_client" rows="5" placeholder="Qo'shimcha xabar" required></textarea>
                                    @if($errors->has('note_client'))
                                        <span class="has-error" style="color: red;">
                                            {{ ($errors->get('note_client')[0]) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="text" name="authors" class="form-control lgxsubject" id="lgxauthors" placeholder="Mualliflar" required>
                                    @if($errors->has('authors'))
                                        <span class="has-error" style="color: red;">
                                            {{ ($errors->get('authors')[0]) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="file" class="form-control lgxfile" name="file" id="lgxfile" required>
                                    @if($errors->has('file'))
                                        <span class="has-error" style="color: red;">
                                            {{ ($errors->get('file')[0]) }}
                                        </span>
                                    @endif
                                </div>

                                <input type="hidden" name="_token" id="lgx_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="conference_id" id="lgxconference" value="1">


                                <button type="submit" id="lgx-submit" class="lgx-btn hvr-glow hvr-radial-out lgx-send"><span>Ro'yhatdan o'tish</span></button>
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
