<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form-Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form id="myform">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Enter Email</label>
                        <input type="email" name="email" id="email" class="form-control">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    {{-- 
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#myform").submit(function(event) {
                event.preventDefault();

                var form = $("#myform")[0];
                var data = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "{{ route('add') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location.href = "http://localhost:8000/get-data";
                        // alert("Data submitted successfully: " + response.res);
                        // $("input[type='text']").val(" ");
                        // $("input[type='email']").val(" ");
                        // $("input[type='password']").val(" ");

                    },
                    error: function(e) {
                        console.error("Error:", e.responseText);
                    }
                });

            });

        });
    </script>
</body>

</html>
