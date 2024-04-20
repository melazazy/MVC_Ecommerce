<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<?= $this->view("zay_shop/d_head", $data); ?>

<body>
    <!-- Left Panel -->
    <?= $this->view("zay_shop/left_panel", $data); ?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?= $this->view("zay_shop/d_header", $data); ?>
        <!-- /#header -->
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-product">
                        Add New Product
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>description</th>
                                            <th>price</th>
                                            <th>Category</th>
                                            <th> Image </th>
                                            <th> Stock </th>
                                            <th> featured </th>
                                            <th> Managements </th>
                                        </tr>
                                    </thead>
                                    <!-- <td><button type="submit"><i class=\'menu-icon fa fa-edit\'></i></button></td> -->
                                    <tbody>
                                        <?php
                                        if (is_array($data['products'])) {
                                            foreach ($data['products'] as $product) {
                                                echo '<tr>
                                                    <td>' . $product->name . '</td>
                                                    <td>' . $product->description . '</td>
                                                    <td>' . $product->price . '</td>
                                                    <td>' . $product->category_id . '</td>
                                                    <td><img src="' . ROOT, $product->image_url . '" width="40" alt="" srcset=""></td>
                                                    <td>' . $product->stock . '</td>
                                                    <td>' . $product->featured . '</td>

                                                
                                                    <td class="align-middle text-center"> 
                                                        <ul class="list-inline m-0">
                                                            <li class="list-inline-item">
                                                                <button class="btn btn-success btn-sm rounded-0 edit-product" data-toggle="modal" data-target="#editModal" onclick="' . ROOT . 'AdminController/editProduct(' . $product->product_id . ')" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                                <button class="btn btn-success btn-sm rounded-0 edit-product" data-toggle="modal" data-target="#editModal" onclick="openEditModal(' . $product->product_id . ')" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <button class="btn btn-danger btn-sm rounded-0 delete-product" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade none-border" id="add-product">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Add a Product </strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" id="products" action="<?= ROOT ?>AdminController/manageProducts">
                                    <div class="">
                                        <label for="product_name">Product Name:</label>
                                        <input class="form-control" type="text" id="product_name" name="product_name" required><br>
                                    </div>
                                    <div class="">
                                        <label for="product_description">Product Description:</label>
                                        <textarea class="form-control" name="description" rows="4" id="product_description" required></textarea><br>
                                    </div>
                                    <div class="">
                                        <label for="productPrice">Price:</label>
                                        <input class="form-control" type="number" step="0.01" id="productPrice" name="Price" required><br>
                                    </div>
                                    <div class="">
                                        <label for="productCategory">Category:</label>
                                        <select class="form-control" id="productCategory" name="productCategory" required>
                                            <?php
                                            // Fetch categories from the database (replace with your database query)
                                            $categories = $data['cats'];
                                            foreach ($categories as $category) {
                                                echo "<option value='$category->category_id'>$category->name</option>";
                                            }
                                            ?>
                                        </select><br>
                                    </div>

                                    <div class="">
                                        <label for="stock">stock:</label>
                                        <input type="number" class="form-control" id="stock" name="stock" value="1" required>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1">
                                        <label class="form-check-label" for="featured">Featured</label>
                                    </div>
                                    <div class="">
                                        <label for="product_image">Product Image:</label>
                                        <input type="file" class="form-control-file" id="product_image" name="product_image" accept="image/*" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success waves-effect waves-light save-product">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        <div class="clearfix"></div>


        <!-- Edit Modal -->
        <div class="modal" id="editModal@@@@@@@" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="editModalBody">
                        <!-- Product details form will be displayed here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="saveEditedProduct()">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- openEdit Modal -->
        <div class="modal" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Product</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Form for editing product details -->
                        <form id="editProductForm" method="post" action="">
                            <!-- Edit product fields go here -->
                            <label for="editProductName">Product Name:</label>
                            <input type="hidden" name="action" value="edit">
                            <input type="text" id="editProductName" name="editProductName" required>
                            <!-- Add other fields as needed -->

                            <button type="button" class="btn btn-primary" onclick="saveChanges()">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <?= $this->view("zay_shop/d_footer", $data); ?>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/main.js"></script>

    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/dashboard/assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();

            // Delete Button Click Event
            $('.delete-product').click(function() {
                // Handle delete functionality here
                alert('Delete button clicked');
                // You can replace the alert with the actual delete logic
            });
        });

        function openEditModal(productId) {
            // Use Ajax to call a PHP function that retrieves product details based on productId
            $.ajax({
                type: 'POST',
                url: ROOT + 'AdminController/editProductDetails(' + productId + ')', // Update the URL to your PHP file
                data: {
                    productId: productId
                },
                success: function(response) {
                    // Parse the JSON response and populate the Edit modal with the details
                    console.log(response);
                    let productDetails = JSON.parse(response);
                    $('#editProductName').val(productDetails.name);
                    // Add code to populate other fields as needed

                    // Show the Edit modal
                    $('#editModal').modal('show');
                },
                error: function() {
                    alert('Error fetching product details.');
                }
            });
        }
    </script>
</body>

</html>