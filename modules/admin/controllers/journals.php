<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Journals extends CI_Controller {

	   public function __construct ()
	   {
	      parent::__construct();
	      $this->load->model('Mdl_admin_journal');
	   }
		public function index()
		{
			   $this->load->library('pagination');
			   $per_page = 10;
			   $total = $this->Mdl_admin_journal->count_entries();
			   
			
			   $base_url = site_url('admin/journals/index');
			   $config['base_url'] = $base_url;
			   $config['total_rows'] = $total;
			   $config['per_page'] = $per_page;
			   $data['entries'] = $this->Mdl_admin_journal->get_entries($per_page, $this->uri->segment(4));
			   $config['uri_segment'] = '4';	
	           $this->pagination->initialize($config); 

	           
			if (!acl_check()){
					
	                 $data['main'] = 'login_form';
	                 
		        }else{
		        	
		            $data['main']= 'v_home_journal' ; 
		            
		        }
	           
	           
			   $this->load->view('dashboard' , $data);
		}
		
		   public function getFrom()
			{  
		        $this->input->post('id_journal') != 0 ? $data['entrie_data']= $this->Mdl_admin_journal->get_entrie($this->input->post('id_journal')) : $data['entrie_data']= '';
		        $this->input->post('task') != 'delete' ? $data['task']= '': $data['task']= 'delete';
				$this->load->view('journal_form' , $data);
			}
			
			public function create ()
			{	
				$this->Mdl_admin_journal->create_entrie() ;	
			}
			
			public function delete_entrie ()
			{
			 $this->Mdl_admin_journal->delete_entrie() ;	
			}
			
			public function dafault_journal () {		
				$this->Mdl_admin_journal->dafault_journal();
			
			}
		

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */