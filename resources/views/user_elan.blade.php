@include('header')

   <!-- bradcam_area  -->
   <div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Elanlarınız</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--/ bradcam_area  -->
@if ($elanlar==null)
<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center"> 
                            <div style="padding-left: 20px" class="jobs_conetent">
                                <h1>Hal-hazırda elanınız yoxdur.</h1>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                <a href="#" class="boxed-btn3" >Elan yerləşdir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="job_details_header">
                        @foreach ($elanlar as $elan)
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    
                                        <img style="width:80px;height:80px;border-radius:10px" src="{{ asset($elan->getKateqoriya->img) }}" alt="{{ $elan->getKateqoriya->ad }}">
        
                                    <div style="padding-left: 20px" class="jobs_conetent">
                                        <a href="{{ route('elan.user.detal',['elan_id'=>$elan->id]) }}"><h4>{{ $elan->ad }}</h4></a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p><i class="fas fa-building"></i> {{ $elan->sirket }} </p>
                                            </div>
                                            <div class="location">
                                                <p><i class="fas fa-money-bill-wave"></i> {{ $elan->emekhaqqi }} AZN</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fas fa-eye"></i> {{ $elan->baxis_sayi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark save"  data-url="{{ route('save.elan',['elan_id'=>$elan->id]) }}">
                                            @if (auth()->check())
                                                @php
                                                    $id_arr=explode(",", auth()->user()->save_elan);
                                                    $id_status="";
                                                    foreach ($id_arr as $id) {
                                                        if($id==$elan->id){
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
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div style="padding: 10px 0 10px 0">
                            <a class="boxed-btn3 col-md-12" href="{{ route('elan.add.index') }}">Elan Yerləşdirin ({{ 3-count($elanlar) }}/3 yaratmaq mümkündür)</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


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