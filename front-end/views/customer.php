<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Hello Test</title>
</head>

<body>

    <?php include_once("navbar.php"); ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h1>Customer Data
                    <button class="btn btn-danger" id="add-btn"><i class="fa fa-plus"></i></button>
                </h1>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <table class="table" id="list_Table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="databody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nis">Nic</label>
                            <input type="text" class="form-control" id="Nic" readonly autocomplete=off>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Customer</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" autocomplete=off>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Customer</label>
                            <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat" autocomplete=off>
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phone" placeholder="Masukkan nomor telepon" autocomplete=off>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_update">Simpan</button>
                    <button type="button" class="btn btn-primary" id="btn_save">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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
                        tr.push('<td><button class=\'btn btn-success\' id=\'editMode\' data-id=' + data.values[i].Id_user + '>Edit</button>&nbsp;&nbsp;<button class=\'btn btn-danger\' id=\'deleteMode\' data-id=' + data.values[i].Id_user + '>Delete</button></td>');
                        tr.push('</tr>');
                    }
                    $('#databody').append($(tr.join('')));
                },
                error: function(jqXHR, textStatus, err) {
                    alert("text status " + textStatus + ", err " + err);
                },
            });
        }

        $('#add-btn').click(function() {
            $('#exampleModal').modal('show');
            $('#exampleModalLabel').text('Tambah Customer');
            $('#btn_update').hide();
        })

        $('#btn_save').click(function() {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "http://127.0.0.1:4000/customers",
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


        $(document).delegate('#editMode', 'click', function() {
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

        $('#btn_update').click(function() {
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

        $(document).delegate('#deleteMode', 'click', function() {
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