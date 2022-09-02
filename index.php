<?php 
$title = 'Product listing and CRUD of Product Developed using PHP, Bootstrap and AJAX By optimumitapps.com';
$description =  'Product listing and CRUD of Product Developed using PHP, Bootstrap and AJAX';

require_once('common/header.php'); 

?>
    <!-- form -->
    <div class="container">
        <div class="row mt-5">
            <div class="col col-12 col-md-12">
                <form method="post" id="cform" enctype="multipart/form-data" class="p-3 px-4 shadow">
                    <h5 class="mb-4 border-bottom pb-3">Add Product</h5>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Name</label>
                        <input type="text" class="form-control pname" id="formGroupExampleInput"
                            placeholder="Product Name" name="name" />
                        <div class="pndata">
                          <p style="opacity:0">msg</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Price</label>
                        <input type="text" name="price" class="form-control pprice" id="formGroupExampleInput2"
                            placeholder="Product Price" />
                        <div class="pdata">
                             <p style="opacity:0">msg</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="img">Choose an Image</label><br />
                        <input type="file" name="file" class="form-control-file" id="file">
                        <div class="idata">
                        <p style="opacity:0">msg</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput2">Category</label><br />
                        <div class='displayCategory'>
                        </div>
                        <div class="cdata">
                            <p style="opacity:0">msg</p>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary submit_btn">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="mt-4 pb-2 text-center">Products</h3>
        <hr class="m-auto styled-border">
        <div class="row my-5 ">
            <div class="col col-12 col-md-12">
                <div class="table-responsive">
                <table class="table text-center table-bordered shadow">
                    <thead>
                        <tr> 
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col " >Action</th>
                        </tr>
                    </thead>
                    <tbody class="products "></tbody>
                </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Products</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="mform" >
                        <div class="form-group ">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="hidden" name="modelID" class="form-control modelID" id="formGroupExampleInput"
                                placeholder="Category Name" style="display:none" />
                            <input type="text" name="modelName" class="form-control name" id="formGroupExampleInput"
                                placeholder="add category" />
                            <div>
                                <p class="text-danger nmsg "></p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="formGroupExampleInput">Price</label>

                            <input type="text" name="modelPrice" class="form-control price" id="formGroupExampleInput"
                                placeholder="Category Price" />
                            <div>
                                <p class="text-danger pmsg "></p>
                            </div>
                        </div>
                        <label for="formGroupExampleInput2">Category</label><br />
                        <div class="category_in_model">
                        </div>
                        <div>
                            <p class="text-danger cmsg "></p>
                        </div>

                  
                        <div class="form-group pt-1">
                          <label for='thumb' >Image</label><br />
                          <input type="hidden" name="oldPicture" class="oldPicture" >
                          <img src="" class="picture img-fluid img-thumbnail" id='thumb' name="picture" width="100vw"><br />
                        <label for="img">Click to change image</label><br />
                        <input type="file" name="newFile" class="form-control-file" id="newFile">
                        <div class="imdata">
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
    <script src="js/product_script.js"></script>
</body>

</html>