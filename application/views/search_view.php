<h2>Search for some recipes!</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('ajw/search') ?>
     
    <label for="search_phrase">Enter search phrase: </label>
    <input type="input" name="search_phrase" value="<?php echo set_value('search_phrase'); ?>" /><br />
    
    <input type="submit" name="submit" value="Search!" />
</form>