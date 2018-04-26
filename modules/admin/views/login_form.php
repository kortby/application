<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed'); ?>

<script type="text/javascript">

  
    $(document).ready(function() {

        $('#login_form #submit_login').button();
        $("#login_form").validationEngine({
            ajaxFormValidation:true,
            onBeforeAjaxFormValidation: beforeCall ,
            onAjaxFormComplete: ajaxValidationCallback
        });
    })

    function beforeCall(form, options){
        $('#login_form').validationEngine('showPrompt', 'Veuillez patientez ...', 'load', true)
    }


    function ajaxValidationCallback(status, form, json, options){

        if (status === true && json['answer']===true) {
            window.location = "<?php echo base_url().'admin/' ?>" ; 
        }else {
            $('#login_form').validationEngine('showPrompt', 'Le login ou mots de passe est faux', 'error', true);
        }
    }

</script>

<div style="width:25%; height:100%;;margin:100px auto;" >

<div style="width:200px; height:200px; padding:50px;" id="login_wrapper"  class="ui-corner-all ui-widget-content">
    <?php
    $attributes = array('class' => 'login_form', 'id' => 'login_form');

    echo form_open('admin/autentication', $attributes);

    $attributes = array(
        'class' => 'ui-corner-all'
    );
    echo form_label('Utilsateur', 'username', $attributes);


    $data = array(
        'name' => 'username',
        'id' => 'username',
        'value' => '',
        'class' => 'ui-corner-all ui-widget-header validate[required]',
        'style' => 'width:95%'
    );

    echo form_input($data) . '<br />';

    $attributes = array(
        'class' => 'ui-corner-all'
    );
    echo form_label('Mots de passe', 'password', $attributes);

    $data = array(
        'name' => 'password',
        'id' => 'password',
        'value' => '',
        'type' => 'password',
        'class' => 'ui-corner-all ui-widget-header validate[required]',
        'style' => 'width:95%'
    );

    echo form_input($data) . '<br /><br />';
    ;

    $data = array(
        'name' => 'submit_login',
        'id' => 'submit_login',
        'value' => 'Connexion',
        'type' => 'submit',
        'class' => '',
        'style' => 'width:50%'
    );


//echo  anchor('#' , 'Connexion' , $data)

    echo form_submit($data);
    ?>

</div>

</div>