@include('header')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Haqqımızda</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{asset('ishtap/img/about/haqqimizda.jpg')}}" alt="">
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block">
                                    <h2>İşTap Platforması</h2>
                                </a>
                                <p>
                                   <b>İşTap Platforması </b><br> əmək bazarının bütün iştirakçılarının faydalana biləcəyi, dəqiq və sürətli iş və ya işçi axtarışı üçün nəzərdə tutulmuş onlayn platformadır. Layihə istifadəçilərə geniş iş elanı və CV bazasından rahat istifadə imkanı yaradır.
                                                                        
                                   <br> İşTap Platforması - işədüzəltmə şirkəti deyil. Layihənin məqsədi işə götürən ilə potensial işçi arasında vasitəçisiz və operativ əlaqə imkanı yaratmaqdır.
                                    
                                   <br><b>Elanların yerləşdirilməsi: </b><br>
                                    
                                    İşTap - istifadəçilərə sayta iş elanı və CV yerləşdirmək imkanı yaradır. Hər istifadəçi ay ərzində ödənişsiz olaraq bir neçə iş elanı və bir CV yerləşdirə bilər.
                                    
                                    <br><b>Bizimlə əlaqə: </b><br>
                                    
                                    Biz layihənin inkişafı və təkmilləşdirilməsi üçün əlimizdən gələni edirik və sizin bu haqda olan fikirlərinizi və təkliflərinizi dinləməyə hazırıq. Bizimlə əlaqə yaratmaq üçün <a href="{{ route('elaqe') }}">ƏLAQƏ</a> bölməsinə keçid edə bilərsiniz.</p>
                               
                            </div>
                        </article>







                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
    @include('footer')