@include('header')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">4536+ vakansiya</h5>
                        <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">Xəyal etdiyiniz işi tapın
                        </h3>

                        <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                            <a href="{{ route('cv.index') }}" class="boxed-btn3">CV Yerləşdir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ilstration_img wow fadeInRight d-none d-lg-block text-right" data-wow-duration="1s"
        data-wow-delay=".2s">
        <img src="img/banner/illustration.png" alt="">
    </div>
</div>
<!-- slider_area_end -->


<!-- catagory_area -->
<div class="catagory_area">
    <div class="container">
        <form action="{{ route('axtar.index') }}" method="POST">
            @csrf
            <div class="row cat_search">
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <input type="text" name="sahe" placeholder="Sahə">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <select class="wide" name="seher">
                            <option data-display="Şəhər/Rayon">Şəhər/Rayon</option>
                            @if (isset($seherler))
                                @foreach ($seherler as $seher)
                                    <option value="{{ $seher->id }}">{{ $seher->ad }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <select class="wide" name="kateqoriya">
                            <option data-display="Kateqoriya">Kateqoriya</option>
                            @if (isset($kateqoriyalar))
                                @foreach ($kateqoriyalar as $kateqoriya)
                                    <option value="{{ $kateqoriya->id }}">{{ $kateqoriya->ad }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="job_btn">
                        <button class="boxed-btn3" type="submit">Axtar</button>
                    </div>
                </div>
            </div>
    </form>
        <div class="row">
            <div class="col-lg-12">
                <div class="popular_search d-flex align-items-center">
                    <ul>
                    @if (isset($kateqoriyalar))
                        @foreach ($kateqoriyalar as $kateqoriya)
                            <li><a href="{{ route('axtar.index.kateqoriya',['kateqoriya_id'=>$kateqoriya->id]) }}">{{ $kateqoriya->ad }}</a></li>
                        @endforeach
                    @endif
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ catagory_area -->



<!--/ premumium vakansiyalar -->


@if ($premiumElanlar)

    <div class="job_listing_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" >
                    <div class="section_title" >
                        <h3 style="margin-top: 20px" >Premium Vakansiyalar <i style="color: rgb(255, 221, 0)" class="fas fa-crown"></i></h3>
                    </div>
                </div>

            </div>

            <div class="job_lists">
                <div class="row">
                    @foreach ($premiumElanlar as $pElan)
                        <div class="col-lg-12 col-md-12">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    {{-- <div class="thumb"> --}}
                                        <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ asset($pElan->getKateqoriya->img) }}" alt="{{$pElan->getKateqoriya->ad}}">
                                    {{-- </div> --}}
                                    <div class="jobs_conetent" style="margin-left: 10px">
                                        <a href="{{ route('vakansiya.detal',['vakansiya_id'=>$pElan->id]) }}">
                                            <h4>{{ $pElan->ad }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i> {{ $pElan->getSeher->ad }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-building"></i> {{ $pElan->sirket }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-money-bill-wave"></i> {{ $pElan->emekhaqqi }} AZN
                                                </p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($pElan->bitme_tarixi)->format('d.m.Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark save"  data-url="{{ route('save.elan',['elan_id'=>$pElan->id]) }}">
                                            @if (auth()->check())
                                                @php
                                                    $id_arr=explode(",", auth()->user()->save_elan);
                                                    $id_status="";
                                                    foreach ($id_arr as $id) {
                                                        if($id==$pElan->id){
                                                        $id_status="ok";
                                                        break;
                                                        }
                                                    }
                                                @endphp 
                                                @if ($id_status=="ok")
                                                    <i class="fas fa-bookmark"></i>
                                                @elseif($id_status=="")
                                                    <i class="far fa-bookmark"></i>
                                                @endif
                                            @else
                                                <i class="far fa-bookmark"></i>
                                            @endif
                                        </a>
                                        <a href="{{ route('vakansiya.detal',['vakansiya_id'=>$pElan->id]) }}" class="boxed-btn3">Müraciət Et</a>
                                    </div>
                                    <div class="date">
                                        <p>Yerləşdirmə Tarixi:
                                            {{ \Carbon\Carbon::parse($pElan->created_at)->format('d.m.Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif


<!--/ premumium vakansiyalar -->


<!-- one cixan vakansiyalar -->



@if ($ireliElanlar)

    <div class="job_listing_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section_title">
                        <h3 >Önə Çıxarılan Vakansiyalar <i class="fas fa-arrow-up"></i></h3>
                    </div>
                </div>

            </div>

            <div class="job_lists">
                <div class="row">
                    @foreach ($ireliElanlar as $iElan)
                        <div class="col-lg-12 col-md-12">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    {{-- <div class="thumb"> --}}
                                        <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ $iElan->getKateqoriya->img }}" alt="">
                                    {{-- </div> --}}
                                    <div class="jobs_conetent" style="margin-left: 10px">
                                        <a href="{{ route('vakansiya.detal',['vakansiya_id'=>$iElan->id]) }}">
                                            <h4>{{ $iElan->ad }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i> {{ $iElan->getSeher->ad }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-building"></i> {{ $iElan->sirket }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-money-bill-wave"></i> {{ $iElan->emekhaqqi }} AZN
                                                </p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($iElan->bitme_tarixi)->format('d.m.Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark save"  data-url="{{ route('save.elan',['elan_id'=>$iElan->id]) }}">
                                        @if (auth()->check())
                                            @php
                                                $id_arr=explode(",", auth()->user()->save_elan);
                                                $id_status="";
                                                foreach ($id_arr as $id) {
                                                    if($id==$iElan->id){
                                                    $id_status="ok";
                                                    break;
                                                    }
                                                }
                                            @endphp  
                                            @if ($id_status=="ok")
                                                <i class="fas fa-bookmark"></i>
                                            @elseif($id_status=="")
                                                <i class="far fa-bookmark"></i>
                                            @endif 
                                        @else
                                            <i class="far fa-bookmark"></i>
                                        @endif
                                        </a>                                        
                                        <a href="{{ route('vakansiya.detal',['vakansiya_id'=>$iElan->id]) }}" class="boxed-btn3">Müraciət Et</a>
                                    </div>
                                    <div class="date">
                                        <p>Yerləşdirmə Tarixi:
                                            {{ \Carbon\Carbon::parse($iElan->created_at)->format('d.m.Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif


<!-- one cixan vakansiyalar -->



<!-- Son Elanlar   -->
@if ($sonElanlar)
    <div class="job_listing_area">  
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section_title">
                    <h3>Ən Son Vakansiyalar</h3>
                </div>
            </div>

        </div>
        
            <div class="job_lists">
                <div class="row">
                    @foreach ($sonElanlar as $sElan)
                        <div class="col-lg-12 col-md-12">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    {{-- <div class="thumb"> --}}
                                        <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ $sElan->getKateqoriya->img }}" alt="">
                                   {{--  </div> --}}
                                    <div class="jobs_conetent" style="margin-left: 10px">
                                        <a href="{{ route('vakansiya.detal',['vakansiya_id'=>$sElan->id]) }}">
                                            <h4>{{ $sElan->ad }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i> {{ $sElan->getSeher->ad }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-building"></i> {{ $sElan->sirket }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-money-bill-wave"></i> {{ $sElan->emekhaqqi }} AZN
                                                </p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($sElan->bitme_tarixi)->format('d.m.Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark save"  data-url="{{ route('save.elan',['elan_id'=>$sElan->id]) }}">
                                            @if (auth()->check())
                                               @php
                                                    $id_arr=explode(",", auth()->user()->save_elan);
                                                    $id_status="";
                                                    foreach ($id_arr as $id) {
                                                        if($id==$sElan->id){
                                                        $id_status="ok";
                                                        break;
                                                        }
                                                    }
                                                @endphp 
                                                @if ($id_status=="ok")
                                                    <i class="fas fa-bookmark"></i>
                                                @elseif($id_status=="")
                                                    <i class="far fa-bookmark"></i>
                                                @endif  
                                            @else
                                                <i class="far fa-bookmark"></i>
                                            @endif
                                            
                                        </a>                                        
                                        <a href="{{ route('vakansiya.detal',['vakansiya_id'=>$sElan->id]) }}" class="boxed-btn3">Müraciət Et</a>
                                    </div>
                                    <div class="date">
                                        <p>Yerləşdirmə Tarixi:
                                            {{ \Carbon\Carbon::parse($sElan->created_at)->format('d.m.Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
       
        <div class="col-lg-12">
            <div class="brouse_job text-center">
                <a style="width: 100%" href="{{route('vakansiyalar')}}" class="boxed-btn4">Hamısına Bax</a>
            </div>
        </div>
    </div>
    </div> 
@endif
<!-- Son Elanlar -END  -->

<!-- featured_candidates_area_start  -->
<div class="featured_candidates_area top_companies_area">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-lg-12">
                <div class="section_title text-center mb-40">
                    <h3>Kateqoriyalar</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="candidate_active owl-carousel">
                    @if ($kateqoriyalar_say)
                        @foreach ($kateqoriyalar_say as $kateqoriya_ad => $total)
                            @foreach ($kateqoriyalar_img as $kateqoriya_ad2 => $img)
                                @if ($kateqoriya_ad2 == $kateqoriya_ad)
                                    <div class="single_company">
                                        {{-- <div class="thumb"> --}}
                                            <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ asset($img) }}" alt="{{ $kateqoriya_ad }}">
                                        {{-- </div> --}}
                                        <a href="{{ route('axtar.index.kateqoriya2',['kateqoriya_ad'=>$kateqoriya_ad]) }}">
                                            <h3>{{ $kateqoriya_ad }}</h3>
                                        </a>
                                        <p> <span>{{ $total }}</span> Vakansiya</p>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- featured_candidates_area_end  -->





<!-- job_searcing_wrap  -->
<div class="job_searcing_wrap overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 col-md-6">
                <div class="searching_text">
                    <h3>İş Axtarırsınız?</h3>
                    <p>İstədiyiniz sahə üzrə işlər </p>
                    <a href="{{route('vakansiyalar')}}" class="boxed-btn3">İş Tap</a>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 col-md-6">
                <div class="searching_text">
                    <h3>Mütəxəssis Axtarırsınız?</h3>
                    <p>İstədiyiniz sahəyə mütəxəssis </p>
                    <a href="{{route('mutexessisler')}}" class="boxed-btn3">Mütəxəssis Tap</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- job_searcing_wrap end  -->

<div style="padding: 10px"></div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
     $(function( $ ){
        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
        $('.save').on('click',function(){
                    var dataID=$(this).data('url');
                    
                    var self=$(this).children(":first");
                    var token = $("meta[name='csrf-token']").attr("content");
                    
                    $.ajax({
                        url: dataID,
                        type: 'GET',
                        // data: {
                        //     "id": dataID,
                        //     "_token": token 
                        // },
                        success:function(response){
                            if(response.status==1){
                                self.removeClass("far");
                                self.addClass("fas"); 
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Saxlanılanlara əlavə edildi'
                                    })
                            }
                            else if(response.status==0){
                                self.removeClass("fas");
                                self.addClass("far");
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Saxlanılanlardan çıxarıldı'
                                    })
                            } 
                        },
                        error:function(response){
                            alert('Xəta : Məlumat dəyişdirilmədi !');
                        }
                    });     
                });

     });
</script>

@include('footer')
