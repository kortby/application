<article id="elqacid">
<?php if($entrie_article) { ?>
<h1><?php echo $entrie_article->title   ?> </h1>



<?php echo $entrie_article->content   ?>

<h3> <?php echo $entrie_article->author   ?> </h3>

<?php $date = explode('-' , $entrie_article->date ) ;  ?>
<h5><?php echo $date[2] .'-'.$date[1] .'-'.$date[0] ;  ?> </h5>

<?php }else { ?>

<h1><?php echo $default_article->title   ?> </h1>
<?php echo $default_article->content   ?>

<h3>Auteur :<?php echo 	$default_article->author   ?> </h3>

<?php $date_default = explode('-' , $default_article->date  ) ;  ?>
<h5><?php echo $date_default[2] .'-'.$date_default[1] .'-'.$date_default[0] ;  ?> </h5>

<?php }?>
</article>

