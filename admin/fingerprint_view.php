<!-- /.row -->

<form action="home_admin.php?page=fingerprint_download" method="POST">
  <div class="form-row">
    <div class="form-group col-md-2">
    <label for="inputEmail4">Download Fingerprint</label>
    </div>
    <div class="form-group col-md-6">
      <select class="form-control" name="mesin_ip" id="mesin_ip">
        <option value="">Select machine</option>
        <option value=""></option>
        <option value="192.168.1.202">Machine 2</option>
        <option value="192.168.1.203">Machine 3</option>
        <option value="192.168.1.204">Machine 4</option>
    </select>
    </div>
    <div class="form-group col-md-4">
      <button type="submit" class="btn btn-primary"><i class="fa fa-download"></i> Download</button>
    </div>
  </div>
</form>

<div class="row">
          <div class="col-12">
            <div class="card m-auto">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap"  id="fingerprint_view_data">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>PIN</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>

                <script>
                    $(document).ready(function(){
                        $('#fingerprint_view_data').DataTable({
                            "order": [ 1, "asc" ],
                            "processing": true,
                            "serverSide":true,
                            "lengthMenu": [[10, 25, 50,100, 200], [10, 25, 50,100, 200]],
                            "ajax":{
                                url:"fingerprint_view_data.php",
                                type:"post"
                            }

                        });
                    });
                </script>



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>