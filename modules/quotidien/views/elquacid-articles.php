<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 

<?php // print_r($data['entries_articles']) ?>
<?php foreach ($data['entries_articles']  as $article) : ?>
<article>
    <hgroup>
    <h2>
    <?php 
    	
    	echo anchor('quotidien/el-qacid/'.$article->slug  ,$article->title ) ;
    ?>
    </h2>     
    </hgroup>
    
    <section>
		<?php echo word_limiter(strip_tags($article->content) , 45)  ;  ?>
        <div class="clear" ></div>
        <span style=" float:right;"  class="btn" >
		<?php echo anchor('quotidien/el-qacid/'.$article->slug  ,'Lire la suite >>' ) ;?>
        </span>
    </section>            
</article>

<?php endforeach; ?>

          
<div id="paginationP">
<div class="pagination">
    <ul>       
        <?php echo $data['pag_links_article'] ?>
    </ul>
</div>
</div>