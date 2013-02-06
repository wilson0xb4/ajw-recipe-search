
<div id="sidebar" role="complementary" class="span4">

    <?php echo validation_errors(); ?> 

    <?php
    $attributes = array('class' => 'searchform', 'role' => 'search');
    echo form_open('ajw/search', $attributes); 
    ?> 
        <label class="assistive-text" for="s">Search for:</label>
        <input type="search" name="search_phrase" placeholder="Search..." required>
        <input type="submit" value="Search">
    </form>  
    
    
    
	<aside class="widget">
		<h3 class="widget-title">Sidebar</h3>
        
        <p>Future search modifiers..</p>
		
	</aside> <!-- .widget -->

</div> <!-- #sidebar --> 
