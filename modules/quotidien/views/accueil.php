<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 


<?php foreach ($data['entries_articles_active']  as $article) : ?>
<article>
    <hgroup>
    <h2>
    <?php 
    echo $article->title ;
    ?>
    </h2>
    <h1>
    <?php 
    echo anchor('quotidien/a-lire/'.$article->slug  ,$article->title)  ;
    ?>
    </h1>
    <!--  Faycal we need H1 here <h1></h1> -->
    </hgroup>
    <section>
		<?php if($article->introtext) : ?>
        <?php echo $article->introtext ;  ?> <span class="btn" ><?php echo anchor('quotidien/a-lire/'.$article->slug  ,'Lire la suite >>' ) ;?></span>
        
        <?php else :?>
        <?php echo $article->content ;  ?>
        <?php endif ; ?>
    </section>
            
</article>

<?php endforeach; ?>
<div id="paginationP">
<div class="pagination">
    <ul> 	        
	            <li><?php echo $data['pag_links_article_active'] ?></li>
	</ul>
	
</div> </div>