<?php 
// print_r($detail);
// echo $detail[0]->applicant_name;

/*<p style="text-align:center;">'.$online_application .' '.$confirmation.'</p>
<hr>*/
$html = "";
$html .= '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>... AIS. ..</title>
<style>
@page { margin: 0px; }
            img {margin:0px;padding:0px}
th{text-align: left;}
body, p, div { font-size: 14pt; font-family: nikosh;}
h3 { font-size: 15pt; margin-bottom:0; font-family: nikosh; }
#footer {
    width: 100%;
    position:relative;
    right:160px;
    bottom:0;
}

</style>
</head>
<body>';

$baseUrl = base_url();
$image_url =$baseUrl.'uploaded/applicants_photo/'.$single_applicant['applicant_photo'];
$html .='<table width="100%">
	<tr>
		<td><img src="'.$baseUrl.'images/pdfHeader.png" style="width: 210mm; height: 297mm; margin: 0;" ></td>
	</tr>
	</table>

	<p style="text-align:center;">'.$application_for_training.'</p>
	<hr>';
$html .= 
	'<table width="90%" style="margin-left:10%" height="80%">
		<tr>
			<th width=350px><span style="color:#F00;"></span>'.$application_subject.'</th>
			<td><b>'.$single_applicant['course_name'].'</b></td>
			<td colspan="8"><img src="'.$image_url.'" style="width: 15mm; height: 20mm; margin: 0;" ></td>
		</tr>
		<tr>
			<th width=350px><span style="color:#F00;"></span>'.$applicant_name.'ঃ</th>
			<td><b>'.$single_applicant['applicant_name'].'</b></td>
		</tr>
		<tr>
			<th><span style="color:#F00;"></span>'.$applicant_father_name.'ঃ</th>
			<td>'.$single_applicant['applicant_father_name'].'</td>
		</tr>
		<tr>
			<th><span style="color:#F00;"></span>'.$applicant_date_of_birth.'ঃ</th>
			<td>'.$single_applicant['applicant_date_of_birth'].'</td>
		</tr>
		<tr>
			<th><span style="color:#F00;"></span>'.$national_id_no.'ঃ</th>
			<td>'.$single_applicant['applicant_NID'].'</td>
		</tr>
		<tr>
			<th><span style="color:#F00;"></span>'.$mobile_number.'ঃ</th>
			<td>'.$single_applicant['applicant_mobile'].'</td>
		</tr>
		<tr>
			<th><span style="color:#F00;"></span>'.$village.'ঃ</th>
			<td>'.$single_applicant['applicant_village'].'</td>
		</tr>
		<tr>
			<th><span style="color:#F00;"></span>'.$post_office.'ঃ</th>
			<td>'.$single_applicant['applicant_post_office'].'</td>
		</tr>
		<tr>
			<th><span style="color:#F00;"></span>'.$district.'ঃ</th>
			<td>'.$single_applicant['district_name'].'</td>
		</tr>
		<tr>
			<th><span style="color:#F00;"></span>'.$union.'ঃ</th>
			<td>'.$single_applicant['sub_district_name'].'</td>
		</tr>
		
	</table>';

$html .= '<table width="100%" style="border-collapse: collapse; margin: 0; vertical-align: top; color: #000000">
           <tr>
             <td style="font-size: 15px; padding-bottom: 60px; " align="right"> পরিকল্পনা ও বাস্তবায়নে :'.$title.'</td>
           </tr>
         </table>';

include("mpdf60/mpdf.php");

$mpdf=new mPDF('','A4','10','',20,15,20,15,10,10);  
$mpdf->debug = false;
$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;
$mpdf->autoVietnamese = true;
$footer = array (
	'R' => array (

		'content' => 'My document',

		'font-size' => 10,

		'font-style' => 'B',

		'font-family' => 'serif',

		'color'=>'#000000'

	),

	'line' => 1,

);

//$mpdf->SetFooter($footer);
$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list


$mpdf->DefHTMLFooterByName('Chapter2Footer','Chapter 2 Footer');
$mpdf->WriteHTML($html);
$temp_file_name = 'uploaded/applicants_application_files/'.$single_applicant['applicant_name'].'_'.$single_applicant['applicant_NID'].'_'.$single_applicant['applicant_id'].'.pdf';
unlink($temp_file_name);
$mpdf->Output($temp_file_name,'F');
exit;

?>