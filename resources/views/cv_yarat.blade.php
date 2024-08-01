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
                    <h3>CV yerləşdir</h3>
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
                        <h1>CV yerləşdir</h1>
                    </div>
                </div>
                <div class="apply_job_form white-bg">

                    <form action="{{route('cv.yarat')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input_field">
                                    <input type="text" name="ad" placeholder="Ad *" value="{{ Session('ad') }}">
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Ad")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                                
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="input_field">
                                    <input type="text" name="soyad" placeholder="Soyad *" value="{{ Session('soyad') }}">
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Soyad")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input_field">
                                    <input type="text" name="ata_adi" placeholder="Ata adı *" value="{{ Session('ata_adi') }}">
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Ata")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="cins" >
                                        <option value="none">Cins *</option>
                                        <option @if(Session('cins')=="Kişi") selected @endif value="Kişi">Kişi</option>
                                        <option @if (Session('cins')=="Qadın") selected @endif value="Qadın">Qadın</option>
                                    </select>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Cins")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="single_input">
                                    <select class="wide select-box col-md-12" name="yas">
                                        <option selected value="none">Yaş *</option>
                                            @for ($i = 18; $i <= 65; $i++)
                                                <option  @if(Session('yas')==$i) selected @endif value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                    </select>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Yaş")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile03"
                                            aria-describedby="inputGroupFileAddon03" name="img">
                                        <label class="custom-file-label" for="inputGroupFile03">Şəkil yüklə *</label>                                       
                                    </div>                                    
                                </div>
                                @if($errors)
                                    @foreach ($errors->all() as $error)
                                        @if (strtok($error, " ")=="Şəkil")
                                            <p style="color:red;font-size:12px" >{{$error}}</p>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="tehsil">
                                        <option value="none">Təhsil *</option>
                                        <option @if(Session('tehsil')=="Elmi Dərəcə") selected @endif  value="Elmi Dərəcə">Elmi Dərəcə</option>
                                        <option @if(Session('tehsil')=="Ali") selected @endif value="Ali">Ali</option>
                                        <option @if(Session('tehsil')=="Natamam ali") selected @endif  value="Natamam ali">Natamam ali</option>
                                        <option @if(Session('tehsil')=="Orta texniki") selected @endif value="Orta texniki">Orta texniki</option>
                                        <option @if(Session('tehsil')=="Orta xüsusi") selected @endif  value="Orta xüsusi">Orta xüsusi</option>
                                        <option @if(Session('tehsil')=="Orta") selected @endif  value="Orta">Orta</option>
                                        <option @if(Session('tehsil')=="Yoxdu") selected @endif  value="Yoxdu">Yoxdu</option>
                                    </select>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Təhsil")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <textarea name="tehsil_etrafli" id="" cols="30" rows="10" placeholder="Təhsil - Ətraflı">{{ Session('tehsil_etrafli')}}</textarea>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Təhsil-Ətraflı")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="is_tecrubesi">
                                        <option @if(Session('is_tecrubesi')=="none") selected @endif  value="none">İş Təcrübəsi *</option>
                                        <option @if(Session('is_tecrubesi')=="1 ildən aşağı") selected @endif  value="1 ildən aşağı">1 ildən aşağı </option>
                                        <option @if(Session('is_tecrubesi')=="1 ildən 3 ilə qədər") selected @endif  value="1 ildən 3 ilə qədər">1 ildən 3 ilə qədər</option>
                                        <option @if(Session('is_tecrubesi')=="3 ildən 5 ilə qədər") selected @endif  value="3 ildən 5 ilə qədər">3 ildən 5 ilə qədər</option>
                                        <option @if(Session('is_tecrubesi')=="5 ildən artıq") selected @endif value="5 ildən artıq">5 ildən artıq</option>
                                    </select>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="İş")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <textarea name="is_tecrubesi_etrafli" id="" cols="30" rows="10" placeholder="İş təcrübəsi - Ətraflı">{{ Session('is_tecrubesi_etrafli')}}</textarea>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="İş-Təcrübəsi-Ətraflı")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="kateqoriya_id">
                                        <option selected value="none">Kateqoriya *</option>
                                        @foreach ($kateqoriyalar as $kateqoriya)
                                            <option @if(Session('kateqoriya_id')==$kateqoriya->id) selected @endif  value="{{ $kateqoriya->id }}">{{ $kateqoriya->ad }} </option>
                                        @endforeach                                   
                                    </select>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Kateqoriya")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <input type="text" name="sahe" placeholder="Vəzifə *" value="{{ Session('sahe')}}">
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Vəzifə")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="seher_id">
                                        <option selected>Şəhər</option>
                                        @foreach ($seherler as $seher)
                                            <option @if(Session('seher_id')==$seher->id) selected @endif value="{{ $seher->id }}">{{ $seher->ad }} </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input_field">
                                    <input type="text" name="min_eh" placeholder="Minimum əməkhaqqı (AZN)" value="{{ Session('min_eh') }}">
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Minimum")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <textarea name="bacariqlar" id="" cols="30" rows="10" placeholder="Bacarıqlar *">{{ Session('bacariqlar')}}</textarea>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Bacarıqlar")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <textarea name="elave_melumat" id="" cols="30" rows="10" placeholder="Əlavə məlumat">{{ Session('elave_melumat')}}</textarea>
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Əlavə")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input_field">
                                    <input type="text" name="telefon" placeholder="Telefon *" value="{{ Session('telefon') }}">
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Telefon")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input_field">
                                    <input type="text" name="email" placeholder="E-mail" value="{{ Session('email') }}" >
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, " ")=="Email")
                                                <p style="color:red;font-size:12px" >{{$error}}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="submit_btn">
                                    <button class="boxed-btn3 w-100" type="submit">Yerləşdir</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="job_sumary">
                    <div class="summery_header">
                        <h3>Qaydalar</h3>
                    </div>
                    <div class="job_content">
                        1.CV/rezümelərin yerləşdirilməsi pulsuzdur. Hər bir adam 30 gün müddətində yalnız bir rezüme
                        yerləşdirə bilər.<br>
                        2.CV/rezümenin ən qısa müddətdə dərc olunması üçün formanın doldurulmasına dair bütün
                        təlimatlara ciddi riayət olunmalıdır. Səliqəsiz doldurulmuş formalar redaktəyə məruz qalacaq və
                        dərhal dərc olunmayacaq.<br>
                        3.* işarəsi olan sahələr mütləq doldurulmalıdır . <br>
                        4.Elanların baş (BÖYÜK) hərflərlə tərtib olunması, o cümlədən latın hərfləri ilə yazılması
                        qadağandır. Elanın mətni bütünlüklə bir dildə olmalıdır.<br>
                        5.Aşağıdakı tərkibli rezümelərin yerləşdirilməsi qadağandır: <br>

                        &#8226; bilərəkdən həqiqətə uyğun olmayan şəxsi məlumat;<br>
                        &#8226; ədəbsiz, təhqiredici sözlər və ifadələr;<br>
                        &#8226; reklam xarakterli;<br>
                        &#8226; xidmət təklifləri.<br>
                        6.CV/rezümedə şəkil varsa, aşağıdakı şərtlərə cavab verməlidir:<br>

                        &#8226; şəkildə yalnız bir adam olmalıdır;<br>
                        &#8226;namizədin üzü aydın görünməlidir;<br>
                        &#8226;filtrlərsiz olmalıdır.<br>
                        7.CV/rezüme yerləşdirilərkən, «Vəzifə» sütununda kateqoriyaya uyğun olan yalnız bir mövqe qeyd
                        olunmalıdır.<br>
                        8.«Təhsil» sütununda namizədin bitirdiyi təhsil müəssisəsinin, yiyələndiyi ixtisasın adı və
                        təhsil aldığı vaxt qeyd olunmalıdır.<br>
                        9.«İş təcrübəsi» sütununda namizədin iş yeri, vəzifəsi və çalışdığı müddət qeyd olunmalıdır.<br>
                        10.«Bacarıqlar» sütununda namizədin peşəkar bacarıqlarının, bildiyi dillərin, kompyuter
                        proqramlarının və s. qeyd olunması tövsiyə olunur.<br>
                        11.«Özünüz haqqında» adlı sütunda namizədin şəxsi xüsusiyyətləri, hobbisi, maraqları və s. qeyd
                        olunur.<br>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@include('footer_ozel')
