<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DTController extends CI_Controller {

	/**
	 * Controller class for introduce Datatable Server-Side.
	 *
	 * This class get post parameters defined in html page 
	 * and defines this values for all proccess.
	 * 
	 * The main input variable is $ArrayLoadParams
	 * and default variable return is $DataListReturn.
	 * The Library Dtparams load the data for all times
	 * this proccess, for success in use this resource, need  
	 * set in autoload the Library Dtparams.
	 * 
	 * You can set de default main method input your name, for exemple using 
	 * named method called securty and implements your content , this is strongered
	 * recomended, also you prefer, you can call index method
	 * for trigger chain procecess. This flexibility is possible because
	 * _remap method disponibilizado pelo framework Codeigniter.
	 * 
	 * Maps to the following URL
	 * 		http://localhost/index.php/dtcontroller
	 *	- or -
	 * 		http:/localhost/index.php/dtcontroller/index
	 *	- or -
	 *		http:/localhost/index.php/dtcontroller/security
	 * This case necessary user implements owned security method
	 * in this class or called in your library , helper dentre outros. 
	 *
	 * Developed by Helton de Oliveira
	 * See my Guithub for more solutions
	 * @see https://github.com/heoliveira/ci-datatables-server-side-pagination
	 */

	private $ArrayLoadParams  = array();
	private $DataListReturn   = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DTModel');
	}

	public function _remap($method, $params = array())
	{
		if(method_exists($this, $method))
			return $this->$method();
		else
		return $this->default_method();
	}
	
	private function default_method()
	{
		return $this->index();
	}
	
	private function index()
	{
		$this->init();
		$this->DataListReturn  = $this->DTModel->index();
		return json_encode($this->DataListReturn);
	}

	private function security()
	{
		/** User securty routines */
		return $this->index();
	}
	
	private function TableJoinCheckEmpty($values = array())
	{
		$flag = "";
		foreach ($values as $filedValue) {
			if(empty($filedValue))
			{
				if(empty($flag))
					$flag = true;
				else
					$flag = (true and $flag);
			}
		}
	}
	
	private function TableJoinCheckNoEmpty($values = array())
	{
		$flag = "";
		foreach ($values as $filedValue) {
			if(!empty($filedValue))
			{
				if(empty($flag))
					$flag = true;
				else
					$flag = (true and $flag);
			}
		}
	}

	public function init()
	{
		if (empty($this->input->post('DTModelParams')['TableName']))
		{
			throw new \Exception("{$this->router->class}->{$this->router->method} 
				Erro ao iniciar variavel obrigatória:
					 \$ArrayModelVariables::DTModelParams[TableName]");
		}
		// elseif ($this->TableJoinCheckEmpty($this->input->post('DTModelParams')['TableJoin']) 
		// 	xor $this->TableJoinCheckNoEmpty($this->input->post('DTModelParams')['TableJoin']))
		// {
		// 	throw new \Exception("{$this->router->class}->{$this->router->method} 
		// 		Erro ao iniciar variavel obrigatória:(informe um ou todos os parametros)
		// 			 \$ArrayModelVariables::DTModelParams[TableJoin]");
		// }
		elseif (empty($this->input->post('DTModelParams')['ColumnOrder']))
		{
			throw new \Exception("{$this->router->class}->{$this->router->method} 
				Erro ao iniciar variavel obrigatória:
					 \$ArrayModelVariables::DTModelParams[ColumnOrder]");
		}
		elseif (empty($this->input->post('DTModelParams')['ColumnSearch']))
		{
			throw new \Exception("{$this->router->class}->{$this->router->method} 
				Erro ao iniciar variavel obrigatória:
					 \$ArrayModelVariables::DTModelParams[ColumnSearch]");
		}
		elseif (empty($this->input->post('DTModelParams')['DbConnectionName']))
		{
			throw new \Exception("{$this->router->class}->{$this->router->method} 
				Erro ao iniciar variavel obrigatória:
					 \$ArrayModelVariables::DTModelParams[DbConnectionName]");
		}
		elseif (empty($this->input->post('DTModelParams')['DbConnectionName']))
		{
			throw new \Exception("{$this->router->class}->{$this->router->method} 
				Erro ao iniciar variavel obrigatória:
					 \$ArrayModelVariables::DTModelParams[DbConnectionName]");
		}


		$this->ArrayLoadParams  = [
			'DTModelParams'   => $this->input->post('DTModelParams'),
			'DTFilterView'    => $this->input->post('DTFilterView'),
			'DTModelPaginate' => [
					'Length'           => $this->input->post('length'),
					'Start'            => $this->input->post('start'),
					'Draw'             => $this->input->post('draw'),
					'SearchValue'      => (isset($_POST['search']['value'])?$_POST['search']['value']:NULL),
					'OrderColumnIndex' => (isset($_POST['order'][0]['column'])?$_POST['order'][0]['column']:NULL),
					'OrderColumnDir'  => (isset($_POST['order'][0]['dir'])?$_POST['order'][0]['dir']:NULL)
			],
			'DTModelSQL'     => $this->input->post('DTModelSQL'),
		];

		$this->dtparams->init_all($this->ArrayLoadParams);
		
	}

}