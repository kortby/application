<?php
class Mdl_admin_article extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
         
    
    function get_entries($limit = NULL, $offset = NULL)
    {
    	$this->db->order_by("created", "desc");
        $this->db->where('published' , 1) ;
    	$this->db->limit($limit, $offset);       
        $query = $this->db->get('tb_articles');
        
        return $query->result();
    }
    
	 function count_entries()
	 {
         $this->db->where('published' , 1) ;
	     return $this->db->count_all_results('tb_articles');
	 }
	 
	 function count_active_entries()
	 {
	   $this->db->where('active' , 'checked="checked"') ;
	             return $this->db->count_all_results('tb_active_articles');
	 }
	 
    function get_active($limit = NULL, $offset = NULL)
    {
    	$this->db->order_by("created", "desc"); 
        $this->db->where('active' , 'checked="checked"') ;
    	$this->db->limit($limit, $offset);       
        $query = $this->db->get('tb_active_articles');
        
        return $query->result();
    }
	 
	 /***************************************************************/
	 
	 function get_entrie($id)
	 {
	   $this->db->where('id_article' , $id);
	   $this->db->limit(1);
	   $Q = $this->db->get('tb_articles');
	   
	   return $Q->row();
	 }
	 
     function get_entrie_by_slug($slug)
	 {
	   $this->db->where('slug' , $slug);
	   $this->db->limit(1);
	   $Q = $this->db->get('tb_articles');
	   
	   return $Q->row();
	 }
	 
	 function get_entrie_title ($slug)
	 {
	    $this->db->select('title');
	 	$this->db->where('slug' , $slug);
	    $this->db->limit(1);
	    $Q = $this->db->get('tb_articles');	   
	    $result = $Q->row();	    
	    return $result->title ;
	 }
	 
     function get_active_entrie($id)
	 {
	   $this->db->where('id_active_article' , $id);
	   $this->db->limit(1);
	   $Q = $this->db->get('tb_active_articles');
	   
	   return $Q->row();
	 }
	 
    function get_active_entrie_by_slug($slug)
	 {
	   $this->db->where('slug' , $slug);
	   $this->db->limit(1);
	   $Q = $this->db->get('tb_active_articles');
	   
	   return $Q->row();
	 }
	 
	 
	 function get_entrie_active_title($slug)
	 {
	 	$this->db->select('title');
	 	$this->db->where('slug' , $slug);
	    $this->db->limit(1);
	    $Q = $this->db->get('tb_active_articles');
	    	   
	    $result = $Q->row();
	    	    
	    return $result->title ;	 
	 
	 }
	 
	function get_entrie_by_date($date)
		 {
		   $this->db->where('date' , $date);
		   $this->db->limit(1);
		   $Q = $this->db->get('tb_articles');
		   
		   return $Q->row();
		 }
	 
	 function create_entrie()
	 {	
	 	$this->load->helper('date'); 
	 	$datestring = "%Y-%m-%d %h:%i:%a";
        $time = time();
        
        $config = array(
		    'field' => 'slug',
		    'title' => 'title',
		    'table' => 'tb_articles' ,
		    'id' => 'id_article',
		   );
		
		$this->load->library('slug', $config);
	 		 	
	 	if($this->input->post('id_article') == 0 )
	 	{		 	
		 	$data  = array(
		 	  'title'=>$this->input->post('title'),		 	  
		 	  'content'=>$this->input->post('content'),
		 	  'author'=>$this->input->post('author'),
		 	  'date'=>$this->input->post('_date'),
		 	  'journal_reference'=>$this->input->post('journal_reference'),
			  'published'=>$this->input->post('published'), 
			  'archived 	'=>$this->input->post('archived'), 
		 	  'created'=>unix_to_human(time(), TRUE, 'eu'),
		 	  'updated'=>unix_to_human(time(), TRUE, 'eu')		 	
		 	);
		 	
		 	$data['slug'] = $this->slug->create_uri($data);
		 	
		 	$this->db->insert('tb_articles' , $data);
		 	
		 	if($this->db->affected_rows())
		 	{
		 		redirect('admin/articles');
		 	} 	
		 	
	 	}else{	 	
		 	$data  = array(
			 	  'title'=>$this->input->post('title'),
			 	  'content'=>$this->input->post('content'),
			 	  'author'=>$this->input->post('author'),
			 	  'date'=>$this->input->post('_date'),
			 	  'journal_reference'=>$this->input->post('journal_reference'),
				  'published'=>$this->input->post('published'), 
				  'archived '=>$this->input->post('archived'),			 	  
			 	  'updated'=>unix_to_human(time(), TRUE, 'eu')			 	
			 	);
			 	$data['slug'] = $this->slug->create_uri($data);
			 	$this->db->where('id_article' , $this->input->post('id_article') );
			 	$this->db->update('tb_articles' , $data);
			 	
			 	if($this->db->affected_rows())
			 	{
			 		redirect('index.php/admin/articles');
			 	} 	
	 	}
	 }
	 
	 public function delete_entrie ()
	 {
	   $this->db->where('id_article' ,  $this->input->post('id_article'));
	   $this->db->limit(1);
	   $this->db->delete('tb_articles') ;
	   if($this->db->affected_rows() == 1)
	   {
	    echo json_encode(array("answer"=>true));
	   }   
	   
	 }
	 	 
	 public function  get_entrie_default ()
	 {
	 	
	     $this->db->order_by("created", "asc");
	     $this->db->limit(1); 
	     $Q =  $this->db->get('tb_articles');		   
         return $Q->row();
	 
	 }
	 
	 public function articles_active_entrie($id)
     {
	 	
		 $this->db->where('id_active_article ' ,  $id);
		 $this->db->limit(1); 
		 $Q =  $this->db->get('tb_active_articles');		   
	     return $Q->row();
	 
	 }
	 
	 public function get_active_article()
	 {	 
	 	$this->db->select('id_active_article , title , introtext ');	
	 	$this->db->where('published' , 1) ;
	 	$this->db->order_by("created", "desc");
	 	$this->db->where('active' , 'checked="checked"') ;    	      
        $query = $this->db->get('tb_active_articles');        
        return $query->result();
        	 	
	 }
	 	 
     function update_check_active_entrie()
	 {
	 	$checked = 'checked="checked"' ;
	 	$array = $this->check_active_article ($this->input->post('id_active')) ; 
	 	if($array->active == $checked )
	 	{
	 		$data = array( 'active' => '' ) ;
	 	}else{
	 		$data = array( 'active' => $checked ) ;
	 	}
	 	
	 	$this->db->where('id_active_article' , $this->input->post('id_active'));
		$this->db->update('tb_active_articles' , $data);
		
		if($this->db->affected_rows() == 1)
		{
		    echo json_encode(array("answer"=>true));
		} 	
	 }
	 
	 function check_active_article ($id)
	 {
	 	$this->db->select('active') ;
	 	$this->db->where('id_active_article' , $id) ;	 	
	 	$Q = $this->db->get('tb_active_articles');	   
	    return $Q->row();	 	
	 	
	 }
	 
	 /**********************activate_article**************************/
	 
	 function create_active_entrie()
	 {	
	 	$this->load->helper('date'); 
	 	$datestring = "%Y-%m-%d %h:%i:%a";
        $time = time();
        
        $this->input->post('published') ? $checked = 'checked="checked"' : $checked ='';
        
        $content = explode( '<hr />' , $this->input->post('content') );
        
        if (!$content[1])
        {
	        $introtext = '';
	        $fulltext = $content[0];
        }else{
        	$introtext = $content[0];
            $fulltext = $content[1];
        }
        
        $config = array(
		    'field' => 'slug',
		    'title' => 'title',
		    'table' => 'tb_active_articles' ,
		    'id' => 'id_active_article',
		   );
		
		$this->load->library('slug', $config);
	 		 	
	 	if($this->input->post('id_article') == 0 )
	 	{		 	
		 	$data  = array(
		 	  'title'=>$this->input->post('title'),
		 	  'title_2'=>$this->input->post('title_2'),
		 	  'introtext'=>$introtext,
		 	  'content'=>$fulltext,
		 	  'author'=>$this->input->post('author'),
		 	  'date'=>$this->input->post('_date'),
		 	  'journal_reference'=>$this->input->post('journal_reference'),
		 	  'active'=> $checked, 
			  'published'=>$this->input->post('published'), 
			  'archived 	'=>$this->input->post('archived'), 
		 	  'created'=>unix_to_human(time(), TRUE, 'eu'),
		 	  'updated'=>unix_to_human(time(), TRUE, 'eu')		 	
		 	);
		 	$data['slug'] = $this->slug->create_uri($data);
		 	$this->db->insert('tb_active_articles' , $data);
		 	
		 	if($this->db->affected_rows())
		 	{
		 		redirect('admin/activearticles');
		 		
		 	
		 	} 	
		 	
	 	}else{	 	
		 	$data  = array(
			 	  'title'=>$this->input->post('title'),
		 		   'title_2'=>$this->input->post('title_2'),
			 	  'introtext'=>$introtext,
		 	       'content'=>$fulltext,
			 	  'author'=>$this->input->post('author'),
			 	  'date'=>$this->input->post('_date'),
			 	  'journal_reference'=>$this->input->post('journal_reference'),
		 	      'active'=> $checked, 
				  'published'=>$this->input->post('published'), 
				  'archived '=>$this->input->post('archived'), 
			 	  
			 	  'updated'=>unix_to_human(time(), TRUE, 'eu')			 	
			 	);
			 	$data['slug'] = $this->slug->create_uri($data);
			 	$this->db->where('id_active_article' , $this->input->post('id_article') );
			 	$this->db->update('tb_active_articles' , $data);
			 	
			 	if($this->db->affected_rows())
			 	{
			 		redirect('admin/activearticles');
			 	} 	
	 	}
	 }
	 
	 
	 
	 public function delete_active_entrie ()
	 {
	   $this->db->where('id_active_article' ,  $this->input->post('id_article'));
	   $this->db->limit(1);
	   $this->db->delete('tb_active_articles') ;
	   if($this->db->affected_rows() == 1)
	   {
	    echo json_encode(array("answer"=>true));
	   }   
	   
	 }
	 
  
}