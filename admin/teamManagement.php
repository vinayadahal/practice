<?php
require '../init.php';
require 'controller/teamController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Team Management</h3>
    <div class="panel">
        <a href="<?php echo baseUrl ?>admin/home/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
        <a href="<?php echo baseUrl ?>admin/addTeam/" style="outline: 0px;" title="Add"><i class="glyphicon glyphicon-plus-sign back_btn"></i></a>
        <table class="table table-hover table_override_content">
            <tr>
                <th width="20">S.No.</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Description</th>
                <th colspan="2" style="text-align: center">Action</th>
            </tr>
            <?php
            if (!empty($info)) {
                foreach ($info as $info) {
                    ?>
                    <tr>
                        <td width="5"><a href="<?php echo baseUrl ?>admin/editTeam/<?php echo $info['id']; ?>/"><?php echo $info['sn']; ?></a></td>
                        <td><a href="<?php echo baseUrl ?>admin/editTeam/<?php echo $info['id']; ?>/"><img src="<?php echo $info['photo'] ?>" class="productImg" /></a></td>
                        <td width="150"><a href="editTeam/<?php echo $info['id']; ?>/"><?php echo $info['name']; ?></a></td>
                        <td><?php echo $info['designation']; ?></td>
                        <td><?php
                            if (strlen($info['desc']) < 290) {
                                echo $info['desc'];
                            } else {
                                echo substr($info['desc'], 0, 290) . '...';
                            }
                            ?></td>
                        <td width="10"><a href="<?php echo baseUrl ?>admin/editTeam/<?php echo $info['id']; ?>/" title="Edit"><i class="glyphicon glyphicon-list-alt glyphicon_list_override"></i></a></td>
                        <td width="10"><a href="<?php echo baseUrl ?>admin/deleteTeam/<?php echo $info['id']; ?>/" title="Delete" onclick="return confirm('Are you sure?');"><i class="glyphicon glyphicon-remove glyphicon_delete_override"></i></a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<?php
require 'includes/footer.php';
