<?php
require 'init.php';
?>

<form action="<?php echo baseUrl; ?>encrpt.php" method="post">
    <input type="text" name='password' />
    <input type='submit' value='Convert'/>
</form>
