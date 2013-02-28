<h1>Search Settings</h1>

<?php echo validation_errors(); ?>

<?php if($this->session->flashdata('infomessage')) {
    // add style
    echo $this->session->flashdata('infomessage');
} ?> 

<?php
echo form_open('ajw/settings');

//echo form_label('Require Pictures', 'requirePictures');
echo form_checkbox('requirePictures', 'accept', $settings['requirePictures']) . ' Require Pictures<br>';

$data = array('name' => 'maxResults','placeholder' => 10,'value' => $settings['maxResults']);
//echo form_label('Max Search Results Displayed: ', 'maxResults');
echo 'Max Search Results Displayed: ' . form_input($data);

echo form_label('Diets: ', 'allowedDiet');
foreach ($settings['diet'] as $diet) {
    
    if ($diet['id'] = NULL) {
        $diet['id'] = FALSE;
    }
    
    echo form_checkbox($diet['id'], 'accept', $diet['id']) . ' ' . $diet['longDescription'] . '<br>'; 
} 

echo form_label('Allergies: ', 'allowedAllergy'); 
foreach ($settings['allergy'] as $allergy) {
    
    if ($allergy['id'] = NULL) {
        $allergy['id'] = FALSE;
    }
    echo form_checkbox($allergy['id'], 'accept', $allergy['id']) . ' ' . $allergy['longDescription'] . '<br>'; 
    //echo $allergy['shortDescription'] . '<br>'; 
} 



        if (isset($settings['exclusions'])) {
            
            echo '<aside class="widget">';
                echo '<h3 class="widget-title">Excluded Ingredients</h3>';


                    foreach ($settings['exclusions'] as $excludedIngredient) {
                        echo '<a href="' . site_url('ajw/includeIngredient/' 
                                         . $excludedIngredient ) . '">( + ) </a>' 
                                         . urldecode($excludedIngredient) . '<br>';
                    }

            echo '</aside> <!-- .widget -->';
        }

?>
    
    <input type="submit" value="Save">
</form>  