<script type="text/javascript" >
$(document).ready(function() {
});
</script>

 <?php //print_r($entrie) ?> 
 <?php if(count($entrie)){ ?> 
<iframe src="http://docs.google.com/gview?url=<?php echo base_url() ?>pdf/<?php echo $entrie->pdf ; ?>&embedded=true" style="width:970px; height:500px;" frameborder="0"></iframe>
<?php 
 }
 else
 {
	echo '<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
					<strong>Désolé!</strong> pas de titre pour cette date.</p>
		</div>
	</div>';	
	
}?>