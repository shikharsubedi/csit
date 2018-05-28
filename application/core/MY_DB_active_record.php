<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
	
class MY_DB_active_record extends CI_DB_active_record
{
	public $total_records  = 0;
	
	function get($table = '', $limit = null, $offset = null)
	{
		//$CI = & get_instance();
		
		global $db_filters;
		//show_pre($db_filters);exit;
		if(count($db_filters) > 0)
			foreach($db_filters as $f)
				$this->where(key($f),$f[key($f)]);
				
		
		if ($table != '')
		{
			$this->_track_aliases($table);
			$this->from($table);
		}
		
		$sql_no_limit = $this->_compile_select();
		
		if ( ! is_null($limit))
		{
			$this->limit($limit, $offset);
		}

		$sql = $this->_compile_select();

		$result = $this->query($sql);
		//$total_records = $this->query($sql_no_limit)->num_rows();
		
		$this->_reset_select();
		
		//log_message('debug',$this->last_query()."\n");
		return $result;
	}
}
?>