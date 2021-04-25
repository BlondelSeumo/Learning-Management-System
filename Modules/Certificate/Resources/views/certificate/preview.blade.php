<div class="previewBox" style="position: sticky;
    top: 0;
    right: 0;
    min-height: 400px;
    background: #fff;
    border-radius: 10px;
    margin-top: 25px;">
    <img id="certificateResult" src="@if(isset($certificate)){{route('certificate.view',$certificate->id)}}@endif"
         alt="" class='w-100'>


</div>
