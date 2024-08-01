@include('header')
   <!-- bradcam_area  -->
   <div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Mütəxəssis</h3>
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
                                
                                    <img style="width:80px;height:80px;border-radius:10px" src="{{ asset($mutexessis[0]->img) }}" alt="{{ $mutexessis[0]->ad }}">
                            
                                <div style="padding-left: 20px" class="jobs_conetent">
                                    <a href="#"><h4>{{ $mutexessis[0]->ad." ".$mutexessis[0]->soyad }}</h4></a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> {{ $mutexessis[0]->sahe }} </p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fas fa-eye"></i> {{ $mutexessis[0]->baxis_sayi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"> <i class="far fa-bookmark"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Bacarıqlar</h4>
                            <p>{{ $mutexessis[0]->bacariqlar }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Təhsil</h4>
                            <p>{{ $mutexessis[0]->tehsil }}</p><br>
                            <p>{{ $mutexessis[0]->tehsil_etrafli }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>İş Təcrübəsi</h4>
                            <p>{{ $mutexessis[0]->is_tecrubesi }}</p><br>
                            <p>{{ $mutexessis[0]->is_tecrubesi_etrafli }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Əlavə Məlumat</h4>
                            <p>{{ $mutexessis[0]->elave_melumat }}</p>
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
                                <li>Ad: <span>{{ $mutexessis[0]->ad }}</span></li>
                                <li>Soyad: <span>{{ $mutexessis[0]->soyad }}</span></li>
                                <li>Ata adı: <span>{{ $mutexessis[0]->ata_adi }}</span></li>
                                <li>Şəhər: <span>{{ $mutexessis[0]->seher }}</span></li>
                                <li>Yaş: <span> {{ $mutexessis[0]->yas }}</span></li>
                                <li>Cins: <span> {{ $mutexessis[0]->cins }}</span></li>
                                <li>Elanın tarixi: <span> {{ $mutexessis[0]->created_at }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Telefon:</span>{{ $mutexessis[0]->telefon }}
                    </div>
                    <div class="share_wrap d-flex">
                        <span>E-Mail:</span>{{ $mutexessis[0]->email }}
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Minumum Ə/H:</span>{{ $mutexessis[0]->min_eh }} AZN
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Baxış sayı:</span>{{ $mutexessis[0]->baxis_sayi }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('footer')