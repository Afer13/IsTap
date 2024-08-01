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
                    <h3>Profil</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--/ bradcam_area  -->
<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single_carousel">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (Session('updateOk'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session('updateOk') }}
                                </div>
                            @endif
                            
                            <div class="single_testmonial d-flex align-items-center">
                                
                                <div style="padding: 20px">
                                    <img style="width: 200px;height:200px;border-radius:20px" src="{{asset('ishtap/cv_img/afer359442.jpg')}}" alt="">
                                </div>
                                
                                <div class="info" style="float:left">
                                    <p><span style="color: rgb(253, 124, 3)"><b>- Ad : </b></span>{{ $user->name }}</p>
                                    <p><span style="color: rgb(253, 124, 3)"><b>- E-Mail : </b></span>{{ $user->email }}</p>
                                    <p><span style="color: rgb(253, 124, 3)"><b>- Yaradılma Tarixi : </b></span>{{ $user->created_at }}</p>
                                    <p><span style="color: rgb(253, 124, 3)"><b>- Yeniləmə Tarixi : </b></span>{{ $user->updated_at }}</p>
                                    <a href="{{ route('profil.update.index') }}" style="width:100%;font-size:100%" class="genric-btn success circle">Məlumatı Yenilə</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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