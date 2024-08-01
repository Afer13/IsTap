@include('header')
<style>
    .select-box {
        height: 50px;
        overflow-y: auto;
        /* width:50px ; */
        border: 1px solid #e8e8e8;
        border-radius: 4px;
        color: #7a83a9
    }

    option {
        overflow-y: scroll;
    }
</style>
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Elan yerləşdir</h3>
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
                        <h1>Elan yerləşdir</h1>
                    </div>
                </div>
                <div class="apply_job_form white-bg">

                    <form action="{{route('elan.add.post')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input_field">
                                    <input type="text" name="ad" placeholder="Elan adı *"
                                        value="{{ Session('ad') }}">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Ad')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <input type="text" name="sirket" placeholder="Şirkət *"
                                        value="{{ Session('sirket') }}">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Şirkət')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
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
                                            <option @if (Session('kateqoriya_id') == $kateqoriya->id) selected @endif
                                                value="{{ $kateqoriya->id }}">{{ $kateqoriya->ad }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Kateqoriya')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
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
                                            <option @if (Session('seher_id') == $seher->id) selected @endif
                                                value="{{ $seher->id }}">{{ $seher->ad }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Şəhər')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="yas_min">
                                        <option selected value="none">Yaş min *</option>
                                        @for ($i = 18; $i <= 65; $i++)
                                            <option @if (Session('yas_min') == $i) selected @endif
                                                value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Yaş')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="yas_max">
                                        <option selected value="none">Yaş max *</option>
                                        @for ($i = 18; $i <= 65; $i++)
                                            <option @if (Session('yas_max') == $i) selected @endif
                                                value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Yaş')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="tehsil">
                                        <option value="none">Təhsil *</option>
                                        <option @if (Session('tehsil') == 'Elmi Dərəcə') selected @endif value="Elmi Dərəcə">
                                            Elmi Dərəcə</option>
                                        <option @if (Session('tehsil') == 'Ali') selected @endif value="Ali">Ali
                                        </option>
                                        <option @if (Session('tehsil') == 'Natamam ali') selected @endif value="Natamam ali">
                                            Natamam ali</option>
                                        <option @if (Session('tehsil') == 'Orta texniki') selected @endif value="Orta texniki">
                                            Orta texniki</option>
                                        <option @if (Session('tehsil') == 'Orta xüsusi') selected @endif value="Orta xüsusi">
                                            Orta xüsusi</option>
                                        <option @if (Session('tehsil') == 'Orta') selected @endif value="Orta">Orta
                                        </option>
                                        <option @if (Session('tehsil') == 'Yoxdu') selected @endif value="Yoxdu">Yoxdu
                                        </option>
                                    </select>
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Təhsil')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="single_input" style="height: 70px">
                                    <select class="wide select-box col-md-12" name="is_tecrubesi">
                                        <option @if (Session('is_tecrubesi') == 'none') selected @endif value="none">İş
                                            Təcrübəsi *</option>
                                        <option @if (Session('is_tecrubesi') == '1 ildən aşağı') selected @endif
                                            value="1 ildən aşağı">1 ildən aşağı </option>
                                        <option @if (Session('is_tecrubesi') == '1 ildən 3 ilə qədər') selected @endif
                                            value="1 ildən 3 ilə qədər">1 ildən 3 ilə qədər</option>
                                        <option @if (Session('is_tecrubesi') == '3 ildən 5 ilə qədər') selected @endif
                                            value="3 ildən 5 ilə qədər">3 ildən 5 ilə qədər</option>
                                        <option @if (Session('is_tecrubesi') == '5 ildən artıq') selected @endif
                                            value="5 ildən artıq">5 ildən artıq</option>
                                    </select>
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'İş')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <input type="text" name="elaqedar_sexs" placeholder="Əlaqədar şəxs *"
                                        value="{{ Session('elaqedar_sexs') }}">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Əlaqədar')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input_field">
                                    <input type="text" name="eh_min" id="min_eh"
                                        placeholder="Əməkhaqqı min (AZN)" value="{{ Session('min_eh') }}">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Minimum')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input_field">
                                    <input type="text" name="eh_max" id="max_eh"
                                        placeholder="Əməkhaqqı max (AZN)" value="{{ Session('max_eh') }}">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Maksimum')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input_field">
                                    {{-- <div class="switch-wrap "> --}}

                                    <div class="" style="float:left;">
                                        <input type="checkbox" id="dcheckbox" name="eh_r" onclick="clickEH()">
                                        <label for="default-checkbox"></label>
                                    </div>
                                    <div style="float:left;padding:10px;margin-top:9px">Ə/H razılaşma ilə</div>

                                    {{-- </div> --}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <textarea name="is_melumat" id="" cols="30" rows="10" placeholder="İş barədə məlumat *">{{ Session('is_melumat') }}</textarea>
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Məlumat')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="input_field">
                                    <textarea name="is_teleb" id="" cols="30" rows="10" placeholder="Namizəddən tələblər *">{{ Session('is_teleb') }}</textarea>
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Namizəddən')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <textarea name="elave" id="" cols="30" rows="10" placeholder="Əlavə məlumat">{{ Session('elave') }}</textarea>
                                    {{-- @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Əlavə')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif --}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input_field">
                                    <input type="date" name="bitme_tarixi" placeholder="Bitmə tarixi *"
                                        value="{{ Session('bitme_tarixi') }}">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Bitmə')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input_field">
                                    <input type="text" name="telefon" placeholder="Telefon *"
                                        value="{{ Session('telefon') }}">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Telefon')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input_field">
                                    <input type="text" name="email" placeholder="E-mail *"
                                        value="{{ Session('email') }}">
                                    @if ($errors)
                                        @foreach ($errors->all() as $error)
                                            @if (strtok($error, ' ') == 'Email')
                                                <p style="color:red;font-size:12px">{{ $error }}</p>
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
                        1.Bir vakansiyanın 30 gün müddətinə yerləşdirilməsi pulsuz həyata keçirilir. <br>
                        2.Vakansiya yalnız Azərbaycan daxilində olan işləri əhatə etməlidir.<br>
                        3.Vakansiya haqqında elanın ən qısa müddətdə dərc olunması üçün formanın doldurulmasına dair
                        bütün təlimatlara ciddi riayət olunmalıdır. Səliqəsiz doldurulmuş formalar redaktəyə məruz
                        qalacaq və dərhal dərc olunmayacaq.<br>
                        4.Elanların yalnız baş (BÖYÜK) hərflərlə və ya başqa əlifba ilə (translitlə) yazılması
                        qadağandır. Elan bütünlüklə bir dildə olmalıdır.<br>
                        5.Şirkətin adı olan sütunda şirkətin rəsmi, hüquqi adı, həmin müəssisə holdinq tərkibindədirsə,
                        holdinqin adı və şirkətin fəaliyyət istiqaməti (növü) qeyd olunmalıdır.<br>
                        6.Əlaqələr yazılan sütunda aktiv şəhər telefonlarının nömrələri və şirkətin korporativ elektron
                        ünvanları qeyd olunmalıdır.<br>
                        7.İstifadəçi 5 və 6-cı bəndlərə riayət etmədikdə, elan ödənişli əsaslarla qəbul edilir.<br>
                        8.Tibb müəssisələrinin elanları və ya tibbi tərkibli, alış-veriş haqqında, o cümlədən saytda
                        onlayn-satışlı elanlar pulludur.<br>
                        9.«Əmək haqqı» sütununun doldurulması mütləqdir, məbləğ AZN-lə göstərilməlidir. Əgər əmək haqqı
                        500 AZN-ə qədərdirsə, əmək haqqı diapazonu 200 AZN-i; 1000 AZN-ə qədərdirsə 300 AZN-i; 2000
                        AZN-ə qədərdirsə, 500 AZN-i aşmamalıdır.<br>
                        10.Dərc olunmuş elanda əlaqə nömrələrinin, vakansiyanın adının dəyişdirilməsi qadağandır.<br>
                        11.«Namizədə olan tələblər» mümkün qədər ətraflı yazılmalıdır.<br>
                        12.«Mövqenin (vəzifənin) təsviri» də həmçinin iş qrafiki, vəzifə öhdəlikləri və işin şərtləri
                        qeyd olunmaqla, ətraflı yazılmalıdır.<br>
                        13.Mövqe (vəzifə) seçilmiş kateqoriyaya uyğun olmalı, əgər elə kateqoriya yoxdursa, onda
                        «Müxtəlif» adlanan alt-kateqoriyada yerləşdirilməlidir.<br>
                        14.Aşağıdakı kimi elanlar dərhal ləğv olunacaq:<br>

                        &#8226;ədəbsiz, təhqiredici sözlər və ifadələr olan;<br>
                        &#8226;şəbəkə marketinqi və ya qadağan olunmuş, şübhəli fəaliyyət növləri ilə məşğul olan
                        şirkətlərdə iştirak təklifləri olan. <br>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
@if (Session('eh_r')=="on")
    <script>
        $('#dcheckbox').prop('checked',true);
    </script>
@endif
<script>
    // var dcheckbox=$('#dcheckbox');
    if ($('#dcheckbox').prop('checked')) {
            $("#max_eh").prop("disabled", true);
            $("#min_eh").prop("disabled", true);
        } else {
            $("#max_eh").prop("disabled", false);
            $("#min_eh").prop("disabled", false);
        }
    function clickEH() {
        if ($('#dcheckbox').prop('checked')) {
            $("#max_eh").prop("disabled", true);
            $("#min_eh").prop("disabled", true);
        } else {
            $("#max_eh").prop("disabled", false);
            $("#min_eh").prop("disabled", false);
        }
    }
</script>
@include('footer_ozel')
