<article id="alire">
<?php if(!empty($articles_active_entrie->id_active_article) ) { ?>

<h2><?php echo $articles_active_entrie->title;  ?> </h2>
<h1> <?php echo $articles_active_entrie->title;   ?> </h1>

<div >
<?php echo  $articles_active_entrie->introtext.' '. $articles_active_entrie->content   ?>
<h3> <?php echo $articles_active_entrie->author   ?> </h3>

<?php $date = explode('-' , $articles_active_entrie->date ) ;  ?>

<h5><?php echo $date[2] .'-'.$date[1] .'-'.$date[0] ;  ?> </h5>


<?php }else { 
	
	echo '<h1>Erreur</h1>' ;
	echo "<p>Désolé, mais l'article que vous avez demandé n'a pas été trouvé  !!!</p>";
	
 }?>
</div>
<br />
<h4 style="text-align:right;" class="btn" ><?php echo anchor(base_url(), " << Retour") ?></h4> 
<br />
</article>

