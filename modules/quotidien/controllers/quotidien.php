<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotidien extends CI_Controller {
		
    protected $_entries_articles ;
    protected $_pag_links_article  ;
    protected $_entries_articles_active;
    protected $_pag_links_article_active ;
    
    protected $_entries_articles_search;
    protected $_pag_links_article_search ;
    
    protected $_data ;
	
	
    public function _remap($method , $params = array())

    {
    	switch($method)
    	{
    		case 'recherche':
    			$this->recherche();
    			break;
    		
    		case 'el-qacid':
    			$this->el_qacid();
    			break;
    		    		    			
    		case 'a-lire':
    			$this->a_lire();
    			//$this->activearticles();
    			break;
    		
    		    		
    		case 'getJournalToDownload':
    			$this->getJournalToDownload();
    			break;
    		
    		case 'getJournal':
    			$this->getJournal();
    			break;
    		
    		case 'getDefaultJournal':
    			$this->getDefaultJournal();
    			break;
    		
    		case 'getDateToDisplay':
    			$this->getDateToDisplay();
    			break;
    		
    		case 'd_m_digit':
    			$this->d_m_digit();
    			break;
    		
    		case 'm_d_digit':
    			$this->m_d_digit();
    			break;
    		
    		case 'infos':
    			$this->infos();
    			break;
    			
    		default:
    			$this->index();
    			break;	
    	}    
    }
    
    
    function __construct( $_entries_articles ='' , $_pag_links_article='' , $_entries_articles_search ='' , $_pag_links_article_search='' , $_entries_articles_active ='' , $_pag_links_article_active='' , $_data="" )
    {    	
        parent::__construct( );
				
        $this->load->model(array('admin/Mdl_admin_article', 'admin/Mdl_admin','quotidien/Mdl_quotidien' ) );
		$this->load->library('pagination');
		
		$entries_articles          = $this->pagination_article();        
	    $entries_active_articles          = $this->pagination_article_active();		

    	if($this->input->get('q'))
	    {
	    	$entries_search_articles          = $this->pagination_article_search();
	    }	    
	    
        $this->_entries_articles         = $entries_articles[0];
	    $this->_pag_links_article        = $entries_articles[1];
	    $this->_entries_articles_active  = $entries_active_articles[0];
	    $this->_pag_links_article_active = $entries_active_articles[1];
	    
    	if($this->input->get('q'))
	    {
	    	$this->_entries_articles_search  = $entries_search_articles[0];
	    	$this->_pag_links_article_search = $entries_search_articles[1];
	    }
	    
	    $this->_data = array(
               'entries_articles' => $this->_entries_articles  , 
               'pag_links_article'=>$this->_pag_links_article , 
               'entries_articles_active' =>$this->_entries_articles_active , 
               'pag_links_article_active'=>$this->_pag_links_article_active,
	    	   'entrie_random_qacid'=>$this->entrie_random_qacid(),
	      ) ;

	    if($this->input->get('q'))
	    {
	    	$this->_data['entries_search'] = $this->_entries_articles_search  ;
	    	$this->_data['pag_links_search'] = $this->_pag_links_article_search  ;
	    } 
	}
	 
	
	public function index()
	{           
	   	$data['title'] = 'Algerie Confulences | Quotidien Algerien en francais';
		$data['entrie'] = $this->Mdl_admin->get_entrie_default();
		$data['main']=('quotidien/accueil');
		$data['data'] = $this->_data ;		
		$this->load->view('template' , $data);		
	}
	
	public function recherche ()
	{			
		
		$data['title'] = 'Algerie Confulences | Quotidien Algerien en francais | '. $this->input->get('q');
		$data['entrie'] = $this->Mdl_admin->get_entrie_default();
		$data['main']=('quotidien/search');
		$data['data'] = $this->_data ;
		$data['results_count']=$this->Mdl_quotidien->count_entries_search()	;	
		$this->load->view('template' , $data);	
	}
	
	private function entrie_random_qacid()
	{
	 return $this->Mdl_admin->entrie_random_qacid();
	}
	
	public function el_qacid()
	{
		$article = $this->uri->segment(3) ;
		
		if(($article && is_numeric($article)) || !$article)
		{
			//with pagination
						
			$data['data'] = $this->_data ; 
	    	$data['title'] = 'Algerie Confulences | Quotidien Algerien en francais - Articles à lire de El Qacid';	    		
			$data['entrie'] = $this->Mdl_admin->get_entrie_default();		
			$data['main']=('quotidien/elquacid-articles');			
		}else{		
			$data['entrie_article'] = $this->Mdl_admin_article->get_entrie_by_slug($this->uri->segment(3));		
			$data['default_article'] = $this->Mdl_admin_article->get_entrie_default();		
			$data['data'] = $this->_data ;
		    $data['title'] = 'Algerie Confulences | ' .$this->Mdl_admin_article->get_entrie_title($this->uri->segment(3));		
			$data['entrie'] = $this->Mdl_admin->get_entrie_default();
			$data['main']=('quotidien/article');		
		}
		
		$this->load->view('template' , $data);	
	}
	
	

	public function a_lire()
	{
		$article =$this->uri->segment(3) ;
		
		if(($article && is_numeric($article)) || !$article)
		{
			$data['data'] = $this->_data ;	    
	    	$data['title'] = 'Algerie Confulences | Quotidien Algerien en francais - Article à lire';	   
        	$data['entrie'] = $this->Mdl_admin->get_entrie_default();	
	    	$data['main']=('quotidien/accueil');	    	
			
		}else{
			$data['articles_active_entrie'] = $this->Mdl_admin_article->get_active_entrie_by_slug($this->uri->segment(3));		   
	   		$data['articles_active'] = $this->Mdl_admin_article->get_active_article();	   	   	   
	  		 $data['data'] = $this->_data ;	   
	  		 $data['title'] = 'Algerie Confulences | ' .$this->Mdl_admin_article->get_entrie_active_title($this->uri->segment(3));	   
       		$data['entrie'] = $this->Mdl_admin->get_entrie_default();	
	   		$data['main']=('activearticle');	  	
		}
		 $this->load->view('template' , $data);
	}
			
	private function pagination_article()
	{			
		$per_page = 5;
		$total = $this->Mdl_admin_article->count_entries();		
		$base_url = site_url('quotidien/el-qacid');
		$config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active">';
        $config['cur_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_link'] = ' << ';
		$config['first_tag_open'] = '<li>';		
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = ' >> ';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';				 
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		
		$entries_articles = $this->Mdl_admin_article->get_entries($per_page, $this->uri->segment(3));
			
		$config['uri_segment'] = '3';	
        $this->pagination->initialize($config);
        $pag_links_article  = $this->pagination->create_links();
        return array($entries_articles, $pag_links_article ) ;	
	}
	
    private function pagination_article_active()
	{				
		$per_page_active = 3;
		$total_active = $this->Mdl_admin_article->count_active_entries();
		//$entries_articles_actives = $this->Mdl_admin_article->get_active($per_page_active, $this->uri->segment(3));
		$base_url_active = site_url('quotidien/a-lire');
		$config1['num_tag_open'] = '<li>';
        $config1['num_tag_close'] = '</li>';
        $config1['cur_tag_open'] = '<li class="active">';
        $config1['cur_tag_close'] = '</li>';
        $config1['next_tag_open'] = '<li>';
        $config1['next_tag_close'] = '</li>';
        $config1['prev_tag_open'] = '<li>';
        $config1['prev_tag_close'] = '</li>';
        $config1['first_link'] = ' << ';
		$config1['first_tag_open'] = '<li>';		
		$config1['first_tag_close'] = '</li>';
		$config1['last_link'] = ' >> ';
		$config1['last_tag_open'] = '<li>';
		$config1['last_tag_close'] = '</li>';		 
		$config1['base_url'] = $base_url_active;
		$config1['total_rows'] = $total_active;
		$config1['per_page'] = $per_page_active;
		
	    $entries_articles_actives = $this->Mdl_admin_article->get_active($per_page_active, $this->uri->segment(3));
		$config1['uri_segment'] = '3';
		
        $this->pagination->initialize($config1);
        $pag_links_article_active = $this->pagination->create_links();
        return array($entries_articles_actives, $pag_links_article_active ) ;	
	}
	
		private function pagination_article_search()
	{				
		$per_page_search = 7;
		$total_search = $this->Mdl_quotidien->count_entries_search();
		//$entries_articles_actives = $this->Mdl_admin_article->get_active($per_page_active, $this->uri->segment(3));
	    $config2['suffix'] = '/?'.http_build_query($_GET, '', "&");		
		$base_url_search = site_url('quotidien/recherche/');
		$config2['num_tag_open'] = '<li>';
        $config2['num_tag_close'] = '</li>';
        $config1['cur_tag_open'] = '<li class="active">';
        $config2['cur_tag_close'] = '</li>';
        $config2['next_tag_open'] = '<li>';
        $config2['next_tag_close'] = '</li>';
        $config2['prev_tag_open'] = '<li>';
        $config2['prev_tag_close'] = '</li>';
        $config2['first_link'] = ' << ';
		$config2['first_tag_open'] = '<li>';		
		$config2['first_tag_close'] = '</li>';
		$config2['last_link'] = ' >> ';
		$config2['last_tag_open'] = '<li>';
		$config2['last_tag_close'] = '</li>';		
		$config2['base_url'] = $base_url_search;
		$config2['total_rows'] = $total_search;
		$config2['per_page'] = $per_page_search;
		
		$entries_articles_search = $this->Mdl_quotidien->get_entries_search($per_page_search, $this->uri->segment(3));
		$config2['uri_segment'] = '3';						
        $this->pagination->initialize($config2);
        $pag_links_article_search = $this->pagination->create_links();
        return array($entries_articles_search, $pag_links_article_search ) ;	
	}	
    	
	public function getJournalToDownload ()
	{		$this->load->helper('download');		
		$this->load->model('admin/Mdl_admin_journal');						
		$data = $this->Mdl_admin_journal->getJournalToDownload($this->input->get('date'));		
		echo json_encode (array("journal"=>$data->pdf)) ;		
	}
	
	public function getJournal ()
	{		
		$data['entrie'] = $this->Mdl_admin->get_entrie_by_date($this->m_d_digit($this->input->get('date')));		
		$this->load->view('journalPdf' , $data) ;	
	}
	
	public function getDefaultJournal ()
	{				
		$data['entrie'] = $this->Mdl_admin->get_entrie_default();				
		$this->load->view('journalPdf' , $data) ;		
	}
			
	public function getDateToDisplay ()
	{
	    $daytoDisplay = array();		;
		$data['date'] = $this->Mdl_admin->get_date();		
		foreach ($data['date'] as $date)
		{					
		 array_push($daytoDisplay,$this->d_m_digit ($date->date)) ;
		}
		
		 ini_set('display_errors', 0);
         header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
         header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
         header("Cache-Control: no-cache, must-revalidate" );
         header("Pragma: no-cache" );
         header("Content-type: application/json");
		
		echo json_encode($daytoDisplay);
	}
	
	private function d_m_digit ($date)
	{	 
		$arr=explode("-",$date);		
		$year=(int)$arr[0];
		$day=(int)$arr[2];
		$month=(int)$arr[1];		
		$newdate=$day."-".$month."-".$year;		
		return $newdate ;	
	}
	
   private function m_d_digit ($date)
   {	 
		$arr=explode("-",$date);		
		$year=(int)$arr[2];
		$day=(int)$arr[0];
		$month=(int)$arr[1];		
		$newdate=$year."-".$month."-".$day;
		
		return $newdate ;	
   }
   
    public function infos()
	{
		$data['title'] = 'Algerie Confulences | Quotidien Algerien en francais';
		$data['entrie'] = $this->Mdl_admin->get_entrie_default();
		$data['main']=('quotidien/infos');
		$data['data'] = $this->_data ;		
		$this->load->view('template' , $data);
	}
			
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
