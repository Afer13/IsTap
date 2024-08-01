@include('header')
<style>
    .select-box{
    height:50px ;
    overflow-y:auto ;
    /* width:50px ; */
    border:1px solid #e8e8e8 ;
    border-radius: 4px;
    color: #7a83a9
    }
    option{
    overflow-y:scroll ;
    }
</style>
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>CV yenilə</h3>
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
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <h1>Profil Yenilə</h1>
                    </div>
                </div>
                <div class="apply_job_form white-bg">

                    <form action="{{route('profil.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input_field">
                                    <input type="text" name="name" placeholder="İstifadəçi Adı" value="{{ $user->name }}">
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="İstifadəçi")
                                                <p style="color:red;font-size:14px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="input_field">
                                    <input type="text" name="email" placeholder="E-Mail" value=" {{ $user->email }}">
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Email")
                                                <p style="color:red;font-size:14px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="submit_btn">
                                    <button class="boxed-btn3 w-100" type="submit">Yenilə</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@include('footer_ozel')
