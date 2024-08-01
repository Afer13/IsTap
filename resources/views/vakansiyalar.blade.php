@include('header')

<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>4536+ vakansiya</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<div class="job_listing_area plus_padding">
    <div class="container">
        <div class="row">
            @if (!isset($_GET['page']))
                <!-- Premium elanlar -->
                @if (isset($premiumElanlar))
                    <div class="col-lg-9">
                        <div class="recent_joblist_wrap">
                            <div class="recent_joblist white-bg " style="background-color: #ebe65f">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h4>Premium Vakansiyalar <i class="fas fa-crown"></i></h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="job_lists m-0">
                            <div class="row">
                                @foreach ($premiumElanlar as $pElan)
                                    <div class="col-lg-12 col-md-12">
                                        <div class="single_jobs white-bg d-flex justify-content-between">
                                            <div class="jobs_left d-flex align-items-center">
                                                {{-- <div class="thumb"> --}}
                                                    <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ $pElan->getKateqoriya->img }}" alt="">
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
                                                            <p> <i class="fas fa-money-bill-wave"></i>
                                                                {{ $pElan->emekhaqqi }} AZN</p>
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
                                                    <p>Bitmə Tarixi:
                                                        {{ \Carbon\Carbon::parse($pElan->bitme_tarixi)->format('d.m.Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endif
                <!-- Premium Elanlar -End -->

                <!-- filtir -->
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <form action="{{ route('vakansiyalar')}}" method="GET">
                            <div class="form_inner white-bg">
                                <h3>Filtir</h3>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <input type="text" name="sahe" placeholder="Sahə">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field" >
                                            <select class="wide" name="seher">
                                                <option>Şəhər/Rayon</option>
                                                @if ($seherler)
                                                    @foreach ($seherler as $seher) 
                                                        <option value="{{ $seher->id }}">{{ $seher->ad }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="kateqoriya">
                                                <option>Kateqoriya</option>
                                                @if ($kateqoriyalar)
                                                    @foreach ($kateqoriyalar as $kateqoriya) 
                                                        <option value="{{ $kateqoriya->id }}">{{ $kateqoriya->ad }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        
                            <div class="reset_btn">
                                <button class="boxed-btn3 w-100" type="submit">Gətir</button>
                            </div>
                        </form>
                        </div>
                </div>
                <!-- filtir -END -->

                <!-- Ireli cekilen elanlar -->
                @if (isset($ireliElanlar))
                    <div class="col-lg-9">
                        <div class="recent_joblist_wrap">
                            <div class="recent_joblist white-bg " style="background-color: #80bff6">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h4>Önə Çıxarılan Vakansiyalar <i class="fas fa-arrow-up"></i></h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="job_lists m-0">
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
                                                            <p> <i class="fas fa-money-bill-wave"></i>
                                                                {{ $iElan->emekhaqqi }}
                                                                AZN</p>
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
                                                    <p>Bitmə Tarixi:
                                                        {{ \Carbon\Carbon::parse($iElan->bitme_tarixi)->format('d.m.Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endif
                <!-- Ireli Cekilen elanlar -END -->

                <!-- son  elanlar -->
                @if (isset($sonElanlar))
                    <div class="col-lg-9">
                            <div class="recent_joblist_wrap">
                                <div class="recent_joblist white-bg " style="background-color: #80bff6">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h4>Ən Son Vakansiyalar</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="job_lists m-0">
                                <div class="row">
                                    @foreach ($sonElanlar as $sElan)
                                        <div class="col-lg-12 col-md-12">
                                            <div class="single_jobs white-bg d-flex justify-content-between">
                                                <div class="jobs_left d-flex align-items-center">
                                                    {{-- <div class="thumb"> --}}
                                                        <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)"  src="{{ $sElan->getKateqoriya->img }}" alt="">
                                                    {{-- </div> --}}
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
                                                                <p> <i class="fas fa-money-bill-wave"></i>
                                                                    {{ $sElan->emekhaqqi }} AZN
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
                                                        <p>Bitmə Tarixi:
                                                            {{ \Carbon\Carbon::parse($sElan->bitme_tarixi)->format('d.m.Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    </div>
                @endif
                <!-- son Cekilen elanlar - END --> 
                    
            @else
                @if ($_GET['page']==1)
                    <!-- Premium elanlar -->
                    @if (isset($premiumElanlar))
                        <div class="col-lg-9">
                            <div class="recent_joblist_wrap">
                                <div class="recent_joblist white-bg " style="background-color: #ebe65f">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h4>Premium Vakansiyalar <i class="fas fa-crown"></i></h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="job_lists m-0">
                                <div class="row">
                                    @foreach ($premiumElanlar as $pElan)
                                        <div class="col-lg-12 col-md-12">
                                            <div class="single_jobs white-bg d-flex justify-content-between">
                                                <div class="jobs_left d-flex align-items-center">
                                                    {{-- <div class="thumb"> --}}
                                                        <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ $pElan->getKateqoriya->img }}" alt="">
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
                                                                <p> <i class="fas fa-money-bill-wave"></i>
                                                                    {{ $pElan->emekhaqqi }} AZN</p>
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
                                                        <p>Bitmə Tarixi:
                                                            {{ \Carbon\Carbon::parse($pElan->bitme_tarixi)->format('d.m.Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @endif
                    <!-- Premium Elanlar -End -->

                    <!-- filtir -->
                    <div class="col-lg-3">
                        <div class="job_filter white-bg">
                            <form action="{{ route('vakansiyalar')}}" method="GET">
                                <div class="form_inner white-bg">
                                    <h3>Filtir</h3>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single_field">
                                                <input type="text" name="sahe" placeholder="Sahə">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single_field" >
                                                <select class="wide" name="seher">
                                                    <option>Şəhər/Rayon</option>
                                                    @if ($seherler)
                                                        @foreach ($seherler as $seher) 
                                                            <option value="{{ $seher->id }}">{{ $seher->ad }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single_field">
                                                <select class="wide" name="kateqoriya">
                                                    <option>Kateqoriya</option>
                                                    @if ($kateqoriyalar)
                                                        @foreach ($kateqoriyalar as $kateqoriya) 
                                                            <option value="{{ $kateqoriya->id }}">{{ $kateqoriya->ad }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="reset_btn">
                                    <button class="boxed-btn3 w-100" type="submit">Gətir</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    <!-- filtir -END -->

                    <!-- Ireli cekilen elanlar -->
                    @if (isset($ireliElanlar))
                        <div class="col-lg-9">
                            <div class="recent_joblist_wrap">
                                <div class="recent_joblist white-bg " style="background-color: #80bff6">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h4>Önə Çıxarılan Vakansiyalar <i class="fas fa-arrow-up"></i></h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="job_lists m-0">
                                <div class="row">
                                    @foreach ($ireliElanlar as $iElan)
                                        <div class="col-lg-12 col-md-12">
                                            <div class="single_jobs white-bg d-flex justify-content-between">
                                                <div class="jobs_left d-flex align-items-center">
                                                    {{-- <div class="thumb"> --}}
                                                        <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ $iElan->getKateqoriya->img }}" alt="">
                                                    {{-- </div> --}}
                                                    <div class="jobs_conetent" style="margin-left: 10px" >
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
                                                                <p> <i class="fas fa-money-bill-wave"></i>
                                                                    {{ $iElan->emekhaqqi }}
                                                                    AZN</p>
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
                                                        <p>Bitmə Tarixi:
                                                            {{ \Carbon\Carbon::parse($iElan->bitme_tarixi)->format('d.m.Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @endif
                    <!-- Ireli Cekilen elanlar -END -->

                    <!-- son  elanlar -->
                    @if ($sonElanlar)
                        <div class="col-lg-9">
                                <div class="recent_joblist_wrap">
                                    <div class="recent_joblist white-bg " style="background-color: #80bff6">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <h4>Ən Son Vakansiyalar</h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="job_lists m-0">
                                    <div class="row">
                                        @foreach ($sonElanlar as $sElan)
                                            <div class="col-lg-12 col-md-12">
                                                <div class="single_jobs white-bg d-flex justify-content-between">
                                                    <div class="jobs_left d-flex align-items-center">
                                                        {{-- <div class="thumb"> --}}
                                                            <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ $sElan->getKateqoriya->img }}" alt="">
                                                        {{-- </div> --}}
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
                                                                    <p> <i class="fas fa-money-bill-wave"></i>
                                                                        {{ $sElan->emekhaqqi }} AZN
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
                                                            <p>Bitmə Tarixi:
                                                                {{ \Carbon\Carbon::parse($sElan->bitme_tarixi)->format('d.m.Y') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                    @endif
                    <!-- son Cekilen elanlar - END --> 
                @elseif($_GET['page']>=2)
                    <!-- son  elanlar -->
                    @if ($sonElanlar)
                        <div class="col-lg-9">
                                <div class="recent_joblist_wrap">
                                    <div class="recent_joblist white-bg " style="background-color: #80bff6">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <h4>Ən Son Vakansiyalar</h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="job_lists m-0">
                                    <div class="row">
                                        @foreach ($sonElanlar as $sElan)
                                            <div class="col-lg-12 col-md-12">
                                                <div class="single_jobs white-bg d-flex justify-content-between">
                                                    <div class="jobs_left d-flex align-items-center">
                                                        {{-- <div class="thumb"> --}}
                                                            <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ $sElan->getKateqoriya->img }}" alt="">
                                                        {{-- </div> --}}
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
                                                                    <p> <i class="fas fa-money-bill-wave"></i>
                                                                        {{ $sElan->emekhaqqi }} AZN
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
                                                            <p>Bitmə Tarixi:
                                                                {{ \Carbon\Carbon::parse($sElan->bitme_tarixi)->format('d.m.Y') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                    @endif
                    <!-- son Cekilen elanlar - END -->
                    
                    <!-- filtir -->
                    <div class="col-lg-3">
                        <div class="job_filter white-bg">
                            <form action="{{ route('vakansiyalar')}}" method="GET">
                                <div class="form_inner white-bg">
                                    <h3>Filtir</h3>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single_field">
                                                <input type="text" name="sahe" placeholder="Sahə">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single_field" >
                                                <select class="wide" name="seher">
                                                    <option>Şəhər/Rayon</option>
                                                    @if ($seherler)
                                                        @foreach ($seherler as $seher) 
                                                            <option value="{{ $seher->id }}">{{ $seher->ad }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single_field">
                                                <select class="wide" name="kateqoriya">
                                                    <option>Kateqoriya</option>
                                                    @if ($kateqoriyalar)
                                                        @foreach ($kateqoriyalar as $kateqoriya) 
                                                            <option value="{{ $kateqoriya->id }}">{{ $kateqoriya->ad }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="reset_btn">
                                    <button class="boxed-btn3 w-100" type="submit">Gətir</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    <!-- filtir -END -->
                @endif    
            @endif
       
        </div>  
        <div class="col-lg-9" style="margin: auto" >
            <div class="recent_joblist_wrap ">
                <div class="recent_joblist  ">                  
                    {{ $sonElanlar->links('pagination::bootstrap-4') }}                 
                </div>
            </div> 
        </div>
    </div>    
        
</div>
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
