@include('header')
<head>
    <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.min.css')}}">
</head>
   <!-- bradcam_area  -->
   <div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>CV-Niz</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--/ bradcam_area  -->
@if ($mutexessis==null)
<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center"> 
                            <div style="padding-left: 20px" class="jobs_conetent">
                                <h1>Hal-hazırda CV-niz yoxdur.</h1>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                <a href="{{ route('cv.index') }}" class="boxed-btn3" >CV yerləşdir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div  class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between" >
                            <div class="jobs_left d-flex align-items-center">
                                
                                    <img style="width:80px;height:80px;border-radius:10px" src="{{ asset($mutexessis->img) }}" alt="{{ $mutexessis->ad }}">
                            
                                <div style="padding-left: 20px" class="jobs_conetent">
                                    <a href="#"><h4>{{ $mutexessis->ad." ".$mutexessis->soyad }}</h4></a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> {{ $mutexessis->sahe }} </p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fas fa-eye"></i> {{ $mutexessis->baxis_sayi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg" >
                        <div class="single_wrap">
                            <h4>Bacarıqlar</h4>
                            <p>{{ $mutexessis->bacariqlar }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Təhsil</h4>
                            <p>{{ $mutexessis->tehsil }}</p><br>
                            <p>{{ $mutexessis->tehsil_etrafli }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>İş Təcrübəsi</h4>
                            <p>{{ $mutexessis->is_tecrubesi }}</p><br>
                            <p>{{ $mutexessis->is_tecrubesi_etrafli }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Əlavə Məlumat</h4>
                            <p>{{ $mutexessis->elave_melumat }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="jobs_right" style="padding-bottom:10px">
                        <div class="apply_now">
                            <a style="width: 100%;" href="{{ route('cv.update.index') }}" class="boxed-btn3">Məlumatları Yenilə</a><br>
                            <a style="width: 100%;margin-top:10px;height:45px" onclick="cv_sil()" class="genric-btn danger radius">CV-ni Sil</a>
                        </div>
                    </div>
                    <div class="job_sumary">
                        <div class="summery_header" style="padding: 20px">
                            <h3>Haqqında</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Ad: <span>{{ $mutexessis->ad }}</span></li>
                                <li>Soyad: <span>{{ $mutexessis->soyad }}</span></li>
                                <li>Ata adı: <span>{{ $mutexessis->ata_adi }}</span></li>
                                <li>Şəhər: <span>{{ $mutexessis->seher }}</span></li>
                                <li>Yaş: <span> {{ $mutexessis->yas }}</span></li>
                                <li>Cins: <span> {{ $mutexessis->cins }}</span></li>
                                <li>Elanın tarixi: <span> {{ $mutexessis->created_at }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Telefon:</span>{{ $mutexessis->telefon }}
                    </div>
                    <div class="share_wrap d-flex">
                        <span>E-Mail:</span>{{ $mutexessis->email }}
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Minumum Ə/H:</span>{{ $mutexessis->min_eh }} AZN
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Baxış sayı:</span>{{ $mutexessis->baxis_sayi }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



<script src="{{asset('sweetalert/sweetalert2.js')}}"></script>
<script src="{{asset('sweetalert/sweetalert2.min.js')}}"></script>
<script src="{{asset('sweetalert/sweetalert2.all.js')}}"></script>
<script src="{{asset('sweetalert/sweetalert2.all.min.js')}}"></script>
<script>
    function cv_sil(){
        Swal.fire({
        title: 'CV-niz silinsin ?',
        //text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sil !'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('cv.user.delete')}}";
        }
        })
    }
    
</script>
@include('footer')