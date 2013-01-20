<h2>Recipe Display</h2>

<div class="attribution">
    <?php echo $recipe['attribution']['html']; ?>    
</div>

<section class="recipe">
    <h3><?php echo $recipe['name']; ?></h3>
    <p><?php echo 'Yield: ' . $recipe['yield'] . ', Total Time: ' . $recipe['totalTime']; ?></p>
    
    <?php
    if ( ! empty($recipe['images']) ) {
        echo '<img src="' . $recipe['images'][0]['hostedLargeUrl'] . '" />';
    } else {
        echo '(no picture provided)';
    }
    ?>
    
    <h4>Ingredients</h4>
    <?php foreach ($recipe['ingredientLines'] as $ingredient) {
        echo $ingredient . '<br />';
    } ?>
    
    <p>Source: <a href="<?php echo $recipe['source']['sourceRecipeUrl']; ?>">
                        <?php echo $recipe['source']['sourceDisplayName']; ?></a></p>
    
    
</section>

<p>end of recipe</p>