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
        <span class="meta-rating"><?php echo $recipe['rating']; ?></span>
        
        <span class="meta-source">Source: <a href="<?php echo $recipe['source']['sourceRecipeUrl']; ?>">
                 <cite><?php echo $recipe['source']['sourceDisplayName']; ?></cite></a></span>
        
        
        <span class="meta-tags"><?php echo $recipe['tagsToString']; ?></span>

    </footer>
    
</section>

<footer class="attribution">
    <br /><br />
    <small><?php echo $recipe['attribution']['html']; ?></small> 
</footer>