<section class="recipe">
    <h3><?php echo $recipe['name']; ?></h3>
    <p><?php echo $recipe['yield'] . $recipe['totalTime']; ?></p>
    
    <?php echo $recipe['images']; ?>
    
    <h4>Ingredients</h4>
    <?php foreach ($recipe['ingredientLines'] as $ingredient) {
        echo $ingredient . '<br />';
    } ?>
    
    <h4>Preparation</h4>
    <p>
        <a href="<?php echo $recipe['source']['sourceRecipeUrl']; ?>" class="more-link">
            Read full directions on <?php echo $recipe['source']['sourceDisplayName']; ?> 
            <span class="meta-nav">&rarr;</span>
        </a>
    </p>    
    
    <footer class="entry-meta">
        <?php echo $recipe['rating']; ?>
        
        Source: <a href="<?php echo $recipe['source']['sourceRecipeUrl']; ?>">
                 <cite><?php echo $recipe['source']['sourceDisplayName']; ?></cite></a> 
        
        
        <?php echo $recipe['tagsToString']; ?>

    </footer>
    
</section>

<footer class="attribution">
    <br /><br />
    <small><?php echo $recipe['attribution']['html']; ?></small> 
</footer>