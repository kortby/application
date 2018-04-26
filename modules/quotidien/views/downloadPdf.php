<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
		<?php $date= explode("-",$entrie->date ) ?>
                 	
       <h3>lire le journal du <strong><i><?php echo $date[2].'-'.$date[1].'-'.$date[0]  ?></i></strong></h3>
            <!--  <a id="link_default" rel="downloadr" href="<?php   echo $entrie->pdf  ?>" title="Lire le journal"> -->  
            <a href="<?php   echo base_url().'quotidien/telechargement/download_pdf/'. $entrie->pdf  ?>" title="Lire le journal">                              
         <img src="<?php  echo base_url() ?>photos/pdf.jpg" style="width:150px" alt="Algerie Confluences" />
         <!-- <img src="<?php  //echo base_url() ?>photos/<?php  //echo  $entrie->image ?>" alt="Algerie Confluences" /> -->
            </a> 
        
    <div id="chose">
    <div id="fromDate">
		<h4>Choisir une date</h4>
		<?php 
        $data = array(
                      'name'        => 'jounale_inp',
                      'id'          => 'jounale_inp',
                      'value'       => 'Choisir une date'                      
                    );
        ?>        
        <div id="jounale_inp"></div>
	</div>
	</div>
<div id="gdoc"></div>


