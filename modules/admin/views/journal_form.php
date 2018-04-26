<script type="text/javascript" >

$(document).ready(function() {
 $('#date').datepicker({ dateFormat: 'yy-mm-dd'});
 $('#submiter , #delete_conf_journal').button();
 $("#journal_form").validationEngine({
	  
	 //ajaxFormValidation: true,
	 
    // onAjaxFormComplete: ajaxValidationCallback
});	

 $('#delete_conf_journal').click(function(){

	 $.ajax({              
         type: "POST",
         dataType:"json", 
         data:"id_journal="+$(this).attr('href'),            
         url: "<?php echo base_url(); ?>index.php/admin/journals/delete_entrie",
         success: function(data){
       	   if(data.answer == true)
       	   {
       		window.location.href ="<?php echo base_url() ?>index.php/admin/journals";
           }            	                 
         }
     }); 
 return false ;
})
 
 
	
});

function ajaxValidationCallback(status, form, json, options){
	 
    if (status === true) {

    	if(json.answer===true)
    	{
    		//window.location.href ="<?php echo base_url() ?>dashboard";   		 		        	
          
        }else if (json.answer===false) {

        	//$('#error').fadeIn(500);
        	
        	//$('#error').delay(3000).fadeOut(500);        	

        }

    }
}

</script>

<?php

if ($task != 'delete')
{
	if(!empty($entrie_data))
	{	
		$numero=$entrie_data->numero_journal;
		$date=$entrie_data->date;
		$id_journal=$entrie_data->id_journal;
		
	}else{		
		$numero='';
		$date='';
		$id_journal='0';		
	}
	
	$attributes = array('class' => 'journal_form', 'id' => 'journal_form');
	echo form_open_multipart('admin/journals/create', $attributes);
	
	$attributes = array(
	    'class' => 'mycustomclass',
	    'style' => 'color: #000;',
	);
	echo form_label('Numero du journal', 'numero', $attributes).'<br />';
	
	$data = array(
	              'name'        => 'numero',
	              'id'          => 'numero',
	               'class'          => 'validate[required,custom[number]]',
	              'value'       => $numero,             
	              'style'       => 'width:100%',
	            );
	
	echo form_input($data).'<br />';
	
	echo form_label('Date de parution', 'date', $attributes).'<br />';
	
	$data = array(
	              'name'        => 'date',
	              'id'          => 'date',
	              'class'          => 'validate[required,custom[date]]',
	              'value'       => $date,             
	              'style'       => 'width:100%',
	            );
	
	echo form_input($data).'<br />';
	
	echo form_label('Image', 'image', $attributes).'<br />';
	
	$data = array(
	              'name'        => 'image',
	              'id'          => 'image',              
	              'value'       => '',             
	              'style'       => 'width:100%',
	            );
	            
	!empty($entrie_data) ? $data['class'] = '' : $data['class'] ='validate[required]' ;
	
	
	echo form_upload($data).'<br />';
	
	echo form_label('Pdf', 'pdf', $attributes).'<br />';
	
	$data = array(
	              'name'        => 'pdf',
	              'id'          => 'pdf',
	              'value'       => '',             
	              'style'       => 'width:100%',
	            );
	!empty($entrie_data) ? $data['class'] = '' : $data['class'] ='validate[required]' ;
	echo form_upload($data).'<br />';
	
	$data = array(
	              'name'        => '_submit',
	              'id'          => 'submiter',
	              'value'       => 'Creer',             
	              'type'       => 'submit',
	            );
	
	echo form_submit($data).'<br />';
	echo form_hidden('id_journal', $id_journal);
	echo form_close();
}
else
{	
 echo '<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
					<strong>Confirmation!</strong> Vous voulez vraiment supprimer cet article ?.</p>
				</div>
			</div>';	
 
 //echo  '<input type="hidden" name="id_journal" value="'.$this->input->post('id_journal').'" />';
 //echo anchor ($this->input->post('id_journal') ,  "Ok" , array('id'=>'delete_conf_journal')) ;
 
 echo '<a id="delete_conf_journal" href="'.$this->input->post('id_journal') .'"> Ok </a>' ;
 
}

?>