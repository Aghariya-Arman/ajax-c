<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alldata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <input type="search" class="form-control mb-3" id="search" placeholder="search your data">
                <table class="table" id="student-table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('getstudent') }}",

            success: function(data) {
                //  console.log(data.users);

                if (data.users.length > 0) {
                    for (let i = 0; i < data.users.length; i++) {
                        $('#tablebody').append(`<tr>
                            <td>` + data.users[i]['id'] + `</td>
                            <td>` + data.users[i]['name'] + `</td>
                            <td>` + data.users[i]['email'] + `</td>
                   
                            <td><a class="btn btn-warning" href="edituser/` + data.users[i]['id'] + `">Update</a>
                            <a class="btn btn-danger" data-id="` + data.users[i]['id'] + `">Delete</a></td>
                        </tr>`);

                    }
                }
            },
            error: function(e) {
                console.log(e.responseText);

            }
        });


        //delete code here\
        $("#tablebody").on("click", ".btn-danger", function() {
            var id = ($(this).attr("data-id"));
            var obj = $(this);
            $.ajax({
                type: "GET",
                url: "/deleteuser/" + id,
                success: function(data) {
                    // console.log(data);
                    $(obj).parent().parent().remove();
                },
                error: function(e) {
                    console.log("Error" + e.responseText);
                }
            });
        });

        // serch code here\
        $('#search').on('keyup', function() {
            var value = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('getstudent') }}",
                data: {
                    'search': value
                },
                success: function(data) {
                    // console.log(data);
                    $('#tablebody').empty();
                    if (data.users.length > 0) {
                        for (let i = 0; i < data.users.length; i++) {
                            $('#tablebody').append(`
                            <tr>
                                <td>${data.users[i]['id']}</td>
                                <td>${data.users[i]['name']}</td>
                                <td>${data.users[i]['email']}</td>
                            </tr>
                        `);
                        }
                    } else {
                        // Display 'No results found' if no users match
                        $('#tablebody').append(
                            '<tr><td colspan="3">No results found</td></tr>');
                    }
                },
                error: function(e) {
                    console.log('Error' + e.responseText);
                }
            });
        });



    });
</script>
