@include('header')

<!-- bradcam_area  -->
   <div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>4536+ Mütəxəssis</h3>
                </div>
                <div class="sldier_btn wow fadeInLeft " data-wow-duration="1s" data-wow-delay=".5s">
                    <a href="{{ route('cv.user_cv') }}" class="boxed-btn3">CV yükləyin</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!-- job_listing_area_start  -->

    <div class="container" style="margin-top: 20px">
        <div class="row">

            <div class="col-lg-9">

                <div class="featured_candidates_area candidate_page_padding" style="padding-top: 20px">
                    <div class="container">
                        <div class="row">
                            @if (isset($mutexessisler))
                                @foreach ($mutexessisler as $mutexessis)
                                    <div class="col-md-8 col-lg-4">
                                        <div class="single_candidates text-center">
                                            <div class="thumb">
                                                <img style="width: 120px;height:120px"  src="{{asset($mutexessis->img)}}" alt="{{ $mutexessis->ad }}">
                                            </div>
                                            <a href="{{ route('mutexessis.detal',['mutexessis_id'=>$mutexessis->id]) }}"><h4>{{ $mutexessis->ad }}</h4></a>
                                            <p>{{ $mutexessis->sahe }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                            
                        </div>
                        
                    </div>
                </div>
                <!-- featured_candidates_area_end  -->


                <div class="col-lg-9" style="margin: auto" >
                    <div class="recent_joblist_wrap ">
                        <div class="recent_joblist  ">                  
                            {{ $mutexessisler->links('pagination::bootstrap-4') }}                 
                        </div>
                    </div> 
                </div>

                {{-- <div class="job_lists m-0">
                    <div class="row">
                        
                        <div class="single_candidates text-center">
                            <div class="thumb">
                                <img src="{{asset('ishtap/img/candiateds/1.png')}}" alt="">
                            </div>
                            <a href="#"><h4>Markary Jondon</h4></a>
                            <p>Software Engineer</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pagination_wrap">
                                <ul>
                                    <li><a href="#"> <i class="ti-angle-left"></i> </a></li>
                                    <li><a href="#"><span>01</span></a></li>
                                    <li><a href="#"><span>02</span></a></li>
                                    <li><a href="#"> <i class="ti-angle-right"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            
            <div class="col-lg-3">
                <div class="job_filter white-bg">
                <form action="#">
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Kateqoriya</h4>
                        <ul class="list cat-list">
                            @if ($kateqoriyalar_say)
                                @foreach ($kateqoriyalar_say as $kateqoriya_ad => $total)
                                    @foreach ($kateqoriyalar as $kateqoriya)
                                        @if ($kateqoriya->ad == $kateqoriya_ad)
                                            <li>
                                                <a href="{{ route('mutexessisler',['kateqoriya_id'=>$kateqoriya->id]) }}" class="d-flex">
                                                    <p>{{ $kateqoriya_ad }}</p>
                                                    <p>({{ $total }})</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        </ul>
                     </aside>
                </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- job_listing_area_end  -->

@include('footer')