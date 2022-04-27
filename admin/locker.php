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
    <br>
    <table id="locker_data" class="table table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NO.</th>
                <th>NPK</th>
                <th>Name</th>
                <th>Job Title</th>
                <th>Position</th>
                <th>Status</th>
                <th>Locker Number</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    <div class="modal fade" id="info" role="dialog">
        <div class="modal-dialog modal-lg">
            <div id="content-data-info"></div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#locker_data').DataTable({
            "order": [2, "asc"],
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100, 200],
                [10, 25, 50, 100, 200]
            ],
            "ajax": {
                url: "locker_data.php",
                type: "post"
            }

        });
    });
    </script>

</div>