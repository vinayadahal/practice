<?php
require '../init.php';
require 'controller/reviewController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Client's Review</h3>
    <div class="panel">
        <a href="<?php echo baseUrl ?>admin/contentManagement/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
        <table class="table table-hover table_override_content">
            <tr>
                <th width="20">S.No.</th>
                <th>Quotation</th>
                <th>Review</th>
                <th>Client Name</th>
                <th>Country</th>
                <th>Email</th>
                <th colspan="4" style="text-align: center">Action</th>
            </tr>
            <?php
            if (!empty($getInfo)) {
                $i = 1;
                foreach ($getInfo as $info) {
                    ?>
                    <tr>
                        <td ><a href="<?php echo baseUrl ?>admin/editInfo?id=<?php echo $info['id']; ?>"><?php echo $i++; ?></a></td>
                        <td width='200'>
                            <a href="<?php echo baseUrl ?>admin/editInfo?id=<?php echo $info['id']; ?>">
                                <?php
                                if (!empty($info['title'])) {
                                    if (strlen($info['title']) < 80) {
                                        echo $info['title'];
                                    } else {
                                        echo substr($info['title'], 0, 80) . '...';
                                    }
                                } else {
                                    echo "No Quote Set";
                                }
                                ?>
                            </a>
                        </td>
                        <td width='400'>
                            <?php
                            if (strlen($info['description']) < 174) {
                                echo $info['description'];
                            } else {
                                echo substr($info['description'], 0, 174) . '...';
                            }
                            ?>
                        </td>
                        <td><?php echo ucfirst($info['name']); ?></td>
                        <td><?php echo $info['country']; ?></td>
                        <td><?php echo $info['email']; ?></td>
                        <td width="10"><a href="<?php echo baseUrl ?>admin/editReview/<?php echo $info['id']; ?>/" title="Edit"><i class="glyphicon glyphicon-list-alt glyphicon_list_override"></i></a></td>
                        <td width="10"><a href="<?php echo baseUrl ?>admin/deleteReview/<?php echo $info['id']; ?>/" title="Delete" onclick="return confirm('Sure,you want to delete this?');"><i class="glyphicon glyphicon-remove glyphicon_delete_override"></i></a></td>
                        <td width="10">
                            <?php if (!empty($info['title'])) { ?>
                                <a href="<?php echo baseUrl ?>admin/publish/<?php echo $info['id']; ?>/" title="Publish" onclick="return confirm('Sure, you want to publish it?');"><i class="glyphicon glyphicon-floppy-save glyphicon_delete_override" style="color:#0a0"></i></a>
                            <?php } ?>
                        </td>
                        <td width="10">
                            <?php if (!empty($info['title'])) { ?>
                                <a href="<?php echo baseUrl ?>admin/unpublish/<?php echo $info['id']; ?>/" title="Hide" onclick="return confirm('Sure, you want to hide it?');"><i class="glyphicon glyphicon-floppy-remove glyphicon_delete_override"></i></a>
                                <?php } ?>
                        </td>
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
