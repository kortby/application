<script type="text/javascript">
$(document).ready(function(){

$('#add_article').button();

$('#add_article').click(function(){
	$("#article_dialog").data('id_article' , 0 );
	$("#article_dialog").dialog('open');
	return false ;
});

$('#article_dialog').dialog({
	
	autoOpen:false,
	modal:true,
	width: "500",
	open: function(){
        
        $('#article_dialog').html('') ;

	$(this).data('task') == 'delete' ? sData= "id_article="+$(this).data("id_article")+"&task="+$(this).data('task') : sData= "id_article="+$(this).data("id_article") ;
	$.ajax({              
        type: "POST", 
        data:sData,            
        url: "<?php echo base_url(); ?>index.php/admin/articles/get_article_form",
        success: function(data){
      	  $('#article_dialog').html(data) ;            	                 
        }
    });	
	
	},
	close :function() {
		 
		 $(this).data('task', '');
	 	  }
	
}) ;
	
$('#article_display').dataTable
({
	
    'bServerSide'    : true,
    'bAutoWidth'     : false,
    "bJQueryUI": true,
    'sPaginationType': 'full_numbers',
    'sAjaxSource'    : '<?php echo base_url(); ?>index.php/admin/listener',
    'aoColumns'      :

     [
     { 'mDataProp': 'id_article'  ,  'bVisible':false },
     { 'mDataProp': 'title',    "bSearchable": true},
     /*{ 'mDataProp': 'content',   "bSearchable": true},*/
     { 'mDataProp': 'author', "bSearchable": true},
     { 'mDataProp': 'date',    "bSearchable": false},
     { 'mDataProp': 'journal_reference',    "bSearchable": false},
     { 'mDataProp': 'published',    "bSearchable": false},
     { 'mDataProp': 'archived',    "bSearchable": false},
     { 'mDataProp': 'action',    "bSearchable": false}
     ],
        
       /*[
        { 'sName': 'id_title' , bVisible:false}, 
        { 'sName': 'title' },   
       { 'sName': 'tb_articles.content' },
       
        { 'sName': 'author' },
        { 'sName': 'date' },
        { 'sName': 'journal_reference' },
        { 'sName': 'published' },
        { 'sName': 'archived' },
        { 'sName': 'action' }        

    ],*/
    "oLanguage" :
        {
        "sProcessing":   "Traitement en cours...",
        "sLengthMenu":   "Afficher _MENU_ éléments",
        "sZeroRecords":  "Aucun élément à afficher",
        "sInfo":         "Affichage de l'élement _START_ à _END_ sur _TOTAL_ éléments",
        "sInfoEmpty":    "Affichage de l'élement 0 à 0 sur 0 éléments",
        "sInfoFiltered": "(filtré de _MAX_ éléments au total)",
        "sInfoPostFix":  "",
        "sSearch":       "Rechercher&nbsp;:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Premier",
            "sPrevious": "Précédent",
            "sNext":     "Suivant",
            "sLast":     "Dernier"
        }
    },
    'fnServerData': function(sSource, aoData, fnCallback)
    {
        $.ajax
        ({
            'dataType': 'json',
            'type'    : 'POST',
            'url'     : sSource,
            'data'    : aoData,
            'success' : fnCallback
        });
    },"fnDrawCallback": function() {

    	$('.edit_article , .delete_article').button();

    	$('.edit_article').click(function(){
        	
    		$("#article_dialog").data('id_article' , $(this).attr("href") );
    		$("#article_dialog").dialog('open');
    		return false ;
    	});

    	$('.delete_article').click(function(){
    		//alert($(this).prev('input[type:hidden]').val() );
    		//$('#content_from').data('id_journal', $(this).prev('input[type:hidden]').val());
    		$('#article_dialog').data('id_article', $(this).attr('href'));
    		$('#article_dialog').data('task', 'delete');
    		$('#article_dialog').dialog('open');
         return false ;
    	});
        	
        
    }
});
});

</script>
<a id="add_article">Ajouter un article</a>
<table id="article_display" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <!--  <th>Texte</th>-->
            <th>Auteur</th>
            <th>Date de publication</th>
            <th>J reference</th>
            <th>Publier</th>
            <th>Archiver</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>loading...</td>
        </tr>
    </tbody>
</table>

<div id="article_dialog" ></div>