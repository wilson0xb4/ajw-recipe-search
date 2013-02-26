
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
    
    
    
	<aside class="widget">
		<h3 class="widget-title">Ingredient Counts</h3>
        
        <?php
            foreach ($yummly['ingredient_counts'] as $ingredient => $count) {
                echo '<a href="' . site_url('ajw/search/' 
                                 . $yummly['q'] . '/' 
                                 . $yummly['start'] . '/' 
                                 . $ingredient ) . '">( - ) </a>' 
                                 . $ingredient . ' (' . $count . ')<br>';
            }
        ?>
        
		
	</aside> <!-- .widget -->

</div> <!-- #sidebar --> 
