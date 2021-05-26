<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MaiMaid All Data</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
</head>

<body>


    <!-- CONTENT -->

    <section>
        <div style="padding-top: 30px;">
            <div class="container">
                <h1>MaiMaid.ID Create Data</h1>
                <br>
                <br>

            <div style="padding-bottom: 20px;">
                <a href="<?= base_url('/'); ?>"><button type="button" class="btn btn-outline-secondary btn-lg">Check All Data</button></a>
            </div></div>
        </div>

    </section>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row gx-5">
                    <form action="" name="createData">
                        <div class="mb-3 row">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input type="text" class="form-control error" id="fullname" name="fullname" 
                                placeholder="Enter Your Full Name" require>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control error" id="email" name="email" placeholder="youremail@gmail.com">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password">
                        </div>
                        <div class="col-md-6 error">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="1">
                                <label class="form-check-label">Pria</label>
                            </div>
                        <div>
                        <div class="col-md-6">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                            <label class="form-check-label">Wanita</label>
                          </div>
                        <div>
                        <br>
                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Date Of Birth</label>
                        <div class="input-group date">
                            <input type="text" id="datepicker" class="form-control error" require>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <div>
                        <br><br>
                        <button type="submit" id="addData" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
        <div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>


<script>
    var SITE_URL = "http://52.77.78.127:8002/";
    $(document).ready(function () {
        $('#example').DataTable({
            "searching": false,
            "ordering": false,
            "columnDefs": [{
                "orderable": true,
                "scrollX": true
            }],
            "pageLength": 10,
            "DisplayLength": 10,
        });
        
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
        });

        $("form[name='createData']").validate({
            rules: {
                fullname: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password : {
                    required: true,
                    minlength : 6
                },
                password_confirm : {
                    required: true,
                    equalTo : "#password"
                }
            },
            messages: {
                fullname: {
                    required: "Please Enter Your Full Name",
                    minlength: "Please Min 3"
                },
                email: "Please enter a valid email address",
                password: {
                    required: "Please Enter Your Password",
                    minlength: "Please Min 6"
                },
                password_confirm : {
                    required: "Please Same To Your Password",
                    equalTo : "Hey That Not Same In Your Password"
                }
            },
            submitHandler: function(form) {
                form.serialize();
            }
        });

    });

    $('body').on('click', '#addData', function (event) {
        if ($("form[name='createData']").valid()) {
            // event.preventDefault();
            var fullname = $("#fullname").val();
            var email = $("#email").val();
            var password = $('#password').val();
            var gender = $('input[name="gender"]:checked').val();
            var dob = $("#datepicker").val();
            
            $.ajax({
                url: SITE_URL + 'user/create',
                type: "POST",
                data: {
                    fullname: fullname,
                    email: email,
                    password: password,
                    gender: gender,
                    dob: dob
                },
                dataType: 'json',
                success: function (data) {
                    swal({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Success For Add Your Data',
                        timer: 1500
                    }).then((success) => {
                        window.location = "<?= base_url('/'); ?>";
                    })
                }
            });
        }
    });
</script>