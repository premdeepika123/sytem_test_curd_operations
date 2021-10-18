<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_data_import extends CI_Controller {
 function __construct()

	{

		parent::__construct();
		$this->load->model('import_excel_model');
		$this->controller = 'category';

	}

	public function index()
	{
		$this->load->view('import_data_view');
	}


	function import1(){
        $this->load->library('excel_reader/PHPExcel');
     	$this->load->library('excel_reader/PHPExcel/Iofactory');

		if ((!empty($_FILES['file_name']['name'])) && ($_FILES['file_name']['size'] > 0)) {

			//print_r($_FILES['file_name']);exit;

			$array = explode('.', $_FILES['file_name']['name']);
            
            $extension       = end($array);
            $valid_extension = array(
                "xlsx",
                "csv",
                "xls"
            );
            if (in_array($extension, $valid_extension)) {
                
                $config['upload_path']   = 'assets/excel_files';
                $config['allowed_types'] = '*'; // all file
                $config['encrypt_name']  = false;
                
                //print_r($config['allowed_types']); exit();
                
                $this->load->library('upload');
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file_name')) {
                    
                    $data1 = $this->upload->data();
                    $file  = 'assets/excel_files/' . $data1['file_name'];
                    
                    $objPHPExcel = $this->iofactory->load($file);
                    $sheetCount  = $objPHPExcel->getSheetCount();

                    $inventory_master_data = array();
                    for ($i = 0; $i < $sheetCount; $i++) {
                        $csv_data = array();
                        //$csv_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                        $csv_data = $objPHPExcel->setActiveSheetIndex($i)->toArray(null, true, true, true);
                        if (array_key_exists('B', $csv_data[1])) {
                            foreach ($csv_data as $key => $value) {
                                if ($key == 1) {
                                    continue;
                                } else {
                                    $exceldata                 = array();
                                    $exceldata['username']     = trim($value['A']);
                                    $exceldata['email_id']    = trim($value['B']);
                                    $exceldata['address']    = trim($value['C']);
                                    $exceldata['gender']    = trim($value['D']);
                                    $exceldata['qualification']    = trim($value['E']);
                                    $excel_master_data[] = $exceldata;
                                }
                            }
                        }

                      }


                       //print_r($exceldata_master_data); exit;

                       /* Release memory occupied by php excel object*/
                    $objPHPExcel->disconnectWorksheets();
                    unset($objPHPExcel);
                    
                    //pre($inventory_master_data,1);
                    
                    //Insert dump data as a batch 


                    if (!empty($excel_master_data) && count($excel_master_data) > 0) {
                        
                        $details_arr = $this->import_excel_model->batchInsertdata($excel_master_data);
                    }

                    //unset($csv_data);
                    //unset($exceldata_master_data);
                    unlink($file);
                    
                    //die();

                    $this->session->set_flashdata('succmsg', 'Sucessfully ' . $extension . ' file imported');
                    redirect(base_url() . "index.php/excel_data_import/");
                    


                }
            }else{

                $this->session->set_flashdata('errmsg', 'Only ' . $valid_extension[0] . ','.$valid_extension[1] .','.$valid_extension[2] .' '.'extension are allowed.');
                    redirect(base_url() . "index.php/excel_data_import/");


            } 

        }

    }

  }
?>