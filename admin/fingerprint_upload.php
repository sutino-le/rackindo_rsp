<form action="home_admin.php?page=fingerprint_upload_process" method="POST" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="inputEmail4">Upload File CSV</label>
        </div>
        <div class="form-group col-md-6">
            <input class="form-control" type="file" name="filecsv" required>
        </div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary"><i class="fa fa-download"></i> Import</button>
        </div>
    </div>
</form>