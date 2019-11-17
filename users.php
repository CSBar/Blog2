<?php
$edit = isset( $_GET['edit'] ) && is_numeric( $_GET['edit'] ) ? $_GET['edit'] : '';
$del = isset( $_GET['del'] ) && is_numeric( $_GET['del'] ) ? $_GET['del'] : '';
?>

<!DOCTYPE html>
<html lang="en" xml:lang="en" itemscope="itemscope" itemtype="http://schema.org/Organization">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=yes">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="robots" content="noindex">

        <title>CMS - Admin</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include_once 'includes/css.php'; ?>
    </head>

    <body>

        <?php include_once 'includes/side-bar.php'; ?>

        <div class="container">
            <legend>Users</legend>
             
            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#create"><span class="glyphicon glyphicon-plus"></span> Create</button>
            
            <div class="row">


                <div class="col-md-12">
                    <div class="table-responsive">


                        <table id="mytable" class="table table-bordred table-striped">

                            <thead>

                            <th><input type="checkbox" id="checkall" /></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Edit</th>

                            <th>Delete</th>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td><input type="checkbox" class="checkthis" /></td>
                                    <td>King James</td>
                                    <td>king.james@gmail.com</td>
                                    <td>+1 212-586-7000</td>
                                    <td>1335 Avenue of the Americas, New York, NY 10019, United States</td>
                                    <td>Active</td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit"><button id="edit-row-1" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"><span page-id="1" event-action="edit" class="page-action glyphicon glyphicon-pencil"></span></button></p>
                                    </td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete"><button id="del-row-1" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span page-id="1" event-action="del" class="page-action glyphicon glyphicon-trash"></span></button></p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td><input type="checkbox" class="checkthis" /></td>
                                    <td>King James</td>
                                    <td>king.james@gmail.com</td>
                                    <td>+1 212-586-7000</td>
                                    <td>1335 Avenue of the Americas, New York, NY 10019, United States</td>
                                    <td>Active</td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit"><button id="edit-row-2" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"><span page-id="2" event-action="edit" class="page-action glyphicon glyphicon-pencil"></span></button></p>
                                    </td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete"><button id="del-row-2" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span page-id="2" event-action="del" class="page-action glyphicon glyphicon-trash"></span></button></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox" class="checkthis" /></td>
                                    <td>King James</td>
                                    <td>king.james@gmail.com</td>
                                    <td>+1 212-586-7000</td>
                                    <td>1335 Avenue of the Americas, New York, NY 10019, United States</td>
                                    <td>Active</td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit"><button id="edit-row-3" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"><span page-id="3" event-action="edit" class="page-action glyphicon glyphicon-pencil"></span></button></p>
                                    </td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete"><button id="del-row-3" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span page-id="3" event-action="del" class="page-action glyphicon glyphicon-trash"></span></button></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox" class="checkthis" /></td>
                                    <td>King James</td>
                                    <td>king.james@gmail.com</td>
                                    <td>+1 212-586-7000</td>
                                    <td>1335 Avenue of the Americas, New York, NY 10019, United States</td>
                                    <td>Active</td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit"><button id="edit-row-4" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"><span page-id="4" event-action="edit" class="page-action glyphicon glyphicon-pencil"></span></button></p>
                                    </td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete"><button id="del-row-4" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"><span page-id="4" event-action="del" class="page-action glyphicon glyphicon-trash"></span></button></p>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                        <div class="clearfix"></div>
                        <ul class="pagination pull-right">
                            <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="functions/user-create.php" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Create Your Detail</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="modal-title">Name</label>
                                <input type="text" name="name" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label class="modal-title">E-mail</label>
                                <input type="text" name="email" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label class="modal-title">Password</label>
                                <input type="password" name="password" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label class="modal-title">Phone</label>
                                <input type="text" name="phone" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label class="modal-title">Address</label>
                                <textarea name="address" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="modal-title">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Create</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="functions/user-edit.php" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="modal-title">Name</label>
                                <input type="text" name="name" class="form-control" value="King James">
                            </div>
                            <div class="form-group">
                                <label class="modal-title">E-mail</label>
                                <input type="text" name="email" class="form-control" value="king.james@gmail.com">
                            </div>
                            <div class="form-group">
                                <label class="modal-title">Password</label>
                                <input type="password" name="password" class="form-control" value="123456">
                            </div>
                            <div class="form-group">
                                <label class="modal-title">Phone</label>
                                <input type="text" name="phone" class="form-control" value="+1 212-586-7000">
                            </div>
                            <div class="form-group">
                                <label class="modal-title">Address</label>
                                <textarea name="address" rows="2" class="form-control">1335 Avenue of the Americas, New York, NY 10019, United States</textarea>
                            </div>
                            <div class="form-group">
                                <label class="modal-title">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $edit; ?>">
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="functions/user-delete.php" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $del; ?>">
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="js/check-box.js"></script>

        <script type="text/javascript">            
            <?php if ( $edit ): ?>
                <?php echo "$('#edit-row-$edit').trigger('click');"; ?>
            <?php endif; ?>
            <?php if ( $del ): ?>
                <?php echo "$('#del-row-$del').trigger('click');"; ?>
            <?php endif; ?>
            $('.page-action').on('click', function () {
                var $attrEventAction = $(this).attr('event-action');
                var $attrPageId = $(this).attr('page-id');
                location.href = '?' + $attrEventAction + '=' + $attrPageId;
            });
        </script>
    </body>

</html>
