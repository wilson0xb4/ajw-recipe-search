<?php //print_r($user); ?>
<div id="content" role="main" class="span7">
    
    <h2>Search Results</h2>

    <div class="search_meta">
        <?php echo 'Searched for: "' . $yummly['q'] 
                . '", Total Matches Found: ' . $yummly['totalMatchCount'] 
                . ', Showing ' . ( $yummly['start'] + 1 ) . '-' . ($yummly['start'] + $settings['maxResults']) . '.'; 
        ?> 
    </div>

    <?php foreach ($yummly['matches'] as $recipe): ?>
    
	<section class="post hentry">

		<header class="entry-header">
			
            <h1 class="entry-title"> 
				<?php echo $recipe['recipeName']; ?> 
			</h1>

			<a href="<?php echo site_url('ajw/display/' . $recipe['id']) ?>" title="Post Heading">
                <?php
                    if ( ! empty($recipe['smallImageUrls']) ) {
                        echo '<img src="' . $recipe['smallImageUrls'][0] . '" class="thumbnail" />';
                    } else {
                        echo '<img src="' . base_url() . 'images/130x180.gif" alt="Post thumbnail" class="thumbnail" />';
                    }
                ?> 
            </a>

        </header> <!-- .entry-header -->

		<div class="entry-content">
            
            <h2>Ingredients</h2>
            <?php foreach ($recipe['ingredients'] as $ingredient) {
                echo $ingredient . '<br />';
            } ?>
            
            <p>Source: <cite><?php echo $recipe['sourceDisplayName']; ?></cite></p>

			<p><a href="<?php echo site_url('ajw/display/' . $recipe['id']) ?>" class="more-link">View more <span class="meta-nav">&rarr;</span></a></p>
		
        </div> <!-- .entry-content -->

	</section> <!-- .post.hentry -->
    
    <?php endforeach ?>

    <p><a href="<?php echo site_url('ajw/search/' . $yummly['q'] . '/' . ($yummly['start'] + $settings['maxResults']) ) ?>">View More Recipes ...</a></p>
    
    <footer class="attribution">
        <br /><br />
        <small><?php echo $yummly['attribution']['html']; ?></small> 
    </footer>
    
</div> <!-- #content -->