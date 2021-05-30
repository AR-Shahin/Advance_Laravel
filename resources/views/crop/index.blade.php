<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <meta name="_token" content="{{csrf_token()}}" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css"/>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

</head>
<body>
    <div class="container">
        <h1 class="text-center">Crop Image via Croppie</h1>
        <hr>
        <div class="card">
        <div class="card-body">
          <div class="form-group">
            @csrf
            <div class="row">
              <div class="col-md-4" style="border-right:1px solid #ddd;">
                <div id="image-preview"></div>
              </div>
              <div class="col-md-4" style="padding:75px; border-right:1px solid #ddd;">
                <p><label>Select Image</label></p>
                <input type="file" name="upload_image" id="upload_image" />
                <br />
                <br />
                <button class="btn btn-success crop_image">Crop & Upload Image</button>
              </div>
              <div class="col-md-4" style="padding:75px;background-color: #333">
                <div id="uploaded_image" align="center"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        $(document).ready(function(){

  $image_crop = $('#image-preview').croppie({
    enableExif:true,
    viewport:{
      width:200,
      height:200,
      type:'circle'
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').change(function(){
    var reader = new FileReader();

    reader.onload = function(event){
      $image_crop.croppie('bind', {
        url:event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type:'canvas',
      size:'viewport'
    }).then(function(response){
        let data = {file : response}
      axios.post('{{ route("crop.store") }}',data)
      .then(res =>{
          console.log(res.data);
          var crop_image = '<img src="../'+res.data+'" />';
          $('#uploaded_image').html(crop_image);
      })
    });
  });

});
    </script>
</body>
</html>
