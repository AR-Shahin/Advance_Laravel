<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

</head>
<body>
<div class="container">
    <h1 class="text-center my-2">Drop Zone Image Upload</h1>
    <hr>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ url('drop-data') }}" enctype="multipart/form-data" method="POST" id="form">
        @csrf
        <input type="text" id ="Username" name ="name" class="form-control" /> <br>
        <input type="text" id ="email" name ="email" class="form-control" />
        <br>
        <div class="dropzone" id="my-dropzone" name="mainFileUploader">
            <div class="fallback">
                <input name="file" type="file" multiple id="file" />
            </div>
        </div>
    </form>
    <div>
        <button type="submit" id="submit-all"> upload </button>
    </div>

</div>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    let form = $('form')
    Dropzone.options.myDropzone = {
        url: "drop-data",
        method : 'POST',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        acceptedFiles: "image/*",

        init: function () {

            var submitButton = document.querySelector("#submit-all");
            var wrapperThis = this;

            submitButton.addEventListener("click", function () {
                wrapperThis.processQueue();
               // form.trigger('reset')
                console.log(form);
                window.location.reload()
                document.getElementById('form').reset();

            });

            this.on("addedfile", function (file) {

                // Create the remove button
                var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>Remove File</button>");

                // Listen to the click event
                removeButton.addEventListener("click", function (e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();

                    // Remove the file preview.
                    wrapperThis.removeFile(file);
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });

                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
            });

            this.on('sendingmultiple', function (data, xhr, formData) {
                formData.append("name", $("#Username").val());
                formData.append("email", $("#email").val());
            });
        }
    };
</script>
</body>
</html>
