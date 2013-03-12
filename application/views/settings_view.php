

<?php 
echo form_open('ajw/settings');
echo '';

echo '<h1>Search Settings</h1>';

echo validation_errors();
if($this->session->flashdata('infomessage')) {
    // add style
    echo $this->session->flashdata('infomessage');
}




echo '<div class="settings_container">';

    echo '<div class="settings_row">';
        $data = array('name' => 'maxResults','placeholder' => 10,'value' => $settings['maxResults']);
        echo 'Results Per Page: ' . form_input($data);

        echo form_checkbox('requirePictures', 'accept', $settings['requirePictures']) . ' Require Pictures';
        echo '<input type="submit" value="Save">';
    echo '</div>';

    echo '<div class="settings_row">';
        echo '<div class="column">';
            echo '<h4>Diets</h4>'; //form_label('Diets: ', 'allowedDiet');
            foreach ($settings['diet'] as $diet) {
                echo form_checkbox('diet_' . ($diet['id']), 'accept', $settings['diet_' . $diet['id']]) . ' ' . $diet['longDescription'] . '<br>'; 
            } 
        echo '</div>';

        echo '<div class="column">';
            echo '<h4>Allergies</h4>'; //form_label('Allergies: ', 'allowedAllergy');
            foreach ($settings['allergy'] as $allergy) {
                echo form_checkbox('allergy_' . ($allergy['id']), 'accept', $settings['allergy_' . $allergy['id']]) . ' ' . $allergy['longDescription'] . '<br>'; 
            }
        echo '</div>';

        echo '<div class="column">';
            if (isset($settings['exclusions'])) {

                //echo '<aside class="widget">';
                    echo '<h4>Excluded Ingredients</h4>';

                        foreach ($settings['exclusions'] as $excludedIngredient) {
                            echo '<a href="' . site_url('ajw/includeIngredient/' 
                                             . $excludedIngredient ) . '" title="include ingredient!">( + )</a> ' 
                                             . urldecode($excludedIngredient) . '<br>';
                        }

                //echo '</aside> <!-- .widget -->';
            }

        echo '</div>';
    echo '</div>';
    
echo '</div>';

?>
    
    
</form>  