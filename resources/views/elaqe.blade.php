@include('header')

<body>
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Əlaqə</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->
    <!-- ================ contact section start ================= -->
    <section class="contact-section section_padding">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Bizimlə Əlaqə Saxlayın</h2>
                </div>
                <div class="col-lg-8">
                  @if (Session('ok_mail'))
                    <div class="alert alert-success" role="alert">
                        {{ Session('ok_mail') }}
                    </div> 
                  @endif
                    

                    <form class="form-contact contact_form" action="{{ route('elaqe.mesajGonder') }}" method="post">
                      @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="ad" type="text" placeholder='Ad'>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Ad")
                                                <span style="color:red" class="helper-text" data-error="wrong" data-success="right">{{$error}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="e_mail" type="text" placeholder='E-Mail'>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="E-mail")
                                                <span style="color:red" class="helper-text" data-error="wrong" data-success="right">{{$error}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="basliq" type="text" placeholder='Başlıq'>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Başlıq")
                                                <span style="color:red" class="helper-text" data-error="wrong" data-success="right">{{$error}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="mesaj"  cols="30" rows="9" placeholder='Mesaj'></textarea>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Mesaj")
                                                <span style="color:red" class="helper-text" data-error="wrong" data-success="right">{{$error}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm btn_4 boxed-btn">Göndər</button>
                        </div>
                    </form>


                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+99455 764 71 65</h3>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>aferrehimov@gmail.com</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
    @include('footer')
