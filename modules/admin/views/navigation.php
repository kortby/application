<style type="text/css">
#admin_menu { display :inline; clear:both;}
#admin_menu li { float :left;  margin : 0 10px; list-style-type:none }
</style>

<script type="text/javascript" >
$(document).ready(function(){
	$('#admin_menu a').button();
	
});
</script>

<?php 
$this->uri->segment('2')  == 'activearticles' ? $array1 = array("class"=>" ui-state-active" ) : $array1 = array("class"=>"" ) ;
$this->uri->segment('2')  == 'articles' ? $array2= array("class"=>" ui-state-active" ) : $array2 = array("class"=>"" ) ;
$this->uri->segment('2')  == 'journals' ? $array3= array("class"=>" ui-state-active" ) : $array3 = array("class"=>"" ) ;

?>





<div style="clear:both; height:30px; padding:5px 0;" class="ui-corner-all ui-widget-content">
<ul id="admin_menu" >
	<li><?php echo anchor('admin/journals' , 'Journals', $array3   )  ?></li>
	<li><?php echo anchor('admin/articles' , 'El Qacid', $array2  )  ?></li>
	<li><?php echo anchor('admin/activearticles' , 'A lire' ,$array1  )  ?></li>
	<li><?php echo anchor('admin/logout' , 'Déconnexion'  )  ?></li>
</ul>
</div>
<br />
<br />
<br />
