<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {

	   public function __construct ()
	   {
	      parent::__construct();
	      $this->load->model('Mdl_admin');
	   }
		public function index()
		{									
			if (!acl_check()){				
                 $data['main'] = 'login_form';                 
	        }else{	        	
	            $data['main'] = 'v_dashboard';	            
	        }    	  
			 $this->load->view('dashboard' , $data);
		}	
	
	
		public function autentication() {
		       // $this->load->model('Mdl_credential');
		        $row = $this->Mdl_admin->autenthication($this->input->get('username'), $this->input->get('password'));
		        if (!empty($row)) {
		            $data = array(
		                'username'  => $row['username'],
		                'logged_in' => TRUE
		            );
		            $this->session->set_userdata($data);
		            echo json_encode(array('answer' => true));
		        } else {
		            echo json_encode(array('answer' => false));
		        }
		    }
	
     public function listener() {
     	$this->load->library('Datatables');
        $this->datatables->select('id_article, title, content, author, date, journal_reference, published, archived ');
        $this->datatables->from('tb_articles');
        
        $this->datatables->add_column('action','<a class="edit_article" href="$1">Editer</a><a class="delete_article" href="$1">Supprimmer</a>', 'id_article');
        $data['result'] = $this->datatables->generate();
        $this->load->view('tables', $data);
    }
    
    
   
    
    
      public function activelistener() {
     	$this->load->library('Datatables');
        $this->datatables->select('id_active_article , title,  author, date, journal_reference, active, published, archived ');
        $this->datatables->from('tb_active_articles');            
        $this->datatables->edit_column('active',   '<input class="active_change" type="checkbox" $2 value="$1" name="active">', 'id_active_article, active');        
        $this->datatables->add_column('action','<a class="edit_article" href="$1">Editer</a><a class="delete_article" href="$1">Supprimmer</a>', 'id_active_article');
        $data['result'] = $this->datatables->generate();
        $this->load->view('tables', $data);
    }
    	 
    
 function logout() {
        $this->session->sess_destroy();
        redirect('admin');
    }
}
