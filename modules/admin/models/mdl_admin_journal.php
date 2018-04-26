<?php
class Mdl_admin_journal extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function get_date() 
	 {
	 
	 	$this->db->select('date') ;
	 	$Q=$this->db->get('tb_journal') ;
	 	return $Q->result();
	 
	 
	 }
    
    
    function get_entries($limit = NULL, $offset = NULL)
    {
    	$this->db->limit($limit, $offset);       
        $query = $this->db->get('tb_journal');
        
        return $query->result();
    }
    
	 function count_entries()
	 {
	  return $this->db->count_all_results('tb_journal');
	 }
	 
	 function get_entrie($id)
	 {
	   $this->db->where('id_journal' , $id);
	   $this->db->limit(1);
	   $Q = $this->db->get('tb_journal');
	   
	   return $Q->row();
	 }
	 
	 
	 function getJournalToDownload($date)
	 {
	 	
	 	$date_to_explode = explode("-" , $date );
	 	
	 	$this->db->where('date' , $date_to_explode[2].'-'.$date_to_explode[1].'-'.$date_to_explode[0]);
	   $this->db->limit(1);
	   $Q = $this->db->get('tb_journal');
	   
	   return $Q->row();
	 	
	 }
	 
	function get_entrie_by_date($date)
		 {
		   $this->db->where('date' , $date);
		   $this->db->limit(1);
		   $Q = $this->db->get('tb_journal');
		   
		   return $Q->row();
		 }
	 
	 function create_entrie()
	 {	
	 	$this->load->helper('date'); 
	 	$datestring = "%Y-%m-%d %h:%i:%a";
        $time = time();
	 	
	 	$pdf =  $this->upload_pdf(); 	
	 	$image =  $this->upload_image();
	 	
	 	if($this->input->post('id_journal') == 0 )
	 	{
		 	if($pdf['file_name'] && $image['file_name'] )
		 	{
			 	$data  = array(
			 	  'numero_journal'=>$this->input->post('numero'),
			 	  'image'=>$image['file_name'],
			 	  'pdf'=>$pdf['file_name'],
			 	  'date'=>$this->input->post('date'),
			 	  'created'=>unix_to_human(time(), TRUE, 'eu'),
			 	  'updated'=>unix_to_human(time(), TRUE, 'eu')			 	
			 	);
			 	$this->db->limit(1);
			 	$this->db->insert('tb_journal' , $data);
			 	
			 	if($this->db->affected_rows())
			 	{
			 		redirect('admin/journals/');
			 	}
			 	
		 	}
	 	}else{
	 	
	 	if(isset($pdf['file_name']) && isset($image['file_name']) )
		 	{
			 	$data  = array(
			 	  'numero_journal'=>$this->input->post('numero'),
			 	  'image'=>$image['file_name'],
			 	  'pdf'=>$pdf['file_name'],
			 	  'date'=>$this->input->post('date'),			 	  
			 	  'updated'=>unix_to_human(time(), TRUE, 'eu'),
			 	
			 	);
			 	$this->db->limit(1);
			 	$this->db->where('id_journal' , $this->input->post('id_journal'));
			 	$this->db->update('tb_journal' , $data);
			 	
			 	if($this->db->affected_rows())
			 	{
			 		redirect('index.php/admin/journals/');
			 	}
			 	
		 	}
	 	    elseif(!isset($pdf['file_name']) && ! isset($image['file_name']) )
		 	{
		 	$data  = array(
			 	  'numero_journal'=>$this->input->post('numero'),			 	  
			 	  
			 	  'date'=>$this->input->post('date'),			 	  
			 	  'updated'=>unix_to_human(time(), TRUE, 'eu')			 	
			 	);
			 	$this->db->limit(1);
			 	$this->db->where('id_journal' , $this->input->post('id_journal'));
			 	$this->db->update('tb_journal' , $data);
			 	
			 	if($this->db->affected_rows())
			 	{
			 		redirect('index.php/admin/journals/');
			 	}
		 	
		 	}
		 	elseif(isset($pdf['file_name']) && ! isset($image['file_name']) )
		 	{
		 	$data  = array(
			 	  'numero_journal'=>$this->input->post('numero'),			 	  
			 	  'pdf'=>$pdf['file_name'],
			 	  'date'=>$this->input->post('date'),			 	  
			 	  'updated'=>unix_to_human(time(), TRUE, 'eu')			 	
			 	);
			 		$this->db->limit(1);
			 	$this->db->where('id_journal' , $this->input->post('id_journal'));
			 	$this->db->update('tb_journal' , $data);
			 	
			 	if($this->db->affected_rows())
			 	{
			 		redirect('index.php/admin/journals/');
			 	}
		 	
		 	}
		 	elseif(isset($image['file_name']) && !isset($pdf['file_name']) )
		 	{
		 		
		 	$data  = array(
			 	  'numero_journal'=>$this->input->post('numero'),			 	  
			 	  'image'=>$image['file_name'],
			 	  'date'=>$this->input->post('date'),			 	  
			 	  'updated'=>unix_to_human(time(), TRUE, 'eu')		 	
			 	);
			 	$this->db->limit(1);
			 	$this->db->where('id_journal' , $this->input->post('id_journal'));
			 	$this->db->update('tb_journal' , $data);
			 	
			 	if($this->db->affected_rows())
			 	{
			 		redirect('index.php/admin/journals/');
			 	}
		 	}
	 	}
	 }
	 
	 private function upload_pdf()
	 {
	   $config['upload_path'] = './pdf/';
	   $config['allowed_types'] = 'pdf';
	   
	   $this->load->library('upload', $config);
	   $this->upload->initialize($config); 
	    if ( ! $this->upload->do_upload('pdf'))
		{
			$error = array('error' => $this->upload->display_errors());            
			return $error ;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());			
			return $this->upload->data() ;
		}	   
	 }
	 
	 private function upload_image()
	 {
	   $config['upload_path'] = './photos/';
	   $config['allowed_types'] = 'gif|jpg|png';
	   
	   $this->load->library('upload', $config);
	   $this->upload->initialize($config); 
	    if ( ! $this->upload->do_upload('image'))
		{
			$error = array('error' => $this->upload->display_errors());            
			print_r( $error) ;
			die();
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());			
			return $this->upload->data() ;
		}
	 }
	 
	 public function delete_entrie ()
	 {
	   $this->db->where('id_journal' ,  $this->input->post('id_journal'));
	   $this->db->limit(1);
	   $this->db->delete('tb_journal') ;
	   if($this->db->affected_rows() == 1)
	   {
	    echo json_encode(array("answer"=>true));
	   }   
	   
	 }
	 
	 public function dafault_journal() 
	 {
	 
	  $data = array ( 'default' => '0' ) ;
	  $this->db->where('default' , '1');
	  $this->db->update('tb_journal' , $data) ;
	  
	  if($this->db->affected_rows() > 0)
	  {
	  
	  $data_default = array ( 'default' => '1' ) ;
	  $this->db->where('id_journal' , $this->input->post('dafault'));
	  $this->db->update('tb_journal' , $data_default) ;
	  
	  }  
	  	 
	 }
	 
	 public function  get_entrie_default ()
	 {
	 		 
	 $this->db->where('default' , '1'); 
	 
	 $Q = $this->db->get('tb_journal');		   
      return $Q->row();
	 
	 }
	 
	 public function get_all_journal ($year , $month)
	 {
	 	//$this->db->where('date' , $year.'-'.$month);
	 	
	 	$this->db->select('date , pdf ') ;
	 	
	 	$this->db->like('date', $year.'-'.$month); 
	 	
	 	$query = $this->db->get('tb_journal');
	 	
	 	$array_date = array ();
	 	$array_pdf = array ();
	 	
	 	
	 	
	 	foreach ( $query->result() as $row )
	 	{	 	
	 		$date= explode('-' , $row->date);
	 		
	 		array_push($array_date, ltrim($date[2] , '0'));	 

	 		array_push($array_pdf, $row->pdf);	
	 	}
	 	
	 !empty ($array_date) &&  !empty($array_pdf) ?	$array_combine = array_combine($array_date , $array_pdf )  : $array_combine = array() ;
        
        return $array_combine;
	 	 
	 }
	 
	 

}