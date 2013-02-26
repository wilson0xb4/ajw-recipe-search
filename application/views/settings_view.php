<h1>Search Settings</h1>

<?php echo validation_errors(); ?>

<?php if($this->session->flashdata('infomessage')) {
    // add style
    echo $this->session->flashdata('infomessage');
} ?> 

<?php
echo form_open('ajw/settings');

echo form_label('Require Pictures', 'requirePictures');
echo form_checkbox('requirePictures', 'accept', $settings['requirePictures']);

$data = array('name' => 'maxResults','placeholder' => 10,'value' => $settings['maxResults']);
echo form_label('Max Search Results Displayed: ', 'maxResults');
echo form_input($data);

echo form_label('Diets: ', 'allowedDiet');
foreach ($settings['diet'] as $diet) {
    echo $diet['shortDescription'] . '<br>';
}

echo form_label('Allergies: ', 'allowedAllergy');
foreach ($settings['allergy'] as $allergy) {
    echo $allergy['shortDescription'] . '<br>';
}


?>
    
    <input type="submit" value="Save">
</form>  