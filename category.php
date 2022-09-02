<?php 
$title = 'Category listing and CRUD of category page Developed using PHP, Bootstrap and AJAX By optimumitapps.com';
$description =  'Category listing and CRUD of category page Developed using PHP, Bootstrap and AJAX';
require_once('common/header.php'); 

?>
  <!-- add category form -->
  <div class="container">
    <div class="row mt-5">
      <div class="col col-12 col-md-12">
        <form method="post" id="cform" class="p-3 px-4 shadow">
          <h5 class="mb-4 border-bottom pb-3">Add Category</h5>
          <div class="form-group">
            <label for="formGroupExampleInput">Category name</label>
            <input type="text" name="name" class="form-control cname" id="formGroupExampleInput" placeholder="Category name" />
            <div class="imsg">
              <p class="text-danger imsg" style="opacity:0">msg</p>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary idbtn">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- category table -->
  <div class="container ">
    <h3 class="mt-4 pb-2 text-center">Categories</h3>
    <hr class="m-auto styled-border">
    <div class="row my-5">
      <div class="col col-12 col-md-12">
        <table class="table text-center table-bordered shadow">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody class="category "></tbody>
        </table>
      </div>
    </div>
  </div>




  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button type="button" class="btn btn-close" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="mform">
            <div class="form-group">
              <label for="formGroupExampleInput">Edit Category</label>
              <input type="text" name="id" class="iid" style="display:none;" />
              <input type="text" name="name" class="form-control iname" id="formGroupExampleInput" placeholder="Category Name" />
              <div>
                <p class="text-danger mmsg " style="opacity:0">msg</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary sbtn">Save changes</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php require_once('common/footer.php'); ?>
  <!--/Footer -->

  <script src="js/categorty_script.js"></script>
</body>

</html>