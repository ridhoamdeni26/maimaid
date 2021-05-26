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
</head>

<body>


    <!-- CONTENT -->

    <section>
    <div style="padding-top: 30px;">
        <div class="container">
            <h1>MaiMaid.ID All Data</h1>
            <br>
            <br>
            <div style="padding-bottom: 20px;">
                <a href="<?= base_url('/create'); ?>"><button type="button" class="btn btn-outline-secondary btn-lg">Create Data</button></a>
            </div>
        </div>
    </div>

    </section>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row gx-5">
                    <div class="col">
                        <table id="example" class="cell-border">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Date Of birth</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataAll">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <div>

<div class="modal fade" id="detailModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Route</h4>
            </div>
            <div class="modal-body">
                <div id="googleHeatMap" style="width:100%;height:700px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
var SITE_URL = "http://52.77.78.127:8002/";
$(document).ready(function() {
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
    getAllData();
    getDataID();
});

function getAllData() {
    $.ajax(
        {
			url: SITE_URL + 'user/read/',
			method: 'post',
			dataType: 'json',
			async: false,
			cache: false,
			success: function (result) {
				var data = result['data']['rows'];
                var allData = ''
                // $('#dataAll').html(allData)
                for (var i = 0; i < data.length; i++) {
                    var beach = data[i];
                    var id = beach['id'];
                    allData +=
                    "<tr>" + 
                        "<td>" + (i + 1) + "</td>" +
                        "<td>" + beach['fullname'] + "</td>" +
                        "<td>" + beach['email'] + "</td>" +
                        "<td>" +
                            " "
                            if (beach['gender'] == '1') {
                                allData +=
                                    "Pria"
                            } else if (beach['gender'] == '2') {
                                allData +=
                                    "Wanita"
                            }else {
                                allData +=
                                "No Data"
                            }
                        "</td>"
                        allData += "<td>" + beach['dob'] + "</td>"
                        allData += "<td>" + "<button type='button'" +
                        "class='btn btn-info' data-toggle='modal'" +
                        "onclick='getDataID(" + '"' + beach['id'] + '"' + ")' " +
                        "class='btn btn-info' id='Detail' data-toggle='modal' data-target='#detailModal'>Detail</button>" +
                        "</td>" +
                    "<tr>"
                }
                $('#dataAll').html(allData)
		}
	});
}

function getDataID(id) {
    console.log(id)
}
</script>

</body>

</html>