<?php
function generateStickyFormField($fieldName, $fieldValue, $defaultValue = "", $error = "") {
    ?>
    <input name="<?php echo $fieldName; ?>" type="text" value="<?php echo htmlspecialchars(!empty($fieldValue) ? $fieldValue : $defaultValue); ?>">
    <span><?php echo $error; ?></span>
    <?php
}
?>
<?php
function generateStickyPassField($fieldName, $fieldValue, $error = "") {
    ?>
    <input name="<?php echo $fieldName; ?>" type="password" value="<?php echo htmlspecialchars($fieldValue); ?>">
    <span><?php echo $error; ?></span>
    <?php
}
?>

