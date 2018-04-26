<?php
class Mdl_quotidien extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_entries_search($limit = NULL, $offset = NULL)
    {
    	$this->db->order_by("created", "desc");
        $this->db->where('published' , 1) ;
        if($this->input->get('q') !='')
        {
        $this->db->like('title' , $this->input->get('q'));
        $this->db->or_like('title_2' , $this->input->get('q'));
        $this->db->or_like('content' , $this->input->get('q'));
        $this->db->or_like('introtext' , $this->input->get('q'));
        }
    	$this->db->limit($limit, $offset);       
        $query = $this->db->get('tb_active_articles');
        
        return $query->result();
    }  

     function count_entries_search()
	 {
                 $this->db->where('published' , 1) ;
                  if($this->input->get('q') !='')
       			 {
                 $this->db->like('title' , $this->input->get('q'));
                 $this->db->or_like('title_2' , $this->input->get('q'));
        		 $this->db->or_like('content' , $this->input->get('q'));
        		 $this->db->or_like('introtext' , $this->input->get('q'));
        		 }
	             return $this->db->count_all_results('tb_active_articles');
	 }
    
  
}