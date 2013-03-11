<div class="big_search">
    
        <br><!--<p>enter some food related terms..</p>-->
    
<?php echo validation_errors(); ?>

<?php
$attributes = array('class' => '', 'role' => 'search');
echo form_open('ajw/search', $attributes); 
?> 
    <div class="searchform">
        <label class="assistive-text" for="s">Search for:</label>
        <input id="tags" 
               type="search" 
               name="search_phrase" 
               value="<?php echo set_value('search_phrase'); ?>" 
               placeholder="Search..." 
               required>
        <input type="submit" value="Search">
    </div>
    
    
    <h3 id="filter_button">filters<br>&or;</h3>
    <div id="filter_container2">
    <div class="filter_container" id="filter_container">
        
        
        
        <div class="filter">
            <h4>Courses</h4>

            <ul>
            <?php 
                
                foreach ($settings['course'] as $course) {
                    echo '<li>'; 
                    echo form_checkbox($course['id'], 'accept', FALSE) . ' ' . $course['description']; 
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
                    echo form_checkbox($holiday['id'], 'accept', FALSE) . ' ' . $holiday['description']; 
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
                    echo form_checkbox($cuisine['id'], 'accept', FALSE) . ' ' . $cuisine['description']; 
                    echo form_hidden($cuisine['id'] . '-val', '&allowedCuisine[]=' . $cuisine['searchValue']); 
                    echo '</li>'; 
                }
            ?> 
            </ul>
        </div>

        
    </div>
    </div>
    
</form>  

</div> <!-- end big_search -->