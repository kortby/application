<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="algerie-confluences, journal, quotidien, Algerien, newspaper, confluences, journaux, internet, alger, algerie, medea, el yawmi, online, sahara, dz, culture, journal, newspaper, maghreb, sport, JSK, foot, équipe d&#039;algérie, actualité, info, free, gratuit, news, football, equipe, national" />
<meta name="description" content="Algerie Confulences, Abdelkrim LAKHDAR EZZINE, algerie confulences, algerie-confulences, Quotidien Algerien en francais, journal Algerien en francais,  newspaper, journal medea, confluences, journaux, internet, alger, algerie, Algerie Confluences jounal Algerie" />

<title><?php echo $title ; ?></title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet" />

<link type="text/css" href="<?php echo base_url(); ?>css/blitzer/jquery-ui-1.8.20.custom.css" rel="Stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Coda:800' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" />

<!--jquery-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.20.custom.min.js"></script>
 
<script src="<?php echo base_url() ?>js/ui/i18n/jquery.ui.datepicker-fr.js" type="text/javascript"></script>

<script type="text/javascript" >var base_url ="<?php echo base_url() ; ?>"</script>
<script src="<?php echo base_url() ?>js/algconf.js" type="text/javascript"></script>
</head>

<body>
<div class="container">
    <header id="pageHeader">
      <hgroup>
        <h1 title="Algerie Confluences">Algerie Confluences</h1>
        <h2 title="Quotidien National Du Soir">Quotidien National Du Soir</h2>
        <h2 title="journal algerien en francais">journal algerien en francais</h2>
        <div id="logo">
        <a href="<?php echo base_url(); ?>" title="Algerie Confluences">
        <img src="<?php echo base_url(); ?>img/logo.png" alt="Algerie Confluences" title="Algerie Confluences" />
        </a>
        </div>
      </hgroup>
    </header>

    <menu id="mainNav">
      <h2>Site navigation</h2>
      <ul>
        <li><a href="<?php echo base_url(); ?>quotidien/accueil" class="<?php if($this->uri->segment(2)== 'accueil') echo 'current' ; ?>" title="Page Principale">Accueil <em>Page Principale</em></a> </li>
        <li><a href="<?php echo base_url(); ?>quotidien/el-qacid"  title="Abdelkrim LAKHDAR-EZZINE" class="<?php if($this->uri->segment(2)== 'el-qacid' ) echo 'current' ; ?>">EL-QACID <em>De Abdelkrim LAKHDAR-EZZINE</em></a></li>
        <li><a href="<?php echo base_url(); ?>quotidien/a-lire/" title="Abdelkrim LAKHDAR-EZZINE" class="<?php if($this->uri->segment(2)== 'a-lire' || $this->uri->segment(2)== 'article') echo 'current' ; ?>">A LIRE <em>Les Articles du jour</em></a></li>
        <li><a href="<?php echo base_url(); ?>quotidien/infos/" title="A propos de journale" class="<?php if($this->uri->segment(2)== 'infos') echo 'current' ; ?>">Infos <em>A propos de journal</em></a></li>
        <li>
        <div class="searchF">
        <!-- <div class="input-append">
	        	    <form method="get" accept-charset="utf-8" action="<?php echo base_url() ?>quotidien/recherche">
		                <input name="q" type="text" size="16" id="appendedInputButtons" class="span2">
		                <button type="submit" class="btn">Rechercher</button>
	                </form>
        </div> -->
        </div>
        </li>
      </ul>
    </menu>


<section id="content" class="row-fluid">
  <div class="span8" id="leftSide">
      
      <?php $this->load->view($main) ?>
          
          
  </div>
  
  <aside class="span4" id="rightSide">
  
    <section class="ljournal"><br>
    	
    	<?php $this->load->view('quotidien/downloadPdf') ?>
        <br>
    </section>
    <br>
    
    
    <section id="elquacid" style="padding: 33px">
      <ul class="nav nav-tabs nav-stacked">
      		<li><h2 style="text-align:center">EL-QACID</h2></li>
	      <?php
	      foreach ($data['entrie_random_qacid'] as $article)
	        {	             
	       echo '<li>'.anchor( base_url().'quotidien/el-qacid/'.$article->slug ,$article->title ).' </li>'; 
	        }            
	      ?>        
      </ul>
    </section>
  </aside>
  
  <footer id="pageFooter" class="span12">
  <p class="notice">&copy;  Algerie Confluences | Journal Algerien en francais | le nombre de visiteurs est :<span style="color: #ec1f26;"> 
            <?php
			 	/* Hits table has an auto-incrementing id and an ip field */

				// Grab client IP
				$ip = $_SERVER['REMOTE_ADDR'];
				
				// Check for previous visits
				$query = $this->db->get_where('hits', array('ip' => $ip), 1, 0);
				$query = $query->row_array();
				
				if (count($query < 1) )
				{
					// Never visited - add
					$this->db->insert('hits', array('ip' => $ip) );
				} 
				echo $this->db->count_all('hits') + 25322;  
				 
			?> </span></p>
  </footer>
</section>


</div>
</body>
</html>
