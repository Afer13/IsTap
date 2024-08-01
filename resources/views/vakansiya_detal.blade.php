@include('header')
   <!-- bradcam_area  -->
   <div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Elanlar</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--/ bradcam_area  -->
    <div class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                
                                    <img style="width: 90px;height:90px;border-radius:10px;border:1px solid rgb(0, 110, 255)" src="{{ asset($elan[0]->getKateqoriya->img) }}" alt="{{ $elan[0]->getKateqoriya->ad }}">
                            
                                <div style="padding-left: 20px" class="jobs_conetent">
                                    <a href="#"><h4>{{ $elan[0]->ad }}</h4></a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p><i class="fas fa-building"></i>  {{ $elan[0]->sirket }} </p>
                                        </div>
                                        <div class="location">
                                            <p><i class="fas fa-money-bill-wave"></i> {{ $elan[0]->emekhaqqi }} </p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fas fa-eye"></i> {{ $elan[0]->baxis_sayi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark save"  data-url="{{ route('save.elan',['elan_id'=>$elan[0]->id]) }}">
                                        @if (auth()->check())
                                            @php
                                                $id_arr=explode(",", auth()->user()->save_elan);
                                                $id_status="";
                                                foreach ($id_arr as $id) {
                                                    if($id==$elan[0]->id){
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
                                    </a> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>İş barədə məlumat</h4>
                            <p>{{ $elan[0]->is_melumat }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Namizəddən Tələblər</h4>
                            <p>{{ $elan[0]->is_teleb }}</p><br>
                        </div>
                        <div class="single_wrap">
                            <h4>Əlavə Məlumat</h4>
                            <p>{{ $elan[0]->elave }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="job_sumary">
                        <div class="summery_header" style="padding: 20px">
                            <h3>Haqqında</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Şəhər: <span>{{ $elan[0]->getSeher->ad }}</span></li>
                                <li>Yaş: <span>{{ $elan[0]->yas }}</span></li>
                                <li>Təhsil: <span>{{ $elan[0]->tehsil }}</span></li>
                                <li>İş Təcrübəsi: <span>{{ $elan[0]->is_tecrubesi }}</span></li>
                                <li>Əməkhaqqı: <span> {{ $elan[0]->emekhaqqi }}</span></li>
                                <li>Elanın tarixi: <span> {{ $elan[0]->created_at }}</span></li>
                                <li>Bitmə tarixi: <span> {{ $elan[0]->bitme_tarixi }}</span></li>
                                <li>Əlaqədar Şəxs: <span> {{ $elan[0]->elaqedar_sexs }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Telefon:</span>{{ $elan[0]->telefon }}
                    </div>
                    <div class="share_wrap d-flex">
                        <span>E-Mail:</span>{{ $elan[0]->email }}
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Baxış sayı:</span>{{ $elan[0]->baxis_sayi }}
                    </div>
                </div>
                @if ($ireliElanlar)
                    <div class="col-lg-12">
                    <div class="job_listing_area">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="section_title">
                                        <h3 style="padding-top: 20px">Önə Çıxarılan Vakansiyalar <i class="fas fa-arrow-up"></i></h3>
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
                                                                <p> <i class="fa fa-map-marker"></i> {{ $iElan->seher }}</p>
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
                    </div>
                @endif

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