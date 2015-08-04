<?php
require '../init.php';
require 'controller/contentController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Content Management</h3>
    <div class="panel">
        <a href="<?php echo baseUrl ?>admin/home/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
        <?php if ($role == 'dev') { ?><a href="<?php echo baseUrl ?>admin/addContent/" style="outline: 0px;" title="Add"><i class="glyphicon glyphicon-plus-sign back_btn"></i></a><?php } ?>
        <a href="<?php echo baseUrl ?>admin/manageTeam/"><button class="admin_edit_btn" style="float: right;">Manage Team</button></a>
        <a href="<?php echo baseUrl ?>admin/clientReview/"><button class="admin_edit_btn" style="float: right;">Client's Review</button></a>
        <table class="table table-hover table_override_content">
            <tr>
                <th width="20">S.No.</th>
                <th>Title</th>
                <th>Description</th>
                <th colspan="2" style="text-align: center">Action</th>
            </tr>
            <?php
            if (!empty($getInfo)) {
                $i = 1;
                foreach ($getInfo as $info) {
                    ?>
                    <tr>
                        <td ><a href="<?php echo baseUrl ?>admin/editInfo/<?php echo $info['id']; ?>"><?php echo $i++; ?></a></td>
                        <td><a href="<?php echo baseUrl ?>admin/editInfo/<?php echo $info['id']; ?>"><?php echo $info['title']; ?></a></td>
                        <td><?php echo $info['desc']; ?></td>
                        <td width="10"><a href="<?php echo baseUrl ?>admin/editInfo/<?php echo $info['id']; ?>/" title="Edit"><i class="glyphicon glyphicon-list-alt glyphicon_list_override"></i></a></td>
                        <?php if ($role == 'dev') { ?><td width="10"><a href="<?php echo baseUrl ?>admin/deleteInfo/<?php echo $info['id']; ?>/" title="Delete" onclick="return confirm('Are you sure?');"><i class="glyphicon glyphicon-remove glyphicon_delete_override"></i></a></td><?php } ?>
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
