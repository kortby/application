<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>Algerie Confulence</title>

<link type="text/css" href="<?php echo base_url(); ?>css/blitzer/jquery-ui-1.8.20.custom.css" rel="Stylesheet" />
<link href="<?php echo base_url() ?>css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>css/demo_table_jui.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.20.custom.min.js"></script>

<script src="<?php echo base_url() ?>js/tiny_mce/tiny_mce.js" type="text/javascript"></script>


<script src="<?php echo base_url() ?>js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/jquery.validationEngine-fr.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/jquery.dataTables.min.js" type="text/javascript"></script>




<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 11px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

</style>

</head>
<body>

<?php if (acl_check()){ $this->load->view('navigation') ; } ?>
<?php $this->load->view($main) ; ?>

</div>
<div id="content_from" ></div>
</body>
</html>