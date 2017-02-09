<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->load->model('app_user_model');
    }
    
    
    function reportAppList(){
    	$jsonData = array();
    	$userlist = $this->input->post('listArr');
    	$html = "";
		$html .= '<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট</title>
		<style>
		@page { margin: 0px; }
		            img {margin:0px;padding:0px}
		th{text-align: left;}
		body, p, div { font-size: 14pt; font-family: nikosh;}
		h3 { font-size: 15pt; margin-bottom:0; font-family: nikosh; }
		#footer {
		    width: 100%;
		    position:relative;
		    left:0;
		    bottom:0;
		}

		</style>
		</head>
		<body>';
        $baseUrl = base_url();
		$html .='<table width="100%">
			<tr>
				<td><img src="'.$baseUrl.'images/pdfHeader.png" style="width: 210mm; height: 297mm; margin: 0;" ></td>
			</tr>
			</table>
			<p style="text-align:center;">আবেদনকারীর তালিকা</p>
			<hr/>';
		
		$html .= '<table width="100%" style="margin-left:00%" class="responstable">
				<thead>
                    <tr style="font-size:12px; background-color: #f5f5f5;">
                        <th style="font-size:10px;text-align:center;">Applicant Name</th>
                        <th style="font-size:10px;text-align:center;">Applicant Mobile</th>
                        <th style="font-size:10px;text-align:center;">District Name</th>
                        <th style="font-size:10px;text-align:center;">Sub District Name</th>
                        <th style="font-size:10px;text-align:center;">Applicant Village</th>
                        <th style="font-size:10px;text-align:center;">Course Name</th>
                        <th style="font-size:10px;text-align:center;">Applicant Photo</th>
                    </tr>
                    </thead>
                    <tbody>';

		
		$applicant_name = array();
    	
    	foreach ($userlist as $value) {
    		array_push($applicant_name, $this->app_user_model->get_single_applicants($value));
    	}
    	
    	for ($i=0;$i<COUNT($applicant_name);$i++) {
    		
    		$applicantImg = FCPATH."/uploaded/downloads/reports/".$applicant_name[$i][0]->applicant_photo;
    		
    		if (file_exists($applicantImg) == FALSE){
    			$dImg = "blank_person.png";
    		}else{
    			$dImg = $applicant_name[$i][0]->applicant_photo;
    		}
    		$html .='<tr style="border-bottom: 1px solid #ddd;font-size:10px;"><td style="border-bottom: 1px solid #ddd;font-size:12px;">'.$applicant_name[$i][0]->applicant_name.'</td><td style="border-bottom: 1px solid #ddd;font-size:12px;">'.$applicant_name[$i][0]->applicant_mobile.'</td><td style="border-bottom: 1px solid #ddd;font-size:12px;">'.$applicant_name[$i][0]->district_name.'</td><td style="border-bottom: 1px solid #ddd;font-size:12px;">'.$applicant_name[$i][0]->sub_district_name.'</td><td style="border-bottom: 1px solid #ddd;font-size:12px;">'.$applicant_name[$i][0]->applicant_village.'</td><td style="border-bottom: 1px solid #ddd;font-size:12px;">'.$applicant_name[$i][0]->course_name.'</td><td style="border-bottom: 1px solid #ddd;font-size:12px;"><img style="width: 10mm; height: 10mm;" src="'.base_url().'uploaded/applicants_photo/'.$dImg.'" /></td></tr>';
    	}
    	
    	//$jsonData['userlist'] = $applicant_name;
    	$html .='</tbody></table>';
    	$currrentDate = time();

		$pdfFilePath = FCPATH."/uploaded/downloads/reports/applicants_list_$currrentDate.pdf";
		//$data['page_title'] = 'Hello world'; // pass data to the view

		if (file_exists($pdfFilePath) == FALSE)

		{

			ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)
			
