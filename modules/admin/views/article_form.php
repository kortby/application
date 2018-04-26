


<script type="text/javascript" >

tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    plugins : "advimage, imagemanager",
    relative_urls : false,
	document_base_url : "<?php echo DOCUMENT_BASE_URL ; ?>",
	entity_encoding : "raw"
});


$(document).ready(function() {

	
	
 $('#_date').datepicker({ dateFormat: 'yy-mm-dd'});
 $('#submiter , #delete_conf_article').button();
 $("#journal_form").validationEngine({
	  
	 //ajaxFormValidation: true,
	 
    // onAjaxFormComplete: ajaxValidationCallback
});	

 $('#delete_conf_article').click(function(){

	 $.ajax({              
         type: "POST",
         dataType:"json", 
         data:"id_article="+$(this).attr('href'),            
         url: "<?php echo base_url(); ?>index.php/admin/articles/delete_entrie",
         success: function(data){
       	   if(data.answer == true)
       	   {
       		window.location.href ="<?php echo base_url() ?>index.php/admin/articles";
           }            	                 
         }
     }); 	 

 return false ;
});	
});
</script>

<?php

if ($task != 'delete')
{
	if(!empty($entrie_data))
	{			
		$title=$entrie_data->title;
		
		$content=$entrie_data->content;
		$author= $entrie_data->author;
		$date= $entrie_data->date;
		$journal_reference= $entrie_data->journal_reference ;
		$id_article=$entrie_data->id_article;		
		$entrie_data->published == '1' ? $checked_published = TRUE : $checked_published = FALSE ;
		$entrie_data->archived == '1'  ? $checked_archived =  TRUE : $checked_archived = FALSE ;
		
	}else{		
		$title=$this->input->post('title');
		
		$content=$this->input->post('content');
		$author= $this->input->post('author');
		$date= $this->input->post('_date');
		$journal_reference= $this->input->post('journal_reference') ;
		$id_article='0';	

		$checked_published = TRUE ;
		$checked_archived = FALSE ;
	}
	
	$attributes = array('class' => 'journal_form', 'id' => 'journal_form');
	echo form_open('admin/articles/create', $attributes);
	
	$attributes = array(
	    'class' => 'mycustomclass',
	    'style' => 'color: #000;',
	);
	echo form_label('Titre', 'title', $attributes).'<br />';
	
	$data = array(
	              'name'        => 'title',
	              'id'          => 'title',
	               'class'          => 'validate[required]',
	              'value'       => $title,             
	              'style'       => 'width:100%',
	            );
	
	echo form_input($data).'<br />';
	
	
	
	echo form_label('Texte', 'content', $attributes).'<br />';
	
	$data = array(
	              'name'        => 'content',
	              'id'          => 'content',
	              'class'          => 'validate[required]',
	              'value'       => $content,             
	              'style'       => 'width:100%',
	            );
	
	echo form_textarea($data).'<br />';
	
	echo form_label('Auteur', 'author', $attributes).'<br />';
	
	$data = array(
	              'name'        => 'author',
	              'id'          => 'author',              
	              'value'       => $author,             
	              'style'       => 'width:100%',
	            ); 
	echo form_input($data).'<br />';
	
	echo form_label('Date de publication', '_date', $attributes).'<br />';
	
	$data = array(
	              'name'        => '_date',
	              'id'          => '_date',
	              'value'       => $date,             
	              'style'       => 'width:100%',
	            );
	
	 echo form_input($data).'<br />';
	 
	 
	 echo form_label('Journal de reference', 'journal_reference', $attributes).'<br />';
	
	$data = array(
	              'name'        => 'journal_reference',
	              'id'          => 'journal_reference',
	              'value'       => $journal_reference,             
	              'style'       => 'width:100%',
	            );
	
	 echo form_input($data).'<br />';
	 
	 echo form_label('Publier', 'published', $attributes).'<br />';
	 
	 $data = array(
	    'name'        => 'published',
	    'id'          => 'published',
	    'value'       => '1',
	    'checked'     => $checked_published,
	    'style'       => 'margin:10px',
	    );

    echo form_checkbox($data).'<br />';;

     echo form_label('Archiver', 'archived', $attributes).'<br />';

	 $data = array(
	    'name'        => 'archived',
	    'id'          => 'archived',
	    'value'       => '1',
	    'checked'     => $checked_archived,
	    'style'       => 'margin:10px',
	    );
	
	echo form_checkbox($data).'<br />';;
	 
	 
	
	$data = array(
	              'name'        => '_submit',
	              'id'          => 'submiter',
	              'value'       => 'Enregistrer',             
	              'type'       => 'submit',
	            );
	
	echo form_submit($data).'<br />';
	echo form_hidden('id_article', $id_article);
	echo form_close();
}
else
{	
 echo

 '<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
					<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
					<strong>Confirmation!</strong> Vous voulez vraiment supprimer cet article ?.</p>
				</div>
			</div>';	
 echo '<a id="delete_conf_article" href="'.$this->input->post('id_article') .'"> Ok </a>' ;
 
}

?>