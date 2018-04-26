<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activearticles extends CI_Controller {

	   public function __construct ()
	   {
	      parent::__construct();
	      $this->load->model('Mdl_admin_article');
	   }
		public function index()
		{
		if (!acl_check()){
				
                 $data['main'] = 'login_form';
                 
	        }else{
	        	
	            $data['main']=('v_home_activearticle'); 
	            
	        }
			 
			$this->load->view('dashboard' , $data);
		}
		
		
		function get_article_form()
		{
		
			$this->input->post('id_article') != 0 ? $data['entrie_data']= $this->Mdl_admin_article->get_active_entrie($this->input->post('id_article')) : $data['entrie_data']= '';
		    $this->input->post('task') != 'delete' ? $data['task']= '': $data['task']= 'delete';
		    $this->load->view('active_article_form' , $data);
		
		}
		
		
	     /*public function listener ()
			{
	
			  $this->load->library('Datatables');
				
			  $this->datatables->select('title, author, journal_reference, published , archived');
	          $this->datatables->from('tb_articles');
	          $this->datatables->generate();  		 
				
			}*/
		
		   public function getFrom()
			{  
		        $this->input->post('id_journal') != 0 ? $data['entrie_data']= $this->Mdl_admin->get_entrie($this->input->post('id_journal')) : $data['entrie_data']= '';
		        $this->input->post('task') != 'delete' ? $data['task']= '': $data['task']= 'delete';
				$this->load->view('journal_form' , $data);
			}
			
			public function create ()
			{	
			$this->Mdl_admin_article->create_active_entrie() ;	
			}
			
			public function delete_entrie ()
			{
			 $this->Mdl_admin_article->delete_active_entrie() ;	
			}
			
			
			
			public function activate ()
			{
			if ($this->input->is_ajax_request()) {
            
				 $this->Mdl_admin_article->update_check_active_entrie() ;
             }   
			}
		

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */