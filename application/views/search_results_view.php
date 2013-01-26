<h2>Search Results</h2>

<div class="attribution">
    <?php echo $yummly['attribution']['html']; ?> 
</div>

<div class="search_meta">
    <?php echo 'Searched for: "' . $yummly['submitted_query'] . '", Total Matches Found: ' . $yummly['totalMatchCount'] . ', Showing 10.'; ?> 
</div>

<?php foreach ($yummly['matches'] as $recipe): ?>
<section class="recipe">
    <h3><?php echo $recipe['recipeName']; ?></h3>
    
    <?php
    if ( ! empty($recipe['smallImageUrls']) ) {
        echo '<img src="' . $recipe['smallImageUrls'][0] . '" />';
    } else {
        echo '(no picture provided)';
    }
    ?>
    
    <h4>Ingredients</h4>
    <?php foreach ($recipe['ingredients'] as $ingredient) {
        echo $ingredient . '<br />';
    } ?>
    
    <p>Source: <?php echo $recipe['sourceDisplayName']; ?></p>
    
    <p><a href="<?php echo site_url('ajw/display/' . $recipe['id']) ?>">View more!</a></p>
    
    <hr />
</section>

<?php endforeach ?>

<p>end of results</p>