<div class="big_search">
    
    <p>enter some food related terms..</p>
    
<?php echo validation_errors(); ?>

<?php
$attributes = array('class' => 'searchform', 'role' => 'search');
echo form_open('ajw/search', $attributes); 
?>
    <label class="assistive-text" for="s">Search for:</label>
    <input id="tags" type="search" name="search_phrase" value="<?php echo set_value('search_phrase'); ?>" placeholder="Search..." required>
    <input type="submit" value="Search">
</form>  

</div> <!-- end big_search -->