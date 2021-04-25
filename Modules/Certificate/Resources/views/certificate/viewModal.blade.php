<div class="modal fade admin-query"
     id="showCertificateModal{{ @$certificate->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-body m-0 p-0">
                @php
                    $family = explode(',',$certificate->font_family);
                    $font = str_replace(" ","+",$family[0]);
                @endphp
                <link
                    href="https://fonts.googleapis.com/css2?family={{$font}}&display=swap"
                    rel="stylesheet">
                @php
                    $body = $certificate->body;
                    $body = str_replace("[name]",\Illuminate\Support\Facades\Auth::user()->name,$body);
                    $body = str_replace("[course]","Course Name",$body);
                @endphp
                <div id="download_certificate_{{$certificate->id}}"
                     class=" m-0 p-0 student-certificate preview">
                    <div class="row  m-0 p-0">
                        <div class="col-lg-12 m-0 p-0 text-center">

                            <img style="top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    position: relative;
    margin: auto;display: inline-block" alt="" class="img-fluid" id="certificate_image"
                                 src="{{isset($certificate->image)?asset($certificate->image):''}}">

                            <div style="position: absolute;    width: 100%;
    top: 20%;">
                                <div class="row image_date text-center  p-0"
                                     style="margin-top: {{isset($certificate->y_image_date)?$certificate->y_image_date:'0'}}px;">
                                    <div class=" col-xl-6  col-sm-6  col-md-6  col-lg-6  text-left">
                                        <img
                                            style="display:{{isset($certificate->user_image)?$certificate->user_image==1?'block':'none':'none'}};margin-left: {{isset($certificate->position_image)?$certificate->position_image:'0'}}%"
                                            src="{{asset('public/uploads/staff/user.png')}}"
                                            height="{{isset($certificate->image_height)?$certificate->image_height:'0'}}px"
                                            id="user_image" alt="user_image">
                                    </div>
                                    <div class="col-xl-6  col-sm-6  col-md-6  col-lg-6   m-0 p-0 text-right">
                                        <p class="p-2 certificate_date" id="user_date"
                                           style=" color:  {{isset($certificate->date_color)?$certificate->date_color:'#383CC1'}};display:{{isset($certificate->user_date)?$certificate->user_date==1?'block':'none':'none'}};margin-right: {{isset($certificate->position_date)?$certificate->position_date:'0'}}%">{{date('d/m/Y')}}</p>
                                    </div>
                                </div>
                                <div class="certificate-middle text-center m-0 p-0 w-100">
      <span
          style="display:inline-block;color:{{ isset($certificate->font_color)?$certificate->font_color:'' }};font-family:{{ isset($certificate->font_family)?$certificate->font_family:'' }};font-weight: 600; position: relative;font-size:{{ isset($certificate->font_family)?$certificate->font_size:'' }}px;"
          class="certificate_title">{{ isset($certificate->title)?$certificate->title:'' }}</span><br>
                                    <span class="certificate_body "
                                          style=" position: relative;    display: inline-block; padding-left: {{isset($certificate->x_portion)?$certificate->x_portion:'0'}}%;
                                              padding-right:  {{isset($certificate->x_portion)?$certificate->x_portion:'0'}}%;  top:  {{isset($certificate->y_portion)?$certificate->y_portion:'0'}}px;">
                        {!! isset($certificate->body)?$certificate->body:'' !!}
                    </span>
                                </div>

                                <div class="row m-0 p-0 mt-2">
                                    <div class="col-xl-12  col-sm-12  col-md-12  col-lg-12  sign_div text-center"
                                         style="{{isset($certificate->sign_text)?'':'display:none'}};margin-left:{{isset($certificate->sign_position_x)?$certificate->sign_position_x:0}}%;margin-top:{{isset($certificate->sign_position_y)?$certificate->sign_position_y:0}}px">
                                        <img alt="" class="certificate_signature"
                                             id="certificate_signature"
                                             style="height: {{isset($certificate->sig_image_height)?$certificate->sig_image_height:''}}px"
                                             src="{{isset($certificate->signature)?asset($certificate->signature):''}}">
                                        <p class="sign_border"
                                           style="color: {{isset($certificate->sign_color)?$certificate->sign_color:'#383CC1'}} ;">
                                            ------------------------
                                        </p>
                                        <p style="color: {{isset($certificate->sign_color)?$certificate->sign_color:'#383CC1'}} "
                                           class="mt_m_10 sign_text">
                                            {{isset($certificate->sign_text)?$certificate->sign_text:''}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
