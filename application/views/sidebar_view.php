
<div id="sidebar" role="complementary" class="span4">
    <?php // <form>
        echo validation_errors();
        
        $attributes = array('class' => '', 'role' => 'search');
        echo form_open('ajw/search', $attributes); 
    ?> 
    
        <!-- search -->
        <aside>
            <div class="searchform">
                <label class="assistive-text" for="s">Search for:</label>
                <input id="tags" 
                       type="search" 
                       name="search_phrase" 
                       value="<?php echo $yummly['q']; ?>" 
                       placeholder="Search Again!" 
                       required>
                <input type="submit" value="Search">
            </div>
        </aside> <!-- .widget -->

        <!-- filters -->
<div class="filter_container_sidebar" id="filter_container_sidebar">
        
        
        
        <div class="filter">
            <h4>Courses</h4>

            <ul>
            <?php 
                $filter_checked;
                foreach ($settings['course'] as $course) {
                    echo '<li>'; 
                    if (array_key_exists($course['id'], $yummly['checkedFilters'])) {
                        $filter_checked = TRUE;
                    } else {
                        $filter_checked = FALSE;
                    }
                    
                    echo form_checkbox($course['id'], 'accept', $filter_checked) . ' ' . $course['description']; 
                    echo form_hidden($course['id'] . '-val', '&allowedCourse[]=' . $course['searchValue']);
                    echo '</li>'; 
                }
            ?> 
            </ul>

        </div>
        <div class="filter">
            <h4>Holidays</h4>
            
            <ul>
            <?php 
                
                foreach ($settings['holiday'] as $holiday) {
                    echo '<li>'; 
                    if (array_key_exists($holiday['id'], $yummly['checkedFilters'])) {
                        $filter_checked = TRUE;
                    } else {
                        $filter_checked = FALSE;
                    }
                    echo form_checkbox($holiday['id'], 'accept', $filter_checked) . ' ' . $holiday['description']; 
                    echo form_hidden($holiday['id'] . '-val', '&allowedHoliday[]=' . $holiday['searchValue']); 
                    echo '</li>'; 
                }
            ?> 
            </ul>
        </div>
        <div class="filter">
            <h4>Cuisines</h4>
            
            <ul>
            <?php 
                
                foreach ($settings['cuisine'] as $cuisine) {
                    echo '<li>'; 
                    if (array_key_exists($cuisine['id'], $yummly['checkedFilters'])) {
                        $filter_checked = TRUE;
                    } else {
                        $filter_checked = FALSE;
                    }
                    echo form_checkbox($cuisine['id'], 'accept', $filter_checked) . ' ' . $cuisine['description']; 
                    echo form_hidden($cuisine['id'] . '-val', '&allowedCuisine[]=' . $cuisine['searchValue']); 
                    echo '</li>'; 
                }
            ?> 
            </ul>
        </div>

        
    </div>


    
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
    
    <!-- exclude ingredients -->
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
