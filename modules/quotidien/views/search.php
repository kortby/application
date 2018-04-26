<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 


<?php if (!empty($data['entries_search'] )) : ?>
<h4 style="text-align:right;" class="alert alert-success" >Trouvés <span class="label label-success" ><?php echo $results_count ; ?></span> resultats</h4>
<?php foreach ($data['entries_search']  as $article) : ?>
<article>
    <hgroup>
      
    <h2>
    	<?php 
    echo anchor('quotidien/a-lire/'.$article->slug  ,$article->title ) ;
    ?>
    </h2>
    
     <h1>
    <?php 
    echo $article->title_2 ;
    ?>
    </h1> 
    
    </hgroup>
    <section>
		
        <?php  echo word_limiter(strip_tags($article->content) , 45)  ;  ?>
        <div class="clear" ></div>
        <span style=" float:right;"  class="btn" >
		<?php echo anchor('quotidien/a-lire/'.$article->slug  ,'Lire la suite >>' ) ;?>
        </span>
        
    </section>
            
</article>

<?php endforeach; ?>

          
<div id="paginationP">
<div class="pagination">
    <ul>       
        <?php echo $data['pag_links_search'] ?>
    </ul>
</div>
</div>
<?php else : ?>
<h4 class="alert alert-block" >Pas d'articles trouvés avec ce critére de recherche</h4>
<?php endif; ?>