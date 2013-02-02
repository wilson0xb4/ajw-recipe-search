<h1>Search Settings</h1>

<?php echo validation_errors(); ?>

<?php
echo form_open('ajw/settings');

echo form_label('Require Pictures', 'requirePictures');
echo form_checkbox('requirePictures', 'accept', $settings['requirePictures']);

$data = array('name' => 'maxResults','placeholder' => 10,'value' => $settings['maxResults']);
echo form_label('Max Search Results Displayed: ', 'maxResults');
echo form_input($data);

echo '<br><br><br><br>future additions...';
echo form_label('Allowed Ingredients: ', 'allowedIngredients');
echo form_label('Excluded Ingredients: ', 'excludedIngredients');
echo form_label('Allowed Diets: ', 'allowedDiet');
echo form_label('Allergies: ', 'allowedAllergy');

//echo $settings[0]['maxResults'] . '<br>' . $settings[0]['requirePictures'];

?>
    
    
    
    
    <input type="submit" value="Save">
</form>  