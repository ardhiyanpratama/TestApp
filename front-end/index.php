<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Test Yo</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form class="form-signin">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember password</label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {

        getDataCustomer();

        function reloadPage() {
            location.reload(true);
        }

        function getDataCustomer() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "http://127.0.0.1:4000/customers",
                success: function(data) {
                    var tr = []
                    for (var i = 0; i < data.values.length; i++) {
                        tr.push('<tr>');
                        tr.push('<td>' + data.values[i].Id_user + '</td>');
                        tr.push('<td>' + data.values[i].Name_user + '</td>');
                        tr.push('<td>' + data.values[i].Address_user + '</td>');
                        tr.push('<td>' + data.values[i].Phone_user + '</td>');
                        tr.push('<td><button class=\'editMode\' data-id=' + data.values[i].Id_user + '>Edit</button>&nbsp;&nbsp;<button class=\'deleteMode\' data-id=' + data.values[i].Id_user + '>Delete</button></td>');
                        tr.push('</tr>');
                    }
                    $('#databody').append($(tr.join('')));
                },
                error: function(jqXHR, textStatus, err) {
                    alert("text status " + textStatus + ", err " + err);
                },
            });
        }


        $(document).delegate('.editMode', 'click', function() {
            var ids = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "http://127.0.0.1:4000/customers/" + ids,
                success: function(data) {
                    $('#exampleModal').modal('show');
                    for (var i = 0; i < data.values.length; i++) {
                        $('#Nic').val(data.values[i].Id_user)
                        $('#nama').val(data.values[i].Name_user)
                        $('#alamat').val(data.values[i].Address_user)
                        $('#phone').val(data.values[i].Phone_user)
                    }
                },
                error: function(jqXHR, textStatus, err) {
                    alert("text status " + textStatus + ", err " + err);
                },
            });
        })

        $('#btn_save').click(function() {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "http://127.0.0.1:4000/updateCustomers",
                data: {
                    Id_user: $('#Nic').val(),
                    Name_user: $('#nama').val(),
                    Address_user: $('#alamat').val(),
                    Phone_user: $('#phone').val(),
                },
                success: function(data) {
                    $('#exampleModal').modal('hide');
                    alert("sukses", data.values)
                    reloadPage();
                },
                error: function(jqXHR, textStatus, err) {
                    alert("text status " + textStatus + ", err " + err);
                },
            });
        })

        $(document).delegate('.deleteMode', 'click', function() {
            var ids = $(this).data('id');

            if (confirm("Apakah anda ingin menghapus data ini?")) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "http://127.0.0.1:4000/deleteCustomers",
                    data: {
                        Id_user: ids
                    },
                    success: function(data) {
                        alert("sukses", data.values)
                        reloadPage();
                    },
                    error: function(jqXHR, textStatus, err) {
                        alert("text status " + textStatus + ", err " + err);
                    },
                });
            } else {

            }

        })

    })
</script>