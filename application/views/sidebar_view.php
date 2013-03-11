
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
    
    <!-- separate section for the current excluded ingredients, hidden while playing with a combined view
    <?php
        
        if (isset($settings['exclusions'])) {
            
            echo '<aside class="widget">';
                echo '<h3 class="widget-title">Excluded Ingredients</h3>';


                    foreach ($settings['exclusions'] as $excludedIngredient) {
                        echo '<a href="' . site_url('ajw/includeIngredient/' 
                                         . $excludedIngredient . '/'
                                         . urlencode($yummly['q']) . '/' 
                                         . $yummly['start']) . '" title="include">( + )</a> ' 
                                         . urldecode($excludedIngredient) . '<br>';
                    }



            echo '</aside>';
        }
    ?>
    -->
    
    
	<aside class="widget">
		<h3 class="widget-title">Exclude Ingredient</h3>
        
        <?php
            if (isset($settings['exclusions'])) {
            
                //echo '<aside class="widget">';
                    //echo '<h3 class="widget-title">Excluded Ingredients</h3>';


                        foreach ($settings['exclusions'] as $excludedIngredient) {
                            echo '<a href="' . site_url('ajw/includeIngredient/' 
                                             . $excludedIngredient . '/'
                                             . urlencode($yummly['q']) . '/' 
                                             . $yummly['start']) . '" title="include">( + )</a> ' 
                                             . '<del>' . urldecode($excludedIngredient) . '</del><br>';
                        }



                //echo '</aside> <!-- .widget -->';
            }
        
        
            foreach ($yummly['ingredient_counts'] as $ingredient => $count) {
                echo '<a href="' . site_url('ajw/excludeIngredient/' 
                                 . $ingredient . '/'
                                 . urlencode($yummly['q']) . '/' 
                                 . $yummly['start']) . '" title="exclude">( - )</a> ' 
                                 . $ingredient . '<br>';
            }
        ?>
        
		
	</aside> <!-- .widget -->

</div> <!-- #sidebar --> 