//			$detail = $this->app_user_model->getall('34');

			$this->load->library('pdf');

			$pdf = $this->pdf->load();

			$pdf->SetFooter('পরিকল্পনা ও বাস্তবায়নে: বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট'.'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure ;)

			$pdf->AddPage();
			$pdf->WriteHTML($html); // write the HTML into the PDF

			$pdf->Output($pdfFilePath, 'F'); // save to file because we can

		}


		$jsonData['filePath'] = $currrentDate;
		
		header("Content-Type: application/json");
        echo json_encode($jsonData);
    }


    function reportApplicant(){
    	$jsonData = array();
    	$userlist = $this->input->post('listArr');
    	

		
		$applicant_name = array();
    	
    	foreach ($userlist as $value) {
    		array_push($applicant_name, $this->app_user_model->getall($value));
    	}
    	
    	for ($i=0;$i<COUNT($applicant_name);$i++) {
    		
    		$applicantImg = FCPATH."/uploaded/downloads/reports/".$applicant_name[$i][0]->applicant_photo;
    		
    		if (file_exists($applicantImg) == FALSE){
    			$dImg = "blank_person.png";
    		}else{
    			$dImg = $applicant_name[$i][0]->applicant_photo;
    		}
    		
    	}
    	
    	$currrentDate = time();

		$pdfFilePath = FCPATH."/uploaded/downloads/reports/applicant_details_list_$currrentDate.pdf";
		$data['page_title'] = 'Hello world'; // pass data to the view

		if (file_exists($pdfFilePath) == FALSE)

		{

			ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)
			
			$detail = $this->app_user_model->getall('34');

			$this->load->library('pdf');

			$pdf = $this->pdf->load();

			$pdf->SetFooter('পরিকল্পনা ও বাস্তবায়নে: বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট'.'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure ;)
			for ($i=0;$i<COUNT($applicant_name);$i++) {
    		
	    		$applicantImg = FCPATH."/downloads/reports/".$applicant_name[$i][0]->applicant_photo;
	    		
	    		if (file_exists($applicantImg) == FALSE){
	    			$dImg = "blank_person.png";
	    		}else{
	    			$dImg = $applicant_name[$i][0]->applicant_photo;
	    		}
	    		$html = "";
				$html .= '<!DOCTYPE html>
				<html lang="en">
				<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta name="description" content="">
				<meta name="author" content="">
				<title>বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট</title>
				<style>
				@page { margin: 0px; }
				            img {margin:0px;padding:0px}
				th{text-align: left;}
				body, p, div { font-size: 14pt; font-family: nikosh;}
				h3 { font-size: 15pt; margin-bottom:0; font-family: nikosh; }
				#footer {
				    width: 100%;
				    position:relative;
				    left:0;
				    bottom:0;
				}

				</style>
				</head>
				<body>';
                $baseUrl = base_url();
				$html .='<table width="100%">
					<tr>
						<td><img src="'.$baseUrl.'images/pdfHeader.png" style="width: 210mm; height: 297mm; margin: 0;" ></td>
					</tr>
					</table>
					<p style="text-align:center;">প্রশিক্ষণের জন্য আবেদনপত্র</p>
					<hr>';
				$html .= 
					'<table width="90%" style="margin-left:10%">
						<tr>
							<th width=350px><span style="color:#F00;"></span>প্রশিক্ষণের বিষয় </th>
							<td><b>'.$applicant_name[$i][0]->course_name.'</b></td>
							<td colspan="8"><img style="width: 20mm; height: 20mm;" src="'.base_url().'uploaded/applicants_photo/'.$dImg.'" /></td>
						</tr>
						<tr>
							<th width=350px><span style="color:#F00;"></span> আবেদনকারীর নামঃ</th>
							<td><b>'.$applicant_name[$i][0]->applicant_name.'</b></td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> পিতার নামঃ</th>
							<td>'.$applicant_name[$i][0]->applicant_father_name.'</td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> জন্ম তারিখঃ</th>
							<td>'.$applicant_name[$i][0]->applicant_date_of_birth.'</td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> জাতীয় পরিচয়পত্রের নাম্বারঃ</th>
							<td>'.$applicant_name[$i][0]->applicant_NID.'</td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> জেন্ডারঃ</th>
							<td>'.$applicant_name[$i][0]->applicant_gender.'</td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> মোবাইল নাম্বারঃ</th>
							<td>'.$applicant_name[$i][0]->applicant_mobile.'</td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> গ্রামঃ</th>
							<td>'.$applicant_name[$i][0]->applicant_village.'</td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> ডাকঘরঃ</th>
							<td>'.$applicant_name[$i][0]->applicant_post_office.'</td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> জেলাঃ</th>
							<td>'.$applicant_name[$i][0]->district_name.'</td>
						</tr>
						<tr>
							<th><span style="color:#F00;"></span> উপজেলাঃ</th>
							<td>'.$applicant_name[$i][0]->sub_district_name.'</td>
						</tr>
						
					</table>';
	    		$pdf->AddPage();
	    		$pdf->WriteHTML($html); // write the HTML into the PDF
	    	}

			

			$pdf->Output($pdfFilePath, 'F'); // save to file because we can

		}


		$jsonData['filePath'] = $currrentDate;
		
		header("Content-Type: application/json");
        echo json_encode($jsonData);
    }
}
?>