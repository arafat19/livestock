<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('app_user_model');
        $this->load->model('main_ui_model');

    }

    function index($lang = '')
    {
        $this->lang->load('content', $lang == '' ? 'bn' : $lang);
        $this->lang->load('number', $lang == '' ? 'bn' : $lang);
        $this->lang->load('form_validation', $lang == '' ? 'bn' : $lang);

        $data['applicant_name'] = $this->lang->line('applicant_name');
        $data['applicant_father_name'] = $this->lang->line('applicant_father_name');
        $data['applicant_mother_name'] = $this->lang->line('applicant_mother_name');
        $data['applicant_village_name'] = $this->lang->line('applicant_village_name');
        $data['applicant_post_office_name'] = $this->lang->line('applicant_post_office_name');
        $data['applicant_gender'] = $this->lang->line('gender');
        $data['male'] = $this->lang->line('male');
        $data['female'] = $this->lang->line('female');
        $data['applicant_type'] = $this->lang->line('applicant_type');
        $data['farmer'] = $this->lang->line('farmer');
        $data['entrepreneur'] = $this->lang->line('entrepreneur');
        $data['farmer_desc'] = $this->lang->line('farmer_desc');

        $data['title'] = $this->lang->line('site_title');
        $data['site_address'] = $this->lang->line('site_address');
        $data['form_top_title'] = $this->lang->line('form_top_title');
        $data['online_application'] = $this->lang->line('online_application');
        $data['one'] = $this->lang->line('one');
        $data['two'] = $this->lang->line('two');
        $data['three'] = $this->lang->line('three');
        $data['four'] = $this->lang->line('four');
        $data['step'] = $this->lang->line('step');
        $data['instructions'] = $this->lang->line('instructions');
        $data['application'] = $this->lang->line('application');
        $data['confirmation'] = $this->lang->line('confirmation');
        $data['submit'] = $this->lang->line('submit');
        $data['rules_for_submit_application_form'] = $this->lang->line('rules_for_submit_application_form');
        $data['rules_of_application_submission'] = $this->lang->line('rules_of_application_submission');
        $data['applicant_date_of_birth'] = $this->lang->line('applicant_date_of_birth');
        $data['application_for_training'] = $this->lang->line('application_for_training');
        $data['to'] = $this->lang->line('to');
        $data['department_head'] = $this->lang->line('department_head');
        $data['department_name'] = $this->lang->line('department_name');
        $data['department_address'] = $this->lang->line('department_address');
        $data['application_subject_cap'] = $this->lang->line('application_subject_cap');
        $data['application_subject_cap_cont'] = $this->lang->line('application_subject_cap_cont');
        $data['form_please_select'] = $this->lang->line('form_please_select');
        $data['sir'] = $this->lang->line('sir');
        $data['application_headline'] = $this->lang->line('application_headline');
        $data['national_id_no'] = $this->lang->line('national_id_no');
        $data['mobile_number'] = $this->lang->line('mobile_number');
        $data['district'] = $this->lang->line('district');
        $data['union'] = $this->lang->line('union');
        $data['village'] = $this->lang->line('village');
        $data['post_office'] = $this->lang->line('post_office');
        $data['application_footer'] = $this->lang->line('application_footer');
        $data['date'] = $this->lang->line('date');
        $data['name'] = $this->lang->line('name');
        $data['respectful'] = $this->lang->line('respectful');
        $data['yours'] = $this->lang->line('yours');
        $data['applicant_signature'] = $this->lang->line('applicant_signature');
        $data['form_validation_required'] = $this->lang->line('form_validation_required');
        $data['form_validation_is_date'] = $this->lang->line('form_validation_is_date');
        $data['form_validation_is_mobile_num'] = $this->lang->line('form_validation_is_mobile_num');
        $data['form_validation_required_village_po'] = $this->lang->line('form_validation_required_village_po');
        $data['form_validation_required_un_dis'] = $this->lang->line('form_validation_required_un_dis');
        $data['info_security'] = $this->lang->line('info_security');
        $data['form_validation_is_summation'] = $this->lang->line('form_validation_is_summation');
        $data['write_info_security'] = $this->lang->line('write_info_security');
        $data['cancel'] = $this->lang->line('cancel');
        $data['application_subject'] = $this->lang->line('application_subject');
        $data['attach_photo'] = $this->lang->line('attach_photo');
        $data['image_size_restrict_text'] = $this->lang->line('image_size_restrict_text');

        $all_courses = $this->app_user_model->get_all_distinct_courses(); // Reading and showing the courses list from DB
        $data['all_courses'] = $all_courses;

        $all_districts = $this->app_user_model->get_all_districts(); // Reading and showing the District list from DB
        $data['all_districts'] = $all_districts;

        $all_sub_districts = $this->app_user_model->get_all_sub_districts(); // Reading and showing the Sub District list from DB
        $data['all_sub_districts'] = $all_sub_districts;

        $digit1 = mt_rand(1, 20);
        $digit2 = mt_rand(1, 20);
        if (mt_rand(0, 1) === 1) {
            $math = "$digit1 + $digit2";
            $answer = $digit1 + $digit2;
        } else {
            $math = "$digit1 - $digit2";
            $answer = $digit1 - $digit2;
        }
        /*$newdata = array(
            'answer' => $answer
        );*/
        $data['math'] = $math;
        $data['answer'] = $answer;
        /*$this->session->set_userdata($newdata);*/


//        $config['encrypt_name'] = TRUE;

        /*$new_name = $_FILES['userfile']['name'];
        $config['file_name'] = $new_name;*/



        $this->load->library('Form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('applicant_name', 'The applicant name', 'trim|required');
        $this->form_validation->set_rules('applicant_father_name', 'Applicant father name', 'trim|required');
        $this->form_validation->set_rules('applicant_date_of_birth', 'Applicant date of birth', 'trim|required');
        $this->form_validation->set_rules('applicant_gender', 'Applicant Gender', 'trim|required');
        $this->form_validation->set_rules('applicant_NID', 'Applicant NID', 'trim|required');
        $this->form_validation->set_rules('applicant_village', 'Applicant Village', 'trim|required');
        $this->form_validation->set_rules('applicant_post_office', 'Applicant Post Office', 'trim|required');
        $this->form_validation->set_rules('applicant_type', 'Applicant Type', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $file_errors = '';
            $this->session->set_flashdata('file_errors', strip_tags($file_errors));
            $this->load->view('home/header', $data);
            $this->load->view('home/body', $data);
            $this->load->view('home/footer', $data);
            return false;
        }

        $this->lang->load('content', $lang == '' ? 'bn' : $lang);
        $form_submition_success = $this->lang->line('form_submition_success');
        $form_submition_failure = $this->lang->line('form_submition_failure');
        $form_submition_failure_nid = $this->lang->line('form_submition_failure_nid');
        $math_answer_is_wrong = $this->lang->line('math_answer_is_wrong');

        $applicant_sum = $this->input->post('applicant_sum');
        $math_answer = $this->input->post('math_answer');
        if ($applicant_sum != $math_answer) {
            $this->session->set_flashdata('applicant_sum_wrong', $math_answer_is_wrong);
            $this->load->view('home/header', $data);
            $this->load->view('home/body', $data);
            $this->load->view('home/footer', $data);
            return false;
        } else {
            $applicant_NID = $this->input->post('applicant_NID');
            $applicant_course_id = $this->input->post('applicant_subject_id');

            $course_details = $this->app_user_model->get_single_course_by_id($applicant_course_id);
            $course_end_date = $course_details['course_end_date'];
            $today = date("d-m-Y");

            $is_exist = $this->main_ui_model->check_existence_of_nid($applicant_NID);
            if ($is_exist > 0) {
                if ($today > $course_end_date) {
                    $do_create = 1;
                } else {
                    $do_create = 0;
                }
            } else {
                $do_create = 1;
            }
            $path = './uploaded/applicants_photo';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 300;
            /*$config['max_width'] = 114;
            $config['max_height'] = 142;*/
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('userFile')) {
                $fileData = $this->upload->data();
               /* $data = array(
                    'applicant_photo' => $fileData['file_name'],
                    'applicant_name' => $this->input->post('applicant_name'),
                    'applicant_father_name' => $this->input->post('applicant_father_name'),
                    'applicant_date_of_birth' => $this->input->post('applicant_date_of_birth'),
                    'applicant_gender' => $this->input->post('applicant_gender'),
                    'applicant_NID' => $this->input->post('applicant_NID'),
                    'applicant_mobile' => $this->input->post('applicant_mobile'),
                    'applicant_village' => $this->input->post('applicant_village'),
                    'applicant_post_office' => $this->input->post('applicant_post_office'),
                    'applicant_subdistrict_id' => $this->input->post('applicant_subdistrict_id'),
                    'applicant_district_id' => $this->input->post('applicant_district_id'),
                    'applicant_course_id' => $this->input->post('applicant_subject_id'),
                    'application_date' => date("Y-m-d")
                );*/
                $uploadData['applicant_photo'] = $fileData['file_name'];
                $uploadData['applicant_name'] = $this->input->post('applicant_name');
                $uploadData['applicant_father_name'] = $this->input->post('applicant_father_name');
                $uploadData['applicant_date_of_birth'] = $this->input->post('applicant_date_of_birth');
                $uploadData['applicant_gender'] = $this->input->post('applicant_gender');
                $uploadData['applicant_NID'] = $this->input->post('applicant_NID');
                $uploadData['applicant_mobile'] = $this->input->post('applicant_mobile');
                $uploadData['applicant_village'] = $this->input->post('applicant_village');
                $uploadData['applicant_post_office'] = $this->input->post('applicant_post_office');
                $uploadData['applicant_subdistrict_id'] = $this->input->post('applicant_subdistrict_id');
                $uploadData['applicant_district_id'] = $this->input->post('applicant_district_id');
                $uploadData['applicant_course_id'] = $this->input->post('applicant_subject_id');
                $uploadData['applicant_type'] = $this->input->post('applicant_type');
                $uploadData['farmer_desc'] = ($this->input->post('farmer_desc') != '') ? $this->input->post('farmer_desc') : '';
                $uploadData['application_date'] = date("Y-m-d");
            } else {
                $file_errors = $this->upload->display_errors();
                $this->session->set_flashdata('file_errors', strip_tags($file_errors));
            }
            //var_dump($uploadData);
            if ($do_create) {
                if (!empty($uploadData)) {
                    $is_created = $this->main_ui_model->add_application($uploadData);
                    if ($is_created) {
                        $applicant_name = $this->input->post('applicant_name');
                        $applicant_father_name = $this->input->post('applicant_father_name');
                        $applicant_mobile = $this->input->post('applicant_mobile');
                        $applicant_date_of_birth = $this->input->post('applicant_date_of_birth');
                        $applicant_NID = $this->input->post('applicant_NID');

                        $single_applicant = $this->main_ui_model->get_applicant_by_phone_name_father_dob_nid($applicant_mobile, $applicant_name, $applicant_father_name, $applicant_date_of_birth, $applicant_NID);
                        $applicant_id = base64_encode($single_applicant['applicant_id']);
                        redirect(base_url() . 'home/confirm/application/' . $applicant_id, 'refresh');
                        //$this->session->set_flashdata('applicant_create_success_message', $form_submition_success);
                    } else {
                        $this->session->set_flashdata('applicant_create_failure_message', $form_submition_failure);
                    }
                } else {
                    $this->session->set_flashdata('applicant_create_failure_message', $form_submition_failure);
                }
            } else {
                $this->session->set_flashdata('applicant_create_failure_message', $form_submition_failure_nid);
            }

        }
        redirect(base_url() . 'home', 'refresh');

    }

    function edit_applicant_data($applicant_id)
    {
        $applicant_id_dec = base64_decode($applicant_id);
        $lang = '';
        $this->lang->load('content', $lang == '' ? 'bn' : $lang);
        $this->lang->load('number', $lang == '' ? 'bn' : $lang);
        $this->lang->load('form_validation', $lang == '' ? 'bn' : $lang);

        $data['applicant_name'] = $this->lang->line('applicant_name');
        $data['applicant_father_name'] = $this->lang->line('applicant_father_name');
        $data['applicant_mother_name'] = $this->lang->line('applicant_mother_name');
        $data['applicant_village_name'] = $this->lang->line('applicant_village_name');
        $data['applicant_post_office_name'] = $this->lang->line('applicant_post_office_name');
        $data['applicant_gender'] = $this->lang->line('gender');
        $data['male'] = $this->lang->line('male');
        $data['female'] = $this->lang->line('female');
        $data['applicant_type'] = $this->lang->line('applicant_type');
        $data['farmer'] = $this->lang->line('farmer');
        $data['entrepreneur'] = $this->lang->line('entrepreneur');
        $data['farmer_desc'] = $this->lang->line('farmer_desc');

        $data['title'] = $this->lang->line('site_title');
        $data['site_address'] = $this->lang->line('site_address');
        $data['form_top_title'] = $this->lang->line('form_top_title');
        $data['online_application'] = $this->lang->line('online_application');
        $data['one'] = $this->lang->line('one');
        $data['two'] = $this->lang->line('two');
        $data['three'] = $this->lang->line('three');
        $data['four'] = $this->lang->line('four');
        $data['step'] = $this->lang->line('step');
        $data['instructions'] = $this->lang->line('instructions');
        $data['application'] = $this->lang->line('application');
        $data['confirmation'] = $this->lang->line('confirmation');
        $data['submit'] = $this->lang->line('submit');
        $data['rules_for_submit_application_form'] = $this->lang->line('rules_for_submit_application_form');
        $data['rules_of_application_submission'] = $this->lang->line('rules_of_application_submission');
        $data['applicant_date_of_birth'] = $this->lang->line('applicant_date_of_birth');
        $data['application_for_training'] = $this->lang->line('application_for_training');
        $data['to'] = $this->lang->line('to');
        $data['department_head'] = $this->lang->line('department_head');
        $data['department_name'] = $this->lang->line('department_name');
        $data['department_address'] = $this->lang->line('department_address');
        $data['application_subject_cap'] = $this->lang->line('application_subject_cap');
        $data['application_subject_cap_cont'] = $this->lang->line('application_subject_cap_cont');
        $data['form_please_select'] = $this->lang->line('form_please_select');
        $data['sir'] = $this->lang->line('sir');
        $data['application_headline'] = $this->lang->line('application_headline');
        $data['national_id_no'] = $this->lang->line('national_id_no');
        $data['mobile_number'] = $this->lang->line('mobile_number');
        $data['district'] = $this->lang->line('district');
        $data['union'] = $this->lang->line('union');
        $data['village'] = $this->lang->line('village');
        $data['post_office'] = $this->lang->line('post_office');
        $data['application_footer'] = $this->lang->line('application_footer');
        $data['date'] = $this->lang->line('date');
        $data['name'] = $this->lang->line('name');
        $data['respectful'] = $this->lang->line('respectful');
        $data['yours'] = $this->lang->line('yours');
        $data['applicant_signature'] = $this->lang->line('applicant_signature');
        $data['form_validation_required'] = $this->lang->line('form_validation_required');
        $data['form_validation_is_date'] = $this->lang->line('form_validation_is_date');
        $data['form_validation_is_mobile_num'] = $this->lang->line('form_validation_is_mobile_num');
        $data['form_validation_required_village_po'] = $this->lang->line('form_validation_required_village_po');
        $data['form_validation_required_un_dis'] = $this->lang->line('form_validation_required_un_dis');
        $data['info_security'] = $this->lang->line('info_security');
        $data['form_validation_is_summation'] = $this->lang->line('form_validation_is_summation');
        $data['write_info_security'] = $this->lang->line('write_info_security');
        $data['cancel'] = $this->lang->line('cancel');
        $data['application_subject'] = $this->lang->line('application_subject');
        $data['attach_photo'] = $this->lang->line('attach_photo');
        $data['image_size_restrict_text'] = $this->lang->line('image_size_restrict_text');

        $all_courses = $this->app_user_model->get_all_distinct_courses(); // Reading and showing the courses list from DB
        $data['all_courses'] = $all_courses;

        $all_districts = $this->app_user_model->get_all_districts(); // Reading and showing the District list from DB
        $data['all_districts'] = $all_districts;

        $all_sub_districts = $this->app_user_model->get_all_sub_districts(); // Reading and showing the Sub District list from DB
        $data['all_sub_districts'] = $all_sub_districts;

        $single_applicant = $this->main_ui_model->get_applicant_by_id($applicant_id_dec);
        $data['single_applicant'] = $single_applicant;

        $digit1 = mt_rand(1, 20);
        $digit2 = mt_rand(1, 20);
        if (mt_rand(0, 1) === 1) {
            $math = "$digit1 + $digit2";
            $answer = $digit1 + $digit2;
        } else {
            $math = "$digit1 - $digit2";
            $answer = $digit1 - $digit2;
        }
        /*$newdata = array(
            'answer' => $answer
        );*/
        $data['math'] = $math;
        $data['answer'] = $answer;
        /*$this->session->set_userdata($newdata);*/

        $config['upload_path'] = './uploaded/applicants_photo';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['overwrite'] = TRUE;
        $config['max_size'] = 300;
        $config['max_width'] = 114;
        $config['max_height'] = 142;

//        $config['encrypt_name'] = TRUE;
        /*$new_name = time().$_FILES['userfile']['name'];
        $config['file_name'] = $new_name;*/

        $this->load->library('upload', $config);


        $this->load->library('Form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('applicant_name', 'The applicant name', 'trim|required');
        $this->form_validation->set_rules('applicant_father_name', 'Applicant father name', 'trim|required');
        $this->form_validation->set_rules('applicant_date_of_birth', 'Applicant date of birth', 'trim|required');
        $this->form_validation->set_rules('applicant_gender', 'Applicant Gender', 'trim|required');
        $this->form_validation->set_rules('applicant_NID', 'Applicant NID', 'trim|required');
        $this->form_validation->set_rules('applicant_village', 'Applicant Village', 'trim|required');
        $this->form_validation->set_rules('applicant_post_office', 'Applicant Post Office', 'trim|required');
        $this->form_validation->set_rules('applicant_type', 'Applicant Type', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $file_errors = '';
            $this->session->set_flashdata('file_errors', strip_tags($file_errors));
            $this->load->view('home/header', $data);
            $this->load->view('home/edit_body', $data);
            $this->load->view('home/footer', $data);
            return false;
        }
        if ($single_applicant['applicant_photo'] == '') {
            if (!$this->upload->do_upload()) {
                $file_errors = $this->upload->display_errors();
                $this->session->set_flashdata('file_errors', strip_tags($file_errors));
                $this->load->view('home/header', $data);
                $this->load->view('home/edit_body', $data);
                $this->load->view('home/footer', $data);
                return false;
            }
        } else {
            $db_data = array(
                'applicant_name' => $this->input->post('applicant_name'),
                'applicant_father_name' => $this->input->post('applicant_father_name'),
                'applicant_date_of_birth' => $this->input->post('applicant_date_of_birth'),
                'applicant_gender' => $this->input->post('applicant_gender'),
                'applicant_NID' => $this->input->post('applicant_NID'),
                'applicant_mobile' => $this->input->post('applicant_mobile'),
                'applicant_village' => $this->input->post('applicant_village'),
                'applicant_post_office' => $this->input->post('applicant_post_office'),
                'applicant_subdistrict_id' => $this->input->post('applicant_subdistrict_id'),
                'applicant_district_id' => $this->input->post('applicant_district_id'),
                'applicant_course_id' => $this->input->post('applicant_subject_id'),
                'applicant_type' => $this->input->post('applicant_type'),
//                'applicant_photo' => $this->upload->data('file_name'),
                'applicant_photo' => ($single_applicant['applicant_photo'] != '') ? $single_applicant['applicant_photo'] : $this->upload->data('file_name'),
                'farmer_desc' => ($this->input->post('farmer_desc') != '') ? $this->input->post('farmer_desc') : '',

                'application_date' => date("Y-m-d")
            );

            $this->lang->load('content', $lang == '' ? 'bn' : $lang);
            $form_submition_success = $this->lang->line('form_submition_success');
            $form_submition_failure = $this->lang->line('form_submition_failure');
            $math_answer_is_wrong = $this->lang->line('math_answer_is_wrong');

            $applicant_sum = $this->input->post('applicant_sum');
            $math_answer = $this->input->post('math_answer');
            if ($applicant_sum != $math_answer) {
                $this->session->set_flashdata('applicant_sum_wrong', $math_answer_is_wrong);
                $this->load->view('home/header', $data);
                $this->load->view('home/edit_body', $data);
                $this->load->view('home/footer', $data);
                return false;
            } else {
                $is_updated = $this->main_ui_model->update_applicant_info($db_data, $applicant_id_dec);
                if ($is_updated) {
                    $applicant_name = $this->input->post('applicant_name');
                    $applicant_father_name = $this->input->post('applicant_father_name');
                    $applicant_mobile = $this->input->post('applicant_mobile');
                    $applicant_date_of_birth = $this->input->post('applicant_date_of_birth');

                    /*$single_applicant = $this->main_ui_model->get_applicant_by_phone_name_father_dob($applicant_mobile, $applicant_name, $applicant_father_name, $applicant_date_of_birth);
                    $new_applicant_id = base64_encode($single_applicant['applicant_id']);*/
                    redirect(base_url() . 'home/confirm/application/' . $applicant_id, 'refresh');
                    //$this->session->set_flashdata('applicant_create_success_message', $form_submition_success);
                } else {
                    $this->session->set_flashdata('applicant_create_failure_message', $form_submition_failure);
                }
            }
            redirect(base_url() . 'home', 'refresh');
        }
    }

    public function confirm_applicant_submission($applicant_id)
    {
        error_reporting(0);
        $applicant_id_dec = base64_decode($applicant_id);
        $lang = '';
        $this->lang->load('content', $lang == '' ? 'bn' : $lang);
        $this->lang->load('number', $lang == '' ? 'bn' : $lang);
        $this->lang->load('form_validation', $lang == '' ? 'bn' : $lang);

        $data['applicant_name'] = $this->lang->line('applicant_name');
        $data['applicant_father_name'] = $this->lang->line('applicant_father_name');
        $data['applicant_mother_name'] = $this->lang->line('applicant_mother_name');
        $data['applicant_village_name'] = $this->lang->line('applicant_village_name');
        $data['applicant_post_office_name'] = $this->lang->line('applicant_post_office_name');
        $data['applicant_gender'] = $this->lang->line('gender');
        $data['male'] = $this->lang->line('male');
        $data['female'] = $this->lang->line('female');
        $data['applicant_type'] = $this->lang->line('applicant_type');
        $data['farmer'] = $this->lang->line('farmer');
        $data['entrepreneur'] = $this->lang->line('entrepreneur');
        $data['farmer_desc'] = $this->lang->line('farmer_desc');

        $data['title'] = $this->lang->line('site_title');
        $data['site_address'] = $this->lang->line('site_address');
        $data['form_top_title'] = $this->lang->line('form_top_title');
        $data['online_application'] = $this->lang->line('online_application');
        $data['one'] = $this->lang->line('one');
        $data['two'] = $this->lang->line('two');
        $data['three'] = $this->lang->line('three');
        $data['four'] = $this->lang->line('four');
        $data['step'] = $this->lang->line('step');
        $data['instructions'] = $this->lang->line('instructions');
        $data['application'] = $this->lang->line('application');
        $data['confirmation'] = $this->lang->line('confirmation');
        $data['submit'] = $this->lang->line('submit');
        $data['rules_for_submit_application_form'] = $this->lang->line('rules_for_submit_application_form');
        $data['rules_of_application_submission'] = $this->lang->line('rules_of_application_submission');
        $data['applicant_date_of_birth'] = $this->lang->line('applicant_date_of_birth');
        $data['application_for_training'] = $this->lang->line('application_for_training');
        $data['to'] = $this->lang->line('to');
        $data['department_head'] = $this->lang->line('department_head');
        $data['department_name'] = $this->lang->line('department_name');
        $data['department_address'] = $this->lang->line('department_address');
        $data['application_subject_cap'] = $this->lang->line('application_subject_cap');
        $data['application_subject_cap_cont'] = $this->lang->line('application_subject_cap_cont');
        $data['form_please_select'] = $this->lang->line('form_please_select');
        $data['sir'] = $this->lang->line('sir');
        $data['application_headline'] = $this->lang->line('application_headline');
        $data['national_id_no'] = $this->lang->line('national_id_no');
        $data['mobile_number'] = $this->lang->line('mobile_number');
        $data['district'] = $this->lang->line('district');
        $data['union'] = $this->lang->line('union');
        $data['village'] = $this->lang->line('village');
        $data['post_office'] = $this->lang->line('post_office');
        $data['application_footer'] = $this->lang->line('application_footer');
        $data['date'] = $this->lang->line('date');
        $data['name'] = $this->lang->line('name');
        $data['respectful'] = $this->lang->line('respectful');
        $data['yours'] = $this->lang->line('yours');
        $data['applicant_signature'] = $this->lang->line('applicant_signature');
        $data['form_validation_required'] = $this->lang->line('form_validation_required');
        $data['form_validation_is_date'] = $this->lang->line('form_validation_is_date');
        $data['form_validation_is_mobile_num'] = $this->lang->line('form_validation_is_mobile_num');
        $data['form_validation_required_village_po'] = $this->lang->line('form_validation_required_village_po');
        $data['form_validation_required_un_dis'] = $this->lang->line('form_validation_required_un_dis');
        $data['info_security'] = $this->lang->line('info_security');
        $data['form_validation_is_summation'] = $this->lang->line('form_validation_is_summation');
        $data['write_info_security'] = $this->lang->line('write_info_security');
        $data['cancel'] = $this->lang->line('cancel');
        $data['application_subject'] = $this->lang->line('application_subject');
        $data['your_photo'] = $this->lang->line('your_photo');
        $data['edit'] = $this->lang->line('edit');
        $form_submition_success = $this->lang->line('form_submition_success');

        $single_applicant = $this->main_ui_model->get_applicant_by_id($applicant_id_dec);

        $data['single_applicant'] = $single_applicant;
        $db_data = array(
            'finally_submitted' => 1,
        );
        $this->session->set_flashdata('applicant_create_success_message', '');
        if (isset($_POST['confirm_submit'])) {
            $is_confirmed = $this->main_ui_model->add_application_confirmation($db_data, $applicant_id_dec);
            if ($is_confirmed) {
                $this->session->set_flashdata('applicant_create_success_message', $form_submition_success); ?>
                <meta http-equiv="refresh" content="4; url=<?php echo base_url(); ?>">
                <?php
            }
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
<title>'.$data['title'].'</title>
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
        $applicant_image = $single_applicant['applicant_photo'] ? $single_applicant['applicant_photo'] : 'pdfdimga.png';
        $image_url = $baseUrl.'uploaded/applicants_photo/'.$applicant_image;
        if($single_applicant['applicant_gender'] == 'Male'){ $applicant_gender = $data['male']; } else{$applicant_gender = $data['female'];}
        if($single_applicant['applicant_type'] == 'Farmer'){ $applicant_type = $data['farmer']; } else{$applicant_type = $data['entrepreneur'];}
        $html .='<table width="100%">
	<tr>
		<td><img src="'.$baseUrl.'images/pdfHeader.png" style="width: 210mm; height: 297mm; margin: 0;" ></td>
	</tr>
	</table>

	<p style="text-align:center;">'.$data['application_for_training'].'</p>
	<hr>';
        $html .=
            '<table width="90%" style="margin-left:10%" height="80%">
		<tr>
			<th width=350px><span style="color:#000;"></span>'.$data['application_subject'].'ঃ</th>
			<td><b>'.$single_applicant['course_name'].'</b></td>
			<td colspan="8"><img src="'.$image_url.'" style="width: 15mm; height: 20mm; margin: 0;" ></td>
		</tr>
		<tr>
			<th width=350px><span style="color:#000;"></span>'.$data['applicant_name'].'ঃ</th>
			<td><b>'.$single_applicant['applicant_name'].'</b></td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['applicant_father_name'].'ঃ</th>
			<td>'.$single_applicant['applicant_father_name'].'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['applicant_date_of_birth'].'ঃ</th>
			<td>'.$single_applicant['applicant_date_of_birth'].'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['applicant_gender'].'ঃ</th>
			<td>'.$applicant_gender.'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['applicant_type'].'ঃ</th>
			<td>'.$applicant_type.'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['national_id_no'].'ঃ</th>
			<td>'.$single_applicant['applicant_NID'].'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['mobile_number'].'ঃ</th>
			<td>'.$single_applicant['applicant_mobile'].'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['village'].'ঃ</th>
			<td>'.$single_applicant['applicant_village'].'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['post_office'].'ঃ</th>
			<td>'.$single_applicant['applicant_post_office'].'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['district'].'ঃ</th>
			<td>'.$single_applicant['district_name'].'</td>
		</tr>
		<tr>
			<th><span style="color:#000;"></span>'.$data['union'].'ঃ</th>
			<td>'.$single_applicant['sub_district_name'].'</td>
		</tr>

	</table>';


        /*ini_set('memory_limit','32M'); // boost the memory limit if it's low ;)
        $this->load->library('pdf');

        $pdf = $this->pdf->load();*/
        include("mpdf60/mpdf.php");

        $mpdf=new mPDF('','A4','10','',20,15,20,15,10,10);
        $mpdf->debug = false;
        $mpdf->autoScriptToLang = true;
        $mpdf->baseScript = 1;
        $mpdf->autoVietnamese = true;

        $mpdf->SetDisplayMode('fullpage');

        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list


        $mpdf->SetFooter('পরিকল্পনা ও বাস্তবায়নে: বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট'.'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure ;)
        $mpdf->AddPage();
        $mpdf->WriteHTML($html);
        $temp_file_name = 'downloads/reports/blri_applicant_'.$single_applicant['applicant_NID'].'_'.$single_applicant['applicant_id'].'.pdf';
        //unlink($temp_file_name);
        $mpdf->Output($temp_file_name,'F');
        $data['applicant_application_form_url'] = $temp_file_name;
        $this->load->view('home/header', $data);
        $this->load->view('home/confirm_body', $data);
        $this->load->view('home/confirm_footer', $data);
    }

    public function make_pdf($applicant_id)
    {
        $applicant_id_dec = base64_decode($applicant_id);
        $single_applicant = $this->main_ui_model->get_applicant_by_id($applicant_id_dec);
        $lang = '';
        $this->lang->load('content', $lang == '' ? 'bn' : $lang);
        $this->lang->load('number', $lang == '' ? 'bn' : $lang);
        $this->lang->load('form_validation', $lang == '' ? 'bn' : $lang);

        $data['applicant_name'] = $this->lang->line('applicant_name');
        $data['applicant_father_name'] = $this->lang->line('applicant_father_name');
        $data['applicant_mother_name'] = $this->lang->line('applicant_mother_name');
        $data['applicant_village_name'] = $this->lang->line('applicant_village_name');
        $data['applicant_post_office_name'] = $this->lang->line('applicant_post_office_name');
        $data['title'] = $this->lang->line('site_title');
        $data['site_address'] = $this->lang->line('site_address');
        $data['form_top_title'] = $this->lang->line('form_top_title');
        $data['online_application'] = $this->lang->line('online_application');
        $data['one'] = $this->lang->line('one');
        $data['two'] = $this->lang->line('two');
        $data['three'] = $this->lang->line('three');
        $data['four'] = $this->lang->line('four');
        $data['step'] = $this->lang->line('step');
        $data['instructions'] = $this->lang->line('instructions');
        $data['application'] = $this->lang->line('application');
        $data['confirmation'] = $this->lang->line('confirmation');
        $data['submit'] = $this->lang->line('submit');
        $data['rules_for_submit_application_form'] = $this->lang->line('rules_for_submit_application_form');
        $data['rules_of_application_submission'] = $this->lang->line('rules_of_application_submission');
        $data['applicant_date_of_birth'] = $this->lang->line('applicant_date_of_birth');
        $data['application_for_training'] = $this->lang->line('application_for_training');
        $data['to'] = $this->lang->line('to');
        $data['department_head'] = $this->lang->line('department_head');
        $data['department_name'] = $this->lang->line('department_name');
        $data['department_address'] = $this->lang->line('department_address');
        $data['application_subject_cap'] = $this->lang->line('application_subject_cap');
        $data['application_subject_cap_cont'] = $this->lang->line('application_subject_cap_cont');
        $data['form_please_select'] = $this->lang->line('form_please_select');
        $data['sir'] = $this->lang->line('sir');
        $data['application_headline'] = $this->lang->line('application_headline');
        $data['national_id_no'] = $this->lang->line('national_id_no');
        $data['mobile_number'] = $this->lang->line('mobile_number');
        $data['district'] = $this->lang->line('district');
        $data['union'] = $this->lang->line('union');
        $data['village'] = $this->lang->line('village');
        $data['post_office'] = $this->lang->line('post_office');
        $data['application_footer'] = $this->lang->line('application_footer');
        $data['date'] = $this->lang->line('date');
        $data['name'] = $this->lang->line('name');
        $data['respectful'] = $this->lang->line('respectful');
        $data['yours'] = $this->lang->line('yours');
        $data['applicant_signature'] = $this->lang->line('applicant_signature');
        $data['form_validation_required'] = $this->lang->line('form_validation_required');
        $data['form_validation_is_date'] = $this->lang->line('form_validation_is_date');
        $data['form_validation_is_mobile_num'] = $this->lang->line('form_validation_is_mobile_num');
        $data['form_validation_required_village_po'] = $this->lang->line('form_validation_required_village_po');
        $data['form_validation_required_un_dis'] = $this->lang->line('form_validation_required_un_dis');
        $data['info_security'] = $this->lang->line('info_security');
        $data['form_validation_is_summation'] = $this->lang->line('form_validation_is_summation');
        $data['write_info_security'] = $this->lang->line('write_info_security');
        $data['cancel'] = $this->lang->line('cancel');
        $data['application_subject'] = $this->lang->line('application_subject');
        $data['your_photo'] = $this->lang->line('your_photo');
        $data['edit'] = $this->lang->line('edit');
        $data['single_applicant'] = $single_applicant;
        $this->load->view('print_pdf', $data);
    }

    public function show_applicant_sub_district($lang = '')
    {
        $this->lang->load('content', $lang == '' ? 'bn' : $lang);
        $this->lang->load('number', $lang == '' ? 'bn' : $lang);
        $this->lang->load('form_validation', $lang == '' ? 'bn' : $lang);
        $districtId = $_POST['districtId'];
        echo "<option value=''>" . $this->lang->line('union') . ' ' . $this->lang->line('form_please_select') . "</option>";
        $all_sub_districts = $this->app_user_model->get_sub_district_by_district_id($districtId);
        if (isset($all_sub_districts) && $all_sub_districts->num_rows() > 0):
            foreach ($all_sub_districts->result() as $row): ?>
                <option
                    value="<?php echo $row->sub_district_id ?>"><?php echo $row->sub_district_name; ?></option>
                <?php
            endforeach;
        endif;
    }

    public function submit_application($lang = '')
    {
        $config['upload_path'] = './uploaded/applicants_photo';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['overwrite'] = TRUE;
        $config['max_size'] = 300;

        $this->load->library('upload', $config);
        $this->load->library('Form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('applicant_name', 'The applicant name', 'trim|required');
        $this->form_validation->set_rules('applicant_father_name', 'Applicant father name', 'trim|required');
        $this->form_validation->set_rules('applicant_date_of_birth', 'Applicant date of birth', 'trim|required');
        $this->form_validation->set_rules('applicant_gender', 'Applicant Gender', 'trim|required');
        $this->form_validation->set_rules('applicant_NID', 'Applicant NID', 'trim|required');
        $this->form_validation->set_rules('applicant_village', 'Applicant Village', 'trim|required');
        $this->form_validation->set_rules('applicant_post_office', 'Applicant Post Office', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $file_errors = '';
            $this->session->set_flashdata('file_errors', strip_tags($file_errors));
        }
        if (!$this->upload->do_upload()) {
            $file_errors = $this->upload->display_errors();
            $this->session->set_flashdata('file_errors', strip_tags($file_errors));
        } else {
            $data = array(
                'applicant_name' => $this->input->post('applicant_name'),
                'applicant_father_name' => $this->input->post('applicant_father_name'),
                'applicant_date_of_birth' => $this->input->post('applicant_date_of_birth'),
                'applicant_gender' => $this->input->post('applicant_gender'),
                'applicant_NID' => $this->input->post('applicant_NID'),
                'applicant_mobile' => $this->input->post('applicant_mobile'),
                'applicant_village' => $this->input->post('applicant_village'),
                'applicant_post_office' => $this->input->post('applicant_post_office'),
                'applicant_subdistrict_id' => $this->input->post('applicant_subdistrict_id'),
                'applicant_district_id' => $this->input->post('applicant_district_id'),
                'applicant_course_id' => $this->input->post('applicant_subject_id'),
                'applicant_photo' => $this->upload->data('file_name'),
            );

            $this->lang->load('content', $lang == '' ? 'bn' : $lang);
            $form_submition_success = $this->lang->line('form_submition_success');
            $form_submition_failure = $this->lang->line('form_submition_failure');
            $math_answer_is_wrong = $this->lang->line('math_answer_is_wrong');

            $applicant_sum = $this->input->post('applicant_sum');
            if ($applicant_sum != '' && $applicant_sum != $this->session->userdata('answer')) {
                $this->session->set_flashdata('applicant_sum_wrong', $math_answer_is_wrong);
            } else {
                $is_created = $this->main_ui_model->add_application($data);
                if ($is_created) {
                    $this->session->set_flashdata('applicant_create_success_message', $form_submition_success);
                } else {
                    $this->session->set_flashdata('applicant_create_failure_message', $form_submition_failure);
                }
            }
        }
        redirect(base_url(), 'refresh');

    }

    public function remove_session_data()
    {
        $session_data = array(
            'applicant_name' => '',
            'applicant_father_name' => '',
            'applicant_date_of_birth' => '',
            'applicant_NID' => '',
            'applicant_mobile' => '',
            'applicant_village' => '',
            'applicant_post_office' => '',
            'applicant_subdistrict_id' => '',
            'applicant_district_id' => '',
            'answer' => ''
        );
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
    }

}

