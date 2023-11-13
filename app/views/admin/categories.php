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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-category">
                        Add New Category
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Categories Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="cats-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>description</th>
                                            <th>Image</th>
                                            <th> Manage </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (is_array($data['cats'])) {
                                            foreach ($data['cats'] as $cat) {
                                                echo '<tr>
                                                    <td>' . $cat->name . '</td>
                                                    <td>' . $cat->description . '</td>
                                                    <td><img src="' . ROOT . $cat->image . '" width="40" alt="" srcset=""></td>
                                                    <td>
                                                    <div class="d-flex">
                                                    <form method="POST" action="edit_category.php" class="form-inline">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="' . $cat->category_id . '">
                                                        </div>
                                                        <button type="submit" name="edit"><i class="fa fa-edit"></i></button>
                                                    </form>
                                                    <form method="POST" action="delete_category.php" class="form-inline">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="' . $cat->category_id . '">
                                                        </div>
                                                        <button type="submit" name="delete"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    </div>
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
                <div class="modal fade none-border" id="add-category">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Add a category </strong></h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" id="cats" action="<?= ROOT ?>AdminController/manageCategories">
                                    <div class="form-group">
                                        <label for="category_name">Category Name:</label>
                                        <input class="form-control" id="category_name" type="text" name="category_name" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_description">Category Description:</label>
                                        <textarea class="form-control" id="category_description" name="category_description" rows="4" required></textarea><br>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_image">Category Image:</label>
                                        <input type="file" class="form-control-file" id="category_image" name="category_image" accept="image/*" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light save-category">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
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
        });
    </script>
</body>

</html>