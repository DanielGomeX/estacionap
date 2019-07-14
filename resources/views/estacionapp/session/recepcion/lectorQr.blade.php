@extends('layouts.layout')

@section('content')
<div class="container section animated fadeIn slower">
  <h1>Scanner QR</h1>
  <div class="video-scan">
    <video id="preview" class="scanner"></video>
  </div>
</div>

<script type="text/javascript" src="js/instascan.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  let opts = {
  // Whether to scan continuously for QR codes. If false, use scanner.scan() to manually scan.
  // If true, the scanner emits the "scan" event when a QR code is scanned. Default true.
  continuous: true,
  
  // The HTML element to use for the camera's video preview. Must be a <video> element.
  // When the camera is active, this element will have the "active" CSS class, otherwise,
  // it will have the "inactive" class. By default, an invisible element will be created to
  // host the video.
  video: document.getElementById('preview'),
  
  // Whether to horizontally mirror the video preview. This is helpful when trying to
  // scan a QR code with a user-facing camera. Default true.
  mirror: false,
  
  // Whether to include the scanned image data as part of the scan result. See the "scan" event
  // for image format details. Default false.
  captureImage: true,
  
  // Only applies to continuous mode. Whether to actively scan when the tab is not active.
  // When false, this reduces CPU usage when the tab is not active. Default true.
  backgroundScan: true,
  
  // Only applies to continuous mode. The period, in milliseconds, before the same QR code
  // will be recognized in succession. Default 5000 (5 seconds).
  refractoryPeriod: 5000,
  
  // Only applies to continuous mode. The period, in rendered frames, between scans. A lower scan period
  // increases CPU usage but makes scan response faster. Default 1 (i.e. analyze every frame).
  scanPeriod: 1
}; 
	//git
  Instascan.Camera.getCameras().then(cameras => {
    let scanner = new Instascan.Scanner(opts);
    

    scanner.addListener('scan', content => {
      scanner.stop();
      document.getElementById("ver").innerHTML = content;

      $(document).ready(function(){
  /* In laravel you have to pass this CSRF in meta for ajax request  */
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});


  var qr = content;

  $.ajax({

   type:'POST',

   url:'localhost:8000/ajaxQR',

   data:{qr:qr},

   success:function(data){

    alert(data.success);
  },
  error:function(data){
    alert('Error');
  }

})
    });
    if (cameras.lenght > 0) {
      scanner.camera = cameras[0];
      scanner.start();
    } else {
      scanner.camera = cameras[1];
      scanner.start();
    }

  }).catch(e => console.error(e));


</script>







<div id="ver" name ='qr'> </div>
@endsection

