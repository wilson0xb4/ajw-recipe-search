
<div id="sidebar" role="complementary" class="span4">

    <?php echo validation_errors(); ?> 

    <?php
    $attributes = array('class' => 'searchform', 'role' => 'search');
    echo form_open('ajw/search', $attributes); 
    ?> 
        <label class="assistive-text" for="s">Search for:</label>
        <input id="tags" type="search" name="search_phrase" placeholder="Search..." required>
        <input type="submit" value="Search">
    </form>  
    
    <?php
        
        if (isset($settings['exclusions'])) {
            
            echo '<aside class="widget">';
                echo '<h3 class="widget-title">Excluded Ingredients</h3>';


                    foreach ($settings['exclusions'] as $excludedIngredient) {
                        echo '<a href="' . site_url('ajw/includeIngredient/' 
                                         . $excludedIngredient . '/'
                                         . urlencode($yummly['q']) . '/' 
                                         . $yummly['start']) . '">( + ) </a>' 
                                         . urldecode($excludedIngredient) . '<br>';
                    }



            echo '</aside> <!-- .widget -->';
        }
    ?>
    
    
	<aside class="widget">
		<h3 class="widget-title">Ingredient Counts</h3>
        
        <?php
            foreach ($yummly['ingredient_counts'] as $ingredient => $count) {
                echo '<a href="' . site_url('ajw/excludeIngredient/' 
                                 . $ingredient . '/'
                                 . urlencode($yummly['q']) . '/' 
                                 . $yummly['start']) . '">( - ) </a>' 
                                 . $ingredient . ' (' . $count . ')<br>';
            }
        ?>
        
		
	</aside> <!-- .widget -->

</div> <!-- #sidebar --> 
