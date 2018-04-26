<script type="text/javascript" >
$(document).ready(function() {
	
	$('.edit_link, .delete_link , #pagination a , #add_journal').button();
    $('#content_from').dialog({
      autoOpen:false,
      modal:true,
      width: "500",
      open: function(event, ui) {
    	$(this).data('task') == 'delete' ? sData= "&id_journal="+$(this).data('id_journal')+"&task="+$(this).data('task') : sData= "&id_journal="+$(this).data('id_journal') ;
    	  $.ajax({              
              type: "POST", 
              data:sData,            
              url: "<?php echo base_url(); ?>admin/journals/getFrom",
              success: function(data){
            	  $('#content_from').html(data) ;            	                 
              }
          }); 

 	  },
 	  close :function() {
 		 //$( this ).dialog( "destroy" );
 		 $(this).data('task', '');
 	 	  }
      /*buttons: {
			"Creer": function() {

				$("#content_from").submit();
				
			},
			"Quitter": function() {
				$( this ).dialog( "close" );
			}
		}*/

     });
	$('#add_journal').click(function(){
		$('#content_from').data('id_journal', '0');
		//$('#content_from').data('task', 'add');
		$('#content_from').dialog('open');
     return false ;
	});

    $('.edit_link').click(function(){
       // alert($(this).next('input[type:hidden]').val() + $(this).attr('id'));
        //$('#content_from').data('id_journal', $(this).next('input[type:hidden]').val());
        $('#content_from').data('id_journal', $(this).attr('href'));
		//$('#content_from').data('task', 'edit');
		$('#content_from').dialog('open');
     return false ;
	});

	$('.delete_link').click(function(){
		//alert($(this).prev('input[type:hidden]').val() );
		//$('#content_from').data('id_journal', $(this).prev('input[type:hidden]').val());
		$('#content_from').data('id_journal', $(this).attr('href'));
		$('#content_from').data('task', 'delete');
		$('#content_from').dialog('open');
     return false ;
	});

	$('.default').change(function(){
		//alert($(this).prev('input[type:hidden]').val() );
		//$('#content_from').data('id_journal', $(this).prev('input[type:hidden]').val());
		/*$('#content_from').data('id_journal', $(this).attr('href'));
		$('#content_from').data('task', 'delete');
		$('#content_from').dialog('open');*/

		var sData = "dafault="+$(this).prev('input[type:hidden]').val() ;

		$.ajax({              
            type: "POST", 
            data:sData,            
            url: "<?php echo base_url(); ?>admin/journals/dafault_journal",
            success: function(data){
          	  //$('#content_from').html(data) ;            	                 
            }
        });		
     return false ;
	});

	
});
</script>

<a id="add_journal" href="#">Ajouter un journal</a>
<table style="text-align:center;border-collapse:collapse; width:100%; margin:5px auto;" class="ui-grid-content ui-widget-content" >
<thead>
<tr><th class="ui-state-default" >Default</th><th class="ui-state-default" >Numero du journal</th><th class="ui-state-default" >Pdf</th><th class="ui-state-default" >Date de parution</th><th class="ui-state-default" >Creer</th><th class="ui-state-default" >Editer</th> <th class="ui-state-default" >Action</th> </tr>
</thead>
<tbody>

<?php

foreach ($entries as $entrie):
    echo '<tr>';
    
    $entrie->default == '1' ? $state = TRUE : $state = FALSE ; 
    
    echo '<td class="ui-widget-content" ><input name="id_journal_'.$entrie->id_journal .'" type="hidden" value="'.$entrie->id_journal.'" />'.form_radio('default' , 'accept' , $state , 'class="default"'  ).'</td>'; 
    echo '<td class="ui-widget-content" >'.$entrie->numero_journal.'</td>';
    echo '<td class="ui-widget-content" ><a href='.base_url().'pdf/'.$entrie->pdf.' target="_blank" >'.$entrie->pdf.'</a></td>';
    echo '<td class="ui-widget-content" >'.$entrie->date.'</td>';
    echo '<td class="ui-widget-content" >'.$entrie->created.'</td>';
    echo '<td class="ui-widget-content" >'.$entrie->updated.'</td>';
    echo '<td class="ui-widget-content" ><a id="'.$entrie->id_journal.'" class="edit_link" href="'.$entrie->id_journal.'" >Editer</a><input name="id_journal_'.$entrie->id_journal .'" type="hidden" value="'.$entrie->id_journal.'" /><a class="delete_link" href="'.$entrie->id_journal.'">Supprimer</a></td>';
    echo '</tr>'; 
endforeach;

?>

</tbody>
</table>
<div id="pagination" style="width:100%; margin:10px auto; text-align:center;">
<?php echo $this->pagination->create_links();?>