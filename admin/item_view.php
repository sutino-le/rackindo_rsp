<style>
.modal-content {
    position: relative;
    background-image: url("images/as.JPG");
    -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
    box-shadow: 0 3px 9px rgba(0, 0, 0, .5);

}

.modal-header {
    background: rgba(2, 2, 2, 0.5);
}

.modal-title {
    color: white;
}

.modal-footer {
    background: rgba(2, 2, 2, 0.5);
}

.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #9BDDD7;
}

.table-hover>tbody>tr:hover {
    background-color: #9BDDD7;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container-fluid">
    <table>
        <tr>
            <td>
                <a class="dropdown-item" href="home_admin.php?page=item_input" title="Input Data"><button type="button"
                        class="btn btn-success btn-sm" title="Untuk Menambah Data"><span
                            class="glyphicon glyphicon-plus"></span><i class="fa fa-plus"></i> Input Item</button></a>
            </td>
            <td>
                <a class="dropdown-item" href="home_admin.php?page=item_up_input" title="Input Data"><button
                        type="button" class="btn btn-success btn-sm" title="Enter Purchase Proposal"><span
                            class="glyphicon glyphicon-plus"></span><i class="fa fa-plus"></i> Input Purchase
                        Proposal</button></a>
            </td>
            <td>
                <a href="item_view_report.php" target="_blank"><button class="btn btn-sm btn-primary"><i
                            class="fa fa-file-excel"></i> Export to Excel</button></a>
            </td>
        </tr>
    </table>
</div>




<div class="container-fluid">
    <br>
    <table id="item_view_data" class="table table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Item Name</th>
                <th>Picture</th>
                <th>In</th>
                <th>Out</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    <div class="modal fade" id="edit" role="dialog">
        <div class="modal-dialog modal-lg">
            <div id="content-data"></div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#item_view_data').DataTable({
            "order": [2, "asc"],
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100, 200],
                [10, 25, 50, 100, 200]
            ],
            "ajax": {
                url: "item_view_data.php",
                type: "post"
            }

        });
    });
    </script>
    <script>
    $(document).on('click', '#getEdit', function(e) {
        e.preventDefault();
        var karyawan_adm = $(this).data('id');
        //alert(karyawan_adm);
        $('#content-data').html('');
        $.ajax({
            url: 'data_karyawan_edit.php',
            type: 'POST',
            data: 'karyawan_adm=' + karyawan_adm,
            dataType: 'html'
        }).done(function(data) {
            $('#content-data').html('');
            $('#content-data').html(data);
        }).fial(function() {
            $('#content-data').html('<p>Error</p>');
        });
    });
    </script>

</div>