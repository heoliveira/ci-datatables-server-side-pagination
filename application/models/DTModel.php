<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dtmodel extends CI_Model {

	/**
	 * Model class for implement Database methos for Datatable Server-Side.
	 *
	 * Through this class is possible paginate data with CI Query Builder or
	 * Oracle SQL Query ambos simular mode Lazy mode propused Java resources.
	 * SQL query string usig in this class need by tested for MySQL e SQL Server 
	 * and other databases , guive help to me your contribuition 
	 * and growth more yours develope comuniy.
	 * 
	 * The mecanism is very simple , call this class, send CI database name , 
	 * and send SQL query Oracle or Query Builder parameters.
	 * Structure data retorned by Library Dtparamns in variables
	 * $this->DataListReturn  and $DataListReturnOutput, modelate 
	 * json data.
	 * 
	 * Maps to the following URL
	 * 		http://localhost/index.php/dtcontroller
	 *	- or -
	 * 		http:/localhost/index.php/dtcontroller/index
	 *
	 * Developed by Helton de Oliveira
	 * See my Guithub for more solutions
	 * @see https://github.com/heoliveira/ci-datatables-server-side-pagination
	 */

	
	private $dbConnectionName = NULL;
 	
    public function construct()
    {
		parent::__construct();

    }

	public function index()
	{   
		$dbAux = ($this->dtparams->getDbConnectionName() === "db" 
			? "default" 
			: $this->dtparams->getDbConnectionName());

		$this->dbConnectionName 
			= $this->load->database($dbAux, true);

		if(empty($this->dtparams->getDTModelSQL()))
			$this->SQLModeQueryBuilder();
		else
		 	$this->SQLModeQueryString();
	
		return ;
	}

	private function SQLModeQueryBuilder()
	{
		/** Make select and from clausere */
		$this->makeSelectFrom();

		/** Make join tables */
		$this->makeJoin();

		/** Get filters for query by params */
		$this->makeViewFilter();

		/** Count total records */
		$this->countAllRecords();

		/** Build dinamic datatable filter */
		$this->makeDinamicFilter();

		/** Count filtered records */
		$this->countFilteredRecords();
		
		/** Ordering columns */
		$this->orderColumns();

		/** Set limit pagination  */ 
		$this->setLimitPatination();

		/** Get data return for datatable */
		$this->DataListReturn      = $this->dbConnectionName->get();

		/** Get final list data to return */
		$DataListReturnOutput = $this->makeDataReturn();
		echo json_encode($DataListReturnOutput);

	}

	private function SQLModeQueryString()
	{
		/** Get filters for query by params */
		$this->makeViewFilterQueryString();
		
		/** Build dinamic datatable filter */
		$this->makeDinamicFilterQueryString();

		/** Ordering columns */
		$this->orderColumnsQueryString();

		/** Count total records */
		$this->countAllRecordsQueryString();


		/** Count filtered records */
		$this->countFilteredRecordsQueryString();
		
		/** Set limit pagination  */ 
		$this->setLimitPatinationQueryString();

		/** Get data return for datatable */
		$this->DataListReturn      
			= $this->dbConnectionName->query($this->dtparams->getDTModelSQL());

		/** Get final list data to return */
		$DataListReturnOutput = $this->makeDataReturn();
		echo json_encode($DataListReturnOutput);
	}

	private function makeSelectFrom()
	{
		/** Filds for select columns */
		$this->dbConnectionName->select(implode(",", $this->dtparams->getColumnOrder()));

		/** Table name for query */
		$this->dbConnectionName->from(str_replace("'"," ",$this->dtparams->getTableName()));
	}

	private function makeJoin()
	{   
		foreach((array) $this->dtparams->getTableJoin() as $join)
			$this->dbConnectionName
				->join($join['TABLE_LEFT'] , ($join['TABLE_LEFT'] . "." . $join['KEY_TB_LEFT'] . " = " . $join['TABLE_RIGHT']. "." . $join['KEY_TB_RIGHT']) , $join['DIRECTION'] );
	}

	private function makeViewFilter()
	{	
		foreach((array) $this->dtparams->getDTFilterView() as $filter)
			$this->dbConnectionName->like($filter[0],$filter[1],"after");
	}

	private function makeViewFilterQueryString()
	{	
		$i = 0 ;
		$sql = $this->dtparams->getDTModelSQL();
		//$sql = "SELECT inner_sql.* FROM ($sql) inner_sql ";
		foreach((array) $this->dtparams->getDTFilterView() as $filter) {
			if($i===0)
			{
				if(strpos($filter[1], "NULL"))
					$sql = $sql .  " WHERE $filter[0] IS '$filter[1]%'";
				else
					$sql = $sql .  " WHERE $filter[0] LIKE '$filter[1]%'";
			}else{
				if(strpos($filter[1], "NULL"))
					$sql = $sql .  " AND $filter[0] IS '$filter[1]%'";
				else
					$sql = $sql .  " AND $filter[0] LIKE '$filter[1]%'";
			}
			$i++;

			ECHO $sql;
		}
		$this->dtparams->setDTModelSQL($sql);


	}

	private function countAllRecords()
	{   
		$sql = $this->dbConnectionName->get_compiled_select('',false);
		$DataListReturnAux = $this->dbConnectionName->query($sql)->result_array();
		$this->dtparams->setrecordsTotal(count($DataListReturnAux)); 
	}

	private function countAllRecordsQueryString()
	{   
		$DataListReturnAux = $this->dbConnectionName->query($this->dtparams->getDTModelSQL())->result_array();
		$this->dtparams->setrecordsTotal(count($DataListReturnAux)); 
	}

	private function makeDinamicFilter()
	{
		$i = 0; 
		foreach((array) $this->dtparams->getColumnSearch() as $ColumnName)
        {
            if($this->dtparams->getSearchValue()){
                if($i===0){
                    $this->dbConnectionName->group_start();
                    $this->dbConnectionName->like($ColumnName, $this->dtparams->getSearchValue(),"after");
                }else{
                    $this->dbConnectionName->or_like($ColumnName, $this->dtparams->getSearchValue(),"after");
                }
                
                if(count($this->dtparams->getColumnSearch()) - 1 == $i){
                    $this->dbConnectionName->group_end();
                }
            }
            $i++;
        }
	}

	private function makeDinamicFilterQueryString()
	{
		if($this->dtparams->getSearchValue())
		{
			$i   = 0; 
			$sql = $this->dtparams->getDTModelSQL();

			if(empty($this->dtparams->getSearchValue()))
				$sql = $sql .  " WHERE (";
			else
				$sql = $sql .  " AND (";

			foreach((array) $this->dtparams->getColumnSearch() as $ColumnName)
			{
				if($i === 0)
					$sql = $sql .  " ($ColumnName LIKE '" . $this->dtparams->getSearchValue() . "%') ";
				else
					$sql = $sql .  " OR ($ColumnName LIKE '" . $this->dtparams->getSearchValue() . "%')";
					
				if(count($this->dtparams->getColumnSearch()) - 1 == $i)
					$sql = $sql . ")";

				$i++;
			}

			$this->dtparams->setDTModelSQL($sql);
		}
	}

	private function countFilteredRecords()
	{
		$sql = $this->dbConnectionName->get_compiled_select('',false);
		$DataListReturnAux = $this->dbConnectionName->query($sql)->result_array();
		$this->dtparams->setrecordsFiltered(count($DataListReturnAux)); 
	}

	private function countFilteredRecordsQueryString()
	{
		$sql = $this->dtparams->getDTModelSQL();
		$DataListReturnAux = $this->dbConnectionName->query($sql)->result_array();
		$this->dtparams->setrecordsFiltered(count($DataListReturnAux)); 
	}

	private function orderColumns()
	{
		$ArrayColumnOrder = $this->dtparams->getColumnOrder();
		$IndexField       = ($this->dtparams->getOrderColumnIndex() === 0 
			? -1
			: ($this->dtparams->getOrderColumnIndex()-1));

		if ( $this->dtparams->getOrderColumnIndex() > 0)
			$this->dbConnectionName->order_by($ArrayColumnOrder[$IndexField], 
				$this->dtparams->getOrderColumnDir());
		elseif (!empty($this->dtparams->getColumnOrderable()))
			$this->dbConnectionName->order_by(implode(",", $this->dtparams->getColumnOrderable()));
	}

	private function orderColumnsQueryString()
	{
		$orderColumns     = NULL;
		$ArrayColumnOrder = $this->dtparams->getColumnOrder();
		$sql              = $this->dtparams->getDTModelSQL();
		$IndexField       = ($this->dtparams->getOrderColumnIndex() === 0 
			? -1
			: ($this->dtparams->getOrderColumnIndex()-1));

		if ( $this->dtparams->getOrderColumnIndex() > 0)
			$orderColumns = $ArrayColumnOrder[$IndexField] . " " . $this->dtparams->getOrderColumnDir();
		elseif (!empty($this->dtparams->getColumnOrderable()))
			$orderColumns = implode(",", $this->dtparams->getColumnOrderable());

		if ($orderColumns) {
			$sql = $sql . " ORDER BY $orderColumns ";
			$this->dtparams->setDTModelSQL($sql);
		}

		return ;
	}

	private function setLimitPatination()
	{
		if($this->dtparams->getLength() != -1)
			$this->dbConnectionName->limit($this->dtparams->getLength(),
			$this->dtparams->getStart());
	}

	private function setLimitPatinationQueryString()
	{
		if($this->dtparams->getLength() != -1) 
		{
			$sql        = $this->dtparams->getDTModelSQL();
			$rowsEnd    = ($this->dtparams->getStart() == 0 
				? $this->dtparams->getLength() 
				: $this->dtparams->getStart());
			$rowsEnd++;
			$rowsLength  = $this->dtparams->getLength();
			$rowsLength++;

			$sql = "SELECT inner_query.* FROM($sql) inner_query WHERE ROWNUM < $rowsEnd ORDER BY ROWNUM DESC ";
			$sql = "SELECT inner_query.* FROM($sql) inner_query WHERE ROWNUM < $rowsLength";
			$this->dtparams->setDTModelSQL($sql);
		}
	}

	private function replaceDataValue($value = NULL, $array = array())
	{
		foreach ($array as $elementReplace) {
			if($elementReplace[0] === $value)
				return $elementReplace[1];
		}
			
		return $value;
	}

	private function replaceData($array = array())
	{
		
		$columnReplace = $this->dtparams->getColumnReplace();
		foreach ($columnReplace as $columnReplaceItem) {
			$array[$columnReplaceItem["INDEX"]]
			   =  $this->replaceDataValue($array[$columnReplaceItem["INDEX"]] , $columnReplaceItem["REPLACE"]);
			}

			return $array;
	}

	private function makeDataReturn()
	{
		
		$data = array();
		$i = $this->dtparams->getStart();
        foreach((array) $this->DataListReturn->result_array() as $list)
        {
			$i++;
			$arrayString     =  implode("," , $list);
			$arrayString     = ($i . "," . $arrayString);
			$arrayString     = explode(",", $arrayString);
			$arrayString     = $this->replaceData($arrayString);
			$data[] = $arrayString; 
		}

        $DataListReturnOutput = array(
            "draw" => $this->dtparams->getDraw(),
            "recordsTotal" => $this->dtparams->getrecordsTotal() ,
			"recordsFiltered" => ($this->dtparams->getrecordsFiltered()===NULL
									? $this->dtparams->getrecordsTotal()
									: $this->dtparams->getrecordsFiltered()),
            "data" => $data,
		);
		
		return $DataListReturnOutput;
	}

}