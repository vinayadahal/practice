<?php
require '../init.php';
require 'controller/tripController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Trip Management</h3>
    <div class="panel">
        <a href="<?php echo baseUrl ?>admin/home/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
        <a href="<?php echo baseUrl ?>admin/addTrip/" style="outline: 0px;" title="Add"><i class="glyphicon glyphicon-plus-sign back_btn"></i></a>
        <a href="javascript:void(0);" onclick="generateIcons('<?php echo baseUrl; ?>admin/generateThumb')"><button class="admin_edit_btn" style="float: right;">Generate Icons</button></a>
        <table class="table table-hover table_override_content">
            <tr>
                <th width="20">S.No.</th>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Area</th>
                <th>Duration</th>
                <th>Description</th>
                <th colspan="2" style="text-align: center">Action</th>
            </tr>
            <?php
            if (!empty($info)) {
                foreach ($info as $info) {
                    ?>
                    <tr>
                        <td width="5"><a href="<?php echo baseUrl ?>admin/editTrip/<?php echo $info['id']; ?>/"><?php echo $sn++; ?></a></td>
                        <td><a href="<?php echo baseUrl ?>admin/editTrip/<?php echo $info['id']; ?>/"><img src="<?php echo $info['imgPath'] ?>" class="productImg" /></a></td>
                        <td width="150"><a href="<?php echo baseUrl ?>admin/editTrip/<?php echo $info['id']; ?>/"><?php echo $info['title']; ?></a></td>
                        <td><?php echo $info['category']; ?></td>
                        <td><?php echo $info['area']; ?></td>
                        <td><?php echo $info['duration']; ?></td>
                        <td><?php
                            if (strlen($info['desc']) < 290) {
                                echo $info['desc'];
                            } else {
                                echo substr($info['desc'], 0, 290) . '...';
                            }
                            ?></td>
                        <td width="10"><a href="<?php echo baseUrl ?>admin/editTrip/<?php echo $info['id']; ?>/" title="Edit"><i class="glyphicon glyphicon-list-alt glyphicon_list_override"></i></a></td>
                        <td width="10"><a href="<?php echo baseUrl ?>admin/deleteTrip/<?php echo $info['id']; ?>/" title="Delete" onclick="return confirm('Are you sure?');"><i class="glyphicon glyphicon-remove glyphicon_delete_override"></i></a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
    <nav>
        <ul class="pagination">
            <li><a href="<?php echo baseUrl ?>admin/tripManagement/<?php echo 1; ?>/"><span aria-hidden="true">&laquo; First</span><span class="sr-only">Previous</span></a></li>
            <?php
            if (!empty($num_pages)) {
                for ($i = 1; $i <= $num_pages; $i++) {
                    ?>
                    <li><a href="<?php echo baseUrl ?>admin/tripManagement/<?php echo $i; ?>/"><?php echo $i; ?></a></li>
                    <?php
                }
            }
            ?>
            <li><a href="<?php echo baseUrl ?>admin/tripManagement/<?php echo $num_pages; ?>/"><span aria-hidden="true">Last &raquo;</span><span class="sr-only">Next</span></a></li>
        </ul>
    </nav>
</div>
<?php
require 'includes/footer.php';
