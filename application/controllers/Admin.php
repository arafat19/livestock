<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 4/26/16
 * Time: 4:05 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public static $title = 'Admin LogIn - BLRI Training Application Management';
    public static $wrong_title = 'Wrong Email or Password - BLRI Training Application Management';
    public static $wrong_login_message = 'Wrong Email or Password';
    public static $login_title = 'Sign in to continue to BLRI Training Application Management';
    public static $footer_title = 'বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট';

    function __construct()
    {
        parent::__construct();
        $this->load->model('app_user_model');
    }

    function index()
    {
        if (($this->session->userdata('blri_admin_username') != "")) {
            $this->welcome_admin_dashboard();
        } else {
            $this->load->library('Form_validation');
            // field name, error message, validation rules

            $this->form_validation->set_rules('email', 'This Email', 'trim|required|valid_email|callback_not_found_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');

            if ($this->form_validation->run() == FALSE) {
                $data['title']       = Admin::$title;
                $data['login_title'] = Admin::$login_title;
                $this->load->view('admin/header_view', $data);
                $this->load->view('admin/admin_login_index_view', $data);
                $this->load->view('admin/footer_view', $data);
            } else {
                $email    = $this->input->post('email');
                $password = md5($this->input->post('password'));

                $result = $this->app_user_model->login($email, $password);
                //echo $result;
                if ($result) {
                    $this->welcome_admin_dashboard();
                } else {
                    $data['title'] = Admin::$wrong_title;
                    $this->session->set_flashdata('wrong_login_message', Admin::$wrong_login_message);
                    redirect(base_url() . 'admin/index', 'refresh');
                }
            }

        }
    }

    public function welcome_admin_dashboard()
    {
        $data['title']           = 'Welcome BLRI Admin Panel';
        $data['navbar_title']    = 'BLRI Admin Panel';
        $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
        $data['active']          = 'dashboard';
        $data['footer_title']    = Admin::$footer_title;
        $this->load->view('admin/admin_dashboard_header_view', $data);
        $this->load->view('admin/admin_dashboard_view', $data);
        $this->load->view('admin/admin_dashboard_footer_view', $data);
    }

    public function registration()
    {
        $this->load->library('Form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('email', 'This Email', 'trim|required|valid_email|callback_unique_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('nid', 'Your NID', 'trim');
        $this->form_validation->set_rules('cell_number', 'Your Mobile Number', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Admin Registration- BLRI Training Application Management';
            $this->load->view('admin/header_view', $data);
            $this->load->view('admin/app_user_registration_view', $data);
            $this->load->view('admin/footer_view', $data);
        } else {
            $this->app_user_model->add_user();
            $this->session->set_flashdata('admin_regis_comp_message', "Your registration is successfully completed.");
            redirect(base_url() . 'admin/register', 'refresh');

        }
    }

    public function admin_create_district()
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('district_name', 'This district', 'trim|required|min_length[2]');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Create District - BLRI Training Application Management';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Create District';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['data_list_title'] = 'All Districts List';
                $data['footer_title']    = Admin::$footer_title;

                $all_districts         = $this->app_user_model->get_all_districts(); // Reading and showing the District list from DB
                $data['all_districts'] = $all_districts;

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_create_district_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            } else {
                $is_created = $this->app_user_model->create_district();
                if ($is_created) {
                    $this->session->set_flashdata('admin_create_district_message', "District is created successfully.");
                } else {
                    $this->session->set_flashdata('admin_create_district_error_message', "District is not created successfully. Please try again.");
                }
                redirect(base_url() . 'admin/district/create', 'refresh');
            }
        }
    }

    public function admin_create_sub_district()
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('district_id', 'This district', 'trim|required');
            $this->form_validation->set_rules('sub_district_name', 'This sub-district', 'trim|required|min_length[2]');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Create Sub-district - BLRI Training Application Management';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Create Sub-district';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['data_list_title'] = 'All Sub-districts List';
                $data['footer_title']    = Admin::$footer_title;

                $all_districts         = $this->app_user_model->get_all_districts(); // Reading and showing the District list from DB
                $data['all_districts'] = $all_districts;

                $all_sub_districts         = $this->app_user_model->get_all_sub_districts_with_district(); // Reading and showing the Sub District list from DB
                $data['all_sub_districts'] = $all_sub_districts;

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_create_sub_district_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            } else {
                $is_created = $this->app_user_model->create_sub_district();
                if ($is_created) {
                    $this->session->set_flashdata('admin_create_sub_district_message', "Sub district is created successfully.");
                } else {
                    $this->session->set_flashdata('admin_create_sub_district_error_message', "Sub district is not created successfully. Please try again.");
                }
                redirect(base_url() . 'admin/sub/district/create', 'refresh');
            }
        }
    }


    public function admin_create_course()
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('course_name', 'This course name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('course_description', 'Course description', 'trim');
            $this->form_validation->set_rules('course_type', 'Selected Course Type', 'trim|required');
            $this->form_validation->set_rules('course_start_date', 'Course start date', 'trim|required');
            $this->form_validation->set_rules('course_end_date', 'Course end date', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'BLRI Course List - BLRI Training Application Management System';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Create Course';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['data_list_title'] = 'All Courses List';
                $data['footer_title']    = Admin::$footer_title;

                $all_courses         = $this->app_user_model->get_all_courses(); // Reading and showing the courses list from DB
                $data['all_courses'] = $all_courses;

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_create_course_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            } else {
                $start_date = date_create($this->input->post('course_start_date'));
                $end_date   = date_create($this->input->post('course_end_date'));
                if ($end_date < $start_date) {
                    $this->session->set_flashdata('course_date_selection_error', "End Date never be smaller than the Start Date.");
                } else {
                    $data       = array(
                        'course_name'        => $this->input->post('course_name'),
                        'course_venue'       => $this->input->post('course_venue'),
                        'course_description' => $this->input->post('course_description'),
                        'course_type'        => $this->input->post('course_type'),
                        'course_start_date'  => $this->input->post('course_start_date'),
                        'course_end_date'    => $this->input->post('course_end_date'),
                    );
                    $is_created = $this->app_user_model->create_course($data);
                    if ($is_created) {
                        $this->session->set_flashdata('admin_create_course_message', "Course is created successfully.");
                    } else {
                        $this->session->set_flashdata('admin_create_course_error_message', "Course is not created successfully. Please try again.");
                    }
                }
                redirect(base_url() . 'admin/course/create', 'refresh');
            }
        }
    }

    public function admin_create_instructor()
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $config['upload_path']   = './uploaded/instructors_photo';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite']     = TRUE;
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);

            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('instructor_name', 'The instructor name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('instructor_designation', 'Instructor designation', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('instructor_email', 'Instructor email', 'trim|required|valid_email|callback_unique_inst_email');
            $this->form_validation->set_rules('instructor_phone_number', 'Instructor phone number', 'trim|required|max_length[12]|callback_unique_inst_phone');
            $this->form_validation->set_rules('instructor_organization', 'Instructor Organization', 'trim|required|min_length[4]');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Create Instructor - BLRI Training Application Management System';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Create Instructor';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['data_list_title'] = 'All Instructors List';
                $data['footer_title']    = Admin::$footer_title;

                $file_errors = '';
                $this->session->set_flashdata('file_errors', strip_tags($file_errors));

                $all_instructors         = $this->app_user_model->get_all_instructors(); // Reading and showing the instructor list from DB
                $data['all_instructors'] = $all_instructors;

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_create_instructor_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);

                return FALSE;
            }
            if (empty($_FILES['userFile']['tmp_name'])) {
                $data       = array(
                    'instructor_name'         => $this->input->post('instructor_name'),
                    'instructor_designation'  => $this->input->post('instructor_designation'),
                    'instructor_email'        => $this->input->post('instructor_email'),
                    'instructor_phone_number' => $this->input->post('instructor_phone_number'),
                    'instructor_organization' => $this->input->post('instructor_organization'),
                );
                $is_created = $this->app_user_model->create_instructor($data);
                if ($is_created) {
                    $this->session->set_flashdata('admin_create_instructor_message', "Instructor is created successfully.");
                } else {
                    $this->session->set_flashdata('admin_create_instructor_error_message', "Instructor is not created successfully. Please try again.");
                }
                redirect(base_url() . 'admin/instructor/create', 'refresh');

            } else {
                if (!$this->upload->do_upload()) {
                    $data['title']           = 'Create Instructor - BLRI Training Application Management System';
                    $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                    $data['page_title']      = 'Create Instructor';
                    $data['navbar_title']    = 'BLRI Admin Panel';
                    $data['data_list_title'] = 'All Instructors List';
                    $data['footer_title']    = Admin::$footer_title;

                    $file_errors = $this->upload->display_errors();
                    $this->session->set_flashdata('file_errors', strip_tags($file_errors));

                    $all_instructors         = $this->app_user_model->get_all_instructors(); // Reading and showing the instructor list from DB
                    $data['all_instructors'] = $all_instructors;

                    $this->load->view('admin/admin_dashboard_header_view', $data);
                    $this->load->view('admin/admin_create_instructor_view', $data);
                    $this->load->view('admin/admin_dashboard_footer_view', $data);

                } else {
                    $data       = array(
                        'instructor_name'         => $this->input->post('instructor_name'),
                        'instructor_designation'  => $this->input->post('instructor_designation'),
                        'instructor_email'        => $this->input->post('instructor_email'),
                        'instructor_phone_number' => $this->input->post('instructor_phone_number'),
                        'instructor_organization' => $this->input->post('instructor_organization'),
                        'instructor_photo'        => $this->upload->data('file_name'),
                    );
                    $is_created = $this->app_user_model->create_instructor($data);
                    if ($is_created) {
                        $this->session->set_flashdata('admin_create_instructor_message', "Instructor is created successfully.");
                    } else {
                        $this->session->set_flashdata('admin_create_instructor_error_message', "Instructor is not created successfully. Please try again.");
                    }
                    redirect(base_url() . 'admin/instructor/create', 'refresh');
                }
            }
        }
    }

    public function admin_upload_applicant_form()
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $all_uploaded_forms         = $this->app_user_model->get_all_uploaded_forms(); // Reading and showing the countries list from DB
            $data['all_uploaded_forms'] = $all_uploaded_forms;
            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('form_name', 'Form Name', 'trim|required|min_length[2]|callback_unique_form_name');
            $this->form_validation->set_rules('is_active', 'Is Active');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'BLRI Applicant Form Upload - BLRI Training Application Management System';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Upload Form';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['data_list_title'] = 'All Forms';
                $data['footer_title']    = Admin::$footer_title;

                $file_errors = '';
                $this->session->set_flashdata('file_errors', strip_tags($file_errors));

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_create_form_upload_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);

                return FALSE;
            }
            if (!empty($_FILES['userFile']['name'])) {
                $uploadPath              = './uploaded/applicants_form/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'doc|docx|pdf';
                $config['max_size']      = '2000';

                $is_exist_is_active = $this->app_user_model->check_existence_is_active();
                if ($is_exist_is_active) {
                    $this->session->set_flashdata('file_can_not_be_uploaded', "Sorry! You can not upload the Form due to there is an active file.");
                } else {
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('userFile')) {
                        $fileData                                   = $this->upload->data();
                        $uploadData['applicant_form_name']          = $this->input->post('form_name');
                        $uploadData['applicant_form_file_name']     = $fileData['file_name'];
                        $uploadData['applicant_form_file_created']  = date("Y-m-d H:i:s");
                        $uploadData['applicant_form_file_modified'] = date("Y-m-d H:i:s");
                        $uploadData['applicant_form_is_active']     = $this->input->post('is_active') ? 1 : 0;
                    } else {
                        $file_errors = $this->upload->display_errors();
                        $this->session->set_flashdata('file_errors', strip_tags($file_errors));
                    }

                }

                if (!empty($uploadData)) {
                    //Insert file information into the database
                    $is_created = $this->app_user_model->create_applicant_file_upload($uploadData);
                    if ($is_created) {
                        $this->session->set_flashdata('file_upload_created_success', "File is uploaded successfully.");
                    } else {
                        $this->session->set_flashdata('file_upload_created_error', "File is not uploaded successfully. Please try again.");
                    }
                    redirect(base_url() . 'admin/applicant/form/upload', 'refresh');


                } else {
                    $data['title']           = 'BLRI Applicant Form Upload - BLRI Training Application Management System';
                    $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                    $data['page_title']      = 'Upload Form';
                    $data['navbar_title']    = 'BLRI Admin Panel';
                    $data['data_list_title'] = 'All Forms';
                    $data['footer_title']    = Admin::$footer_title;


                    $this->load->view('admin/admin_dashboard_header_view', $data);
                    $this->load->view('admin/admin_create_form_upload_view', $data);
                    $this->load->view('admin/admin_dashboard_footer_view', $data);
                }

            }
        }
    }

    public function admin_update_applicant_form($applicant_form_id)
    {
        $applicant_form_id_dec   = base64_decode($applicant_form_id);
        $single_app_form         = $this->app_user_model->get_single_app_form_by_id($applicant_form_id_dec);
        $data['single_app_form'] = $single_app_form;
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('form_name', 'Form Name', 'trim|required|min_length[2]');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'BLRI Applicant Form Update Upload - BLRI Training Application Management System';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Update Upload Form';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['footer_title']    = Admin::$footer_title;

                $file_errors = '';
                $this->session->set_flashdata('file_errors', strip_tags($file_errors));


                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_update_form_upload_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);

                return FALSE;
            }
            if (empty($_FILES['userFile']['tmp_name'])) {
                $uploadData['applicant_form_name']          = $this->input->post('form_name');
                $uploadData['applicant_form_file_name']     = $single_app_form['applicant_form_file_name'];
                $uploadData['applicant_form_file_created']  = $single_app_form['applicant_form_file_created'];
                $uploadData['applicant_form_file_modified'] = date("Y-m-d H:i:s");
                //Insert file information into the database

                $is_updated = $this->app_user_model->update_applicant_file_upload($uploadData, $applicant_form_id_dec);
                if ($is_updated) {
                    $this->session->set_flashdata('form_update_success', "Selected Form is updated successfully.");
                } else {
                    $this->session->set_flashdata('slider_update_error', "Selected Form is not Updated successfully. Please try again.");
                }
                redirect(base_url() . 'admin/applicant/form/upload', 'refresh');
            } else {
                $uploadPath              = './uploaded/applicants_form/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'doc|docx|pdf';
                $config['max_size']      = '2000';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userFile')) {
                    $fileData                                   = $this->upload->data();
                    $uploadData['applicant_form_name']          = $this->input->post('form_name');
                    $uploadData['applicant_form_file_name']     = $fileData['file_name'];
                    $uploadData['applicant_form_file_created']  = $single_app_form['applicant_form_file_created'];
                    $uploadData['applicant_form_file_modified'] = date("Y-m-d H:i:s");
                } else {
                    $file_errors = $this->upload->display_errors();
                    $this->session->set_flashdata('file_errors', strip_tags($file_errors));
                }

                if (!empty($uploadData)) {
                    //Insert file information into the database
                    $is_updated = $this->app_user_model->update_applicant_file_upload($uploadData, $applicant_form_id_dec);
                    if ($is_updated) {
                        $this->session->set_flashdata('form_update_success', "Selected Form is updated successfully.");
                    } else {
                        $this->session->set_flashdata('slider_update_error', "Selected Form is not Updated successfully. Please try again.");
                    }
                    redirect(base_url() . 'admin/applicant/form/upload', 'refresh');
                } else {
                    $data['title']           = 'BLRI Applicant Form Update Upload - BLRI Training Application Management System';
                    $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                    $data['page_title']      = 'Update Upload Form';
                    $data['navbar_title']    = 'BLRI Admin Panel';
                    $data['footer_title']    = Admin::$footer_title;


                    $this->load->view('admin/admin_dashboard_header_view', $data);
                    $this->load->view('admin/admin_update_form_upload_view', $data);
                    $this->load->view('admin/admin_dashboard_footer_view', $data);
                }
            }
        }
    }

    public function admin_delete_applicant_form($applicant_form_id)
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $applicant_form_id_dec = base64_decode($applicant_form_id);
            $single_app_form       = $this->app_user_model->get_single_app_form_by_id($applicant_form_id_dec);
            $is_active             = $single_app_form["applicant_form_is_active"];
            if ($is_active) {
                $this->session->set_flashdata('cant_delete_message', 'Active Form can not be deleted.');
            } else {
                $file_name  = $single_app_form["applicant_form_file_name"];
                $path       = "./uploaded/applicants_form/" . $file_name;
                $is_deleted = $this->app_user_model->delete_applicant_form_file($applicant_form_id_dec);
                if ($is_deleted) {
                    unlink($path);
                }
                $this->session->set_flashdata('applicant_form_delete_message', 'Selected Form is successfully deleted');
            }

            redirect(base_url() . 'admin/applicant/form/upload', 'refresh');
        }
    }

    public function admin_make_active_applicant_form($applicant_form_id)
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $applicant_form_id_dec = base64_decode($applicant_form_id);

            $existence_is_active = $this->app_user_model->check_existence_is_active();
            if ($existence_is_active > 0) {
                $this->session->set_flashdata('admin_can_not_active_form', "Sorry! Already there is an active form");
            } else {
                $is_updated = $this->app_user_model->toggle_active_inactive_applicant_file($applicant_form_id_dec, 1);
                if ($is_updated) {
                    $this->session->set_flashdata('form_active_success', "Selected Form is activated successfully.");
                } else {
                    $this->session->set_flashdata('form_active_error', "Selected Form is not activated successfully. Please try again.");
                }
            }
            redirect(base_url() . 'admin/applicant/form/upload', 'refresh');
        }
    }

    public function admin_make_inactive_applicant_form($applicant_form_id)
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $applicant_form_id_dec = base64_decode($applicant_form_id);

            $is_updated = $this->app_user_model->toggle_active_inactive_applicant_file($applicant_form_id_dec, 0);
            if ($is_updated) {
                $this->session->set_flashdata('form_inactive_success', "Selected Form is Inactivated successfully.");
            } else {
                $this->session->set_flashdata('form_inactive_error', "Selected Form is not Inactivated successfully. Please try again.");
            }

            redirect(base_url() . 'admin/applicant/form/upload', 'refresh');
        }
    }

    public function admin_update_instructor($instructor_id)
    {
        $instructor_id_dec = base64_decode($instructor_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $single_instructor         = $this->app_user_model->get_single_instructor_by_id($instructor_id_dec);
            $data['single_instructor'] = $single_instructor;

            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('instructor_name', 'The instructor name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('instructor_designation', 'Instructor designation', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('instructor_phone_number', 'Instructor phone number', 'trim|required|max_length[12]');
            $this->form_validation->set_rules('instructor_organization', 'Instructor Organization', 'trim|required|min_length[4]');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Update Instructor - BLRI Training Application Management System';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Update Instructor';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['data_list_title'] = 'All Instructors List';
                $data['footer_title']    = Admin::$footer_title;

                $file_errors = '';
                $this->session->set_flashdata('file_errors', strip_tags($file_errors));

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_update_instructor_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);

                return FALSE;
            }
            if (empty($_FILES['userFile']['tmp_name'])) {
                $uploadData['instructor_name']         = $this->input->post('instructor_name');
                $uploadData['instructor_designation']  = $this->input->post('instructor_designation');
                $uploadData['instructor_phone_number'] = $this->input->post('instructor_phone_number');
                $uploadData['instructor_organization'] = $this->input->post('instructor_organization');
                $uploadData['instructor_photo']        = $single_instructor['instructor_photo'];
                //Insert file information into the database
                $is_updated = $this->app_user_model->update_instructor($uploadData, $instructor_id_dec);
                if ($is_updated) {
                    $this->session->set_flashdata('admin_update_instructor_message', "Instructor is updated successfully.");
                } else {
                    $this->session->set_flashdata('admin_update_instructor_error_message', "Instructor is not update successfully. Please try again.");
                }
                redirect(base_url() . 'admin/instructor/create/', 'refresh');

            } else {
                $config['upload_path']   = './uploaded/instructors_photo';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['overwrite']     = TRUE;
                $config['max_size']      = 2048;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userFile')) {
                    $fileData                              = $this->upload->data();
                    $uploadData['instructor_photo']        = $fileData['file_name'];
                    $uploadData['instructor_name']         = $this->input->post('instructor_name');
                    $uploadData['instructor_designation']  = $this->input->post('instructor_designation');
                    $uploadData['instructor_phone_number'] = $this->input->post('instructor_phone_number');
                    $uploadData['instructor_organization'] = $this->input->post('instructor_organization');
                } else {
                    $file_errors = $this->upload->display_errors();
                    $this->session->set_flashdata('file_errors', strip_tags($file_errors));
                    //var_dump($file_errors);
                    //redirect(base_url() . 'admin/instructor/update/'.$instructor_id, 'refresh');
                }

                if (!empty($uploadData)) {
                    $is_updated = $this->app_user_model->update_instructor($uploadData, $instructor_id_dec);
                    if ($is_updated) {
                        $this->session->set_flashdata('admin_update_instructor_message', "Instructor is updated successfully.");
                    } else {
                        $this->session->set_flashdata('admin_update_instructor_error_message', "Instructor is not update successfully. Please try again.");
                    }
                    redirect(base_url() . 'admin/instructor/create/', 'refresh');
                } else {
                    $data['title']           = 'Update Instructor - BLRI Training Application Management System';
                    $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                    $data['page_title']      = 'Update Instructor';
                    $data['navbar_title']    = 'BLRI Admin Panel';
                    $data['data_list_title'] = 'All Instructors List';
                    $data['footer_title']    = Admin::$footer_title;


                    $this->load->view('admin/admin_dashboard_header_view', $data);
                    $this->load->view('admin/admin_update_instructor_view', $data);
                    $this->load->view('admin/admin_dashboard_footer_view', $data);
                }
            }
        }
    }

    public function admin_assign_course_instructor($instructor_id)
    {
        $instructor_id_dec = base64_decode($instructor_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $data['title']           = 'Assign Course to Instructor - BLRI Training Application Management System';
            $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
            $data['page_title']      = 'Instructor Information';
            $data['navbar_title']    = 'BLRI Admin Panel';
            $data['data_list_title'] = 'Assign Course to Instructor';
            $data['footer_title']    = Admin::$footer_title;
            $data['is_assigned']     = 0;

            $single_instructor         = $this->app_user_model->get_single_instructor_by_id($instructor_id_dec);
            $data['single_instructor'] = $single_instructor;

            $assign_data = array(
                'is_assigned' => FALSE,
            );
            $this->session->set_userdata($assign_data);

            $all_courses         = $this->app_user_model->get_all_courses(); // Reading and showing the courses list from DB
            $data['all_courses'] = $all_courses;


            $this->load->view('admin/admin_dashboard_header_view', $data);
            $this->load->view('admin/admin_assign_course_instructor_view', $data);
            $this->load->view('admin/admin_dashboard_footer_view', $data);

        }
    }

    public function admin_course_assign($course_id, $instructor_id)
    {
        $course_id_dec     = base64_decode($course_id);
        $instructor_id_dec = base64_decode($instructor_id);
        $is_assigned       = $this->app_user_model->assign_course($course_id_dec, $instructor_id_dec);
        if ($is_assigned) {
            $this->session->set_flashdata('admin_assign_course_message', "Your Selected Course is Assigned successfully.");
        } else {
            $this->session->set_flashdata('admin_assign_course_error_message', "Your Selected Course is not assigned successfully. Please try again.");
        }
        redirect(base_url() . 'admin/assign/course/to/instructor/' . $instructor_id);
    }

    public function admin_course_remove($course_id, $instructor_id)
    {
        $course_id_dec     = base64_decode($course_id);
        $instructor_id_dec = base64_decode($instructor_id);
        $is_removed        = $this->app_user_model->remove_course($course_id_dec, $instructor_id_dec);
        if ($is_removed) {
            $this->session->set_flashdata('admin_remove_course_message', "Your Selected Course is removed successfully.");
        } else {
            $this->session->set_flashdata('admin_remove_course_error_message', "Your Selected Course is not removed successfully. Please try again.");
        }
        redirect(base_url() . 'admin/assign/course/to/instructor/' . $instructor_id);
    }

    public function admin_update_course($course_id)
    {
        $course_id_dec = base64_decode($course_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('course_name', 'This course name', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('course_description', 'Course description', 'trim');
            $this->form_validation->set_rules('course_type', 'Selected Course Type', 'trim|required');
            $this->form_validation->set_rules('course_start_date', 'Course start date', 'trim|required');
            $this->form_validation->set_rules('course_end_date', 'Course end date', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Update Course - BLRI Training Application Management';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Update Course';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['footer_title']    = Admin::$footer_title;

                $single_course         = $this->app_user_model->get_single_course_by_id($course_id_dec);
                $data['single_course'] = $single_course;

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_update_course_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            } else {
                $start_date = date_create($this->input->post('course_start_date'));
                $end_date   = date_create($this->input->post('course_end_date'));
                if ($end_date < $start_date) {
                    $this->session->set_flashdata('course_date_selection_error', "End Date never be smaller than the Start Date.");
                } else {
                    $data       = array(
                        'course_name'        => $this->input->post('course_name'),
                        'course_venue'       => $this->input->post('course_venue'),
                        'course_type'        => $this->input->post('course_type'),
                        'course_description' => $this->input->post('course_description'),
                        'course_start_date'  => $this->input->post('course_start_date'),
                        'course_end_date'    => $this->input->post('course_end_date'),
                    );
                    $is_updated = $this->app_user_model->update_course($data, $course_id_dec);
                    if ($is_updated) {
                        $this->session->set_flashdata('admin_update_course_message', "Selected Course is Updated successfully.");
                    } else {
                        $this->session->set_flashdata('admin_update_course_error_message', "Selected Course is not Updated successfully. Please try again.");
                    }
                }
                redirect(base_url() . 'admin/course/create', 'refresh');
            }
        }
    }

    public function admin_delete_course($course_id)
    {
        $course_id_dec = base64_decode($course_id);
        /*$single_course = $this->app_user_model->get_single_course_by_id($course_id_dec);
        $is_active = $single_partner["is_active"];
        if ($is_active) {
            $this->session->set_flashdata('cant_delete_message', 'Active Partner can not be deleted');
        } else {
            $this->app_user_model->delete_partner($partner_id_dec);
            $this->session->set_flashdata('partner_delete_message', 'Selected Partner is successfully deleted');
        }*/

        $is_deleted = $this->app_user_model->delete_course($course_id_dec);
        if ($is_deleted) {
            $this->session->set_flashdata('admin_delete_course_message', "Your Selected Course is Deleted successfully.");
        } else {
            $this->session->set_flashdata('admin_delete_course_error_message', "Your Selected Course is not Deleted successfully. Please try again.");
        }
        redirect(base_url() . 'admin/course/create');
    }


    public function admin_delete_instructor($instructor_id)
    {
        $instructor_id_dec = base64_decode($instructor_id);

        $single_instructor = $this->app_user_model->get_single_instructor_by_id($instructor_id_dec);


        $course_count = $single_instructor['course_count'];
        if ($course_count > 0) {
            $this->session->set_flashdata('admin_delete_instructor_error_message', "Your Selected Instructor can't be deleted due to assigned course(s).");
        } else {
            $is_deleted = $this->app_user_model->delete_instructor($instructor_id_dec);
            if ($is_deleted) {
                $instructor_image_name = $single_instructor['instructor_photo'];
                $path                  = "./uploaded/instructors_photo/" . $instructor_image_name;
                unlink($path);
                $this->session->set_flashdata('admin_delete_instructor_message', "Your Selected Instructor is Deleted successfully.");
            } else {
                $this->session->set_flashdata('admin_delete_instructor_error_message', "Your Selected Instructor is not Deleted successfully. Please try again.");
            }

        }
        redirect(base_url() . 'admin/instructor/create');
    }


    public function admin_update_sub_district($sub_district_id)
    {
        $sub_district_id_dec = base64_decode($sub_district_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {

            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('update_sub_district_name', 'This sub district', 'trim|required|min_length[2]');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Update Sub District - BLRI Training Application Management';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Update Sub District';
                $data['navbar_title']    = 'BLRI Admin Panel';

                $all_districts         = $this->app_user_model->get_all_districts(); // Reading and showing the District list from DB
                $data['all_districts'] = $all_districts;

                $single_sub_district = $this->app_user_model->get_single_sub_district_by_id($sub_district_id_dec);

                $data['single_sub_district'] = $single_sub_district;
                $data['footer_title']        = Admin::$footer_title;

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_update_sub_district_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            } else {
                $is_updated = $this->app_user_model->update_sub_district($sub_district_id_dec);
                if ($is_updated) {
                    $this->session->set_flashdata('admin_update_sub_district_message', "Your Selected Sub District is updated successfully.");
                } else {
                    $this->session->set_flashdata('admin_update_sub_district_error_message', "Your Selected Sub District is not updated successfully. Please try again.");
                }
                redirect(base_url() . 'admin/sub/district/create', 'refresh');
            }
        }
    }

    public function admin_update_district($district_id)
    {
        $district_id_dec = base64_decode($district_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {

            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('update_district_name', 'This district', 'trim|required|min_length[2]');
            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Update District - BLRI Training Application Management';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['page_title']      = 'Update District';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $single_district         = $this->app_user_model->get_single_district_by_id($district_id_dec);
                $data['single_district'] = $single_district;
                $data['footer_title']    = Admin::$footer_title;

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_update_district_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            } else {
                $is_updated = $this->app_user_model->update_district($district_id_dec);
                if ($is_updated) {
                    $this->session->set_flashdata('admin_update_district_message', "Your Selected District is updated successfully.");
                } else {
                    $this->session->set_flashdata('admin_update_district_error_message', "Your Selected District is not updated successfully. Please try again.");
                }
                redirect(base_url() . 'admin/district/create', 'refresh');
            }
        }
    }

    public function admin_applicant_list_search()
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $this->load->library('pagination');
            $config['base_url']    = base_url('admin/show/applicants');
            $config['per_page']    = 5;
            $config["uri_segment"] = 4;
            //config for bootstrap pagination class integration
            $config['full_tag_open']   = '<ul class="pagination">';
            $config['full_tag_close']  = '</ul>';
            $config['first_link']      = FALSE;
            $config['last_link']       = FALSE;
            $config['first_tag_open']  = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link']       = '&laquo';
            $config['prev_tag_open']   = '<li class="prev">';
            $config['prev_tag_close']  = '</li>';
            $config['next_link']       = '&raquo';
            $config['next_tag_open']   = '<li>';
            $config['next_tag_close']  = '</li>';
            $config['last_tag_open']   = '<li>';
            $config['last_tag_close']  = '</li>';
            $config['cur_tag_open']    = '<li class="active"><a href="#">';
            $config['cur_tag_close']   = '</a></li>';
            $config['num_tag_open']    = '<li>';
            $config['num_tag_close']   = '</li>';

            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data = array();

            $data['all_courses']       = $this->app_user_model->get_all_distinct_courses();
            $data['all_venues']        = $this->app_user_model->get_all_distinct_venues();
            $data['all_districts']     = $this->app_user_model->get_all_districts();
            $data['all_sub_districts'] = NULL;

            $data['title']                     = 'List of Applicants - BLRI Training Application Management';
            $data['blri_admin_name']           = $this->session->userdata('blri_admin_name');
            $data['page_title']                = 'Search Applicants';
            $data['navbar_title']              = 'BLRI Admin Panel';
            $data['footer_title']              = Admin::$footer_title;
            $data['data_list_title']           = 'Applicants List';
            $data['course_type_selected']      = "";
            $data['course_id_selected']        = 0;
            $data['course_venue_selected']     = '';
            $data['district_id_selected']      = 0;
            $data['sub_district_id_selected']  = 0;
            $data['applicant_gender_selected'] = 0;
            $data['applicant_NID']             = '';
            $data['from_date']                 = '';
            $data['to_date']                   = '';

            $data['course_type_selected']      = '';
            $data['course_id_selected']        = 0;
            $data['course_venue_selected']     = '';
            $data['district_id_selected']      = 0;
            $data['sub_district_id_selected']  = 0;
            $data['applicant_gender_selected'] = 0;
            $data['applicant_NID']             = '';
            $data['from_date']                 = '';
            $data['to_date']                   = '';

            if ($this->input->method() == 'post') {
                $course_type      = $this->input->post('course_type');
                $course_venue     = $this->input->post('course_venue');
                $course_id        = $this->input->post('course_id');
                $district_id      = $this->input->post('district_id');
                $sub_district_id  = $this->input->post('sub_district_id');
                $applicant_gender = $this->input->post('applicant_gender');
                $applicant_NID    = $this->input->post('applicant_NID');
                $from_date        = $this->input->post('from_date');
                $to_date          = $this->input->post('to_date');

                $data['course_type_selected']      = $course_type;
                $data['course_id_selected']        = $course_id;
                $data['course_venue_selected']     = $course_venue;
                $data['district_id_selected']      = $district_id;
                $data['sub_district_id_selected']  = $sub_district_id;
                $data['applicant_gender_selected'] = $applicant_gender;
                $data['applicant_NID']             = $applicant_NID;
                $data['from_date']                 = $from_date;
                $data['to_date']                   = $to_date;

                $search_query = array();

                if (date_create($to_date) < date_create($from_date)) {
                    $this->session->set_flashdata('fare_date_selection', "To date never be smaller than From date");
                } else {
                    if ($from_date != '') {
                        $search_query['from_date'] = $from_date;
                    }
                    if ($to_date != '') {
                        $search_query['to_date'] = $to_date;
                    }
                    if ($course_type != '') {
                        $search_query['course_type'] = $course_type;
                    }
                    if ($course_venue != '') {
                        $search_query['course_venue'] = $course_venue;
                    }
                    if ($course_id != '') {
                        $search_query['course_id'] = $course_id;
                    }
                    if ($district_id != '') {
                        $search_query['district_id'] = $district_id;
                    }
                    if ($sub_district_id != '') {
                        $search_query['sub_district_id'] = $sub_district_id;
                    }
                    if ($applicant_gender != '') {
                        $search_query['applicant_gender'] = $applicant_gender;
                    }
                    if ($applicant_NID != '') {
                        $search_query['applicant_NID'] = $applicant_NID;
                    }
                    if ($this->input->post('print_list') !== NULL) {
                        $data['course_name']  = ($course_id != '') ? $this->app_user_model->get_single_course_by_id($course_id)['course_name'] : 'All';
                        $data['course_type']  = ($course_type != '') ? $course_type : 'All';
                        $data['course_venue'] = ($course_venue != '') ? $course_venue : 'All';
                        $data['from_date']    = ($from_date != '') ? $from_date : 'All Date';

                        $data['title']          = 'Print Preview';
                        $data['all_applicants'] = $this->app_user_model->get_applicants_by_search_query($search_query);
                        $this->load->view('admin/admin_dashboard_header_print', $data);
                        $this->load->view('admin/admin_applicants_list_print_view', $data);

                        return;
                    } else {
                        $data['count_applicants'] = $this->app_user_model->get_applicants_by_search_query($search_query);
                        $config['total_rows']     = (is_null($data['count_applicants'])) ? 0 : count($data['count_applicants']->result());
                        $choice                   = $config["total_rows"] / $config["per_page"];
                        $config["num_links"]      = floor($choice);
                        $data['all_applicants']   = $this->app_user_model->get_applicants_by_search_query($search_query, $config["per_page"], $page);
                    }
                }
            } else {
                $data['count_applicants'] = $this->app_user_model->get_all_applicants();
                $config['total_rows']     = count($data['count_applicants']->result());
                $choice                   = $config["total_rows"] / $config["per_page"];
                $config["num_links"]      = floor($choice);
                $data['all_applicants']   = $this->app_user_model->get_all_applicants($config["per_page"], $page);
            }
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();

            $this->load->view('admin/admin_dashboard_header_view', $data);
            $this->load->view('admin/admin_applicants_list_search_view', $data);
            $this->load->view('admin/admin_dashboard_footer_view', $data);
        }
    }

    public function admin_show_applicants()
    {
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $this->load->library('Form_validation');

            $all_courses         = $this->app_user_model->get_all_distinct_courses(); // Reading and showing the courses list from DB
            $data['all_courses'] = $all_courses;

            $all_venues         = $this->app_user_model->get_all_distinct_venues(); // Reading and showing the courses list from DB
            $data['all_venues'] = $all_venues;

            $all_districts         = $this->app_user_model->get_all_districts(); // Reading and showing the District list from DB
            $data['all_districts'] = $all_districts;

            $all_applicants         = $this->app_user_model->get_all_applicants();
            $data['all_applicants'] = $all_applicants;
            /*$all_sub_districts = $this->app_user_model->get_all_sub_districts(); // Reading and showing the Sub District list from DB
            $data['all_sub_districts'] = $all_sub_districts;*/
            $data['all_sub_districts'] = NULL;
            $all_sub_districts         = NULL;
            // field name, error message, validation rules
            $this->form_validation->set_rules('course_id', 'Selected Course', 'trim');
            $this->form_validation->set_rules('district_id', 'Selected District', 'trim');
            $this->form_validation->set_rules('sub_district_id', 'Selected Sub District', 'trim');
            $this->form_validation->set_rules('from_date', 'Selected From Date', 'trim');
            $this->form_validation->set_rules('to_date', 'Selected To Date', 'trim');
            if ($this->form_validation->run() == FALSE) {
                $data['title']                    = 'List of Applicants - BLRI Training Application Management';
                $data['blri_admin_name']          = $this->session->userdata('blri_admin_name');
                $data['page_title']               = 'Search Applicants';
                $data['navbar_title']             = 'BLRI Admin Panel';
                $data['footer_title']             = Admin::$footer_title;
                $data['data_list_title']          = 'Applicants List';
                $data['course_type_selected']     = "";
                $data['course_id_selected']       = 0;
                $data['course_venue_selected']    = '';
                $data['district_id_selected']     = 0;
                $data['sub_district_id_selected'] = 0;
                $data['from_date']                = '';
                $data['to_date']                  = '';

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_applicants_list_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);

                return FALSE;
            } else {
                $course_type     = $this->input->post('course_type');
                $course_venue    = $this->input->post('course_venue');
                $course_id       = $this->input->post('course_id');
                $district_id     = $this->input->post('district_id');
                $sub_district_id = $this->input->post('sub_district_id');
                $from_date       = $this->input->post('from_date');
                $to_date         = $this->input->post('to_date');
                $this->session->set_flashdata('please_select_one', "");
                $this->session->set_flashdata('fare_date_selection', "");
                $data['course_type_selected']     = '';
                $data['course_id_selected']       = 0;
                $data['course_venue_selected']    = '';
                $data['district_id_selected']     = 0;
                $data['sub_district_id_selected'] = 0;
                $data['from_date']                = '';
                $data['to_date']                  = '';
                if (date_create($to_date) < date_create($from_date)) {
                    $this->session->set_flashdata('fare_date_selection', "To date never be smaller than From date");
                }
                if ($course_id > 0 && $district_id == 0 && $sub_district_id == 0 && $to_date == '' && $from_date == '') {
                    $data['course_id_selected']       = $course_id;
                    $data['district_id_selected']     = 0;
                    $data['sub_district_id_selected'] = 0;
                    $data['from_date']                = '';
                    $data['to_date']                  = '';
                    $applicants                       = $this->app_user_model->get_applicants_list($course_id);
                } elseif ($district_id > 0 && $course_id == 0 && $sub_district_id == 0 && $to_date == '' && $from_date == '') {
                    $data['course_id_selected']       = 0;
                    $data['district_id_selected']     = $district_id;
                    $data['sub_district_id_selected'] = 0;
                    $data['from_date']                = '';
                    $data['to_date']                  = '';
                    $all_sub_districts                = $this->app_user_model->get_sub_district_by_district_id($district_id);
                    $applicants                       = $this->app_user_model->get_applicants_list_by_district($district_id);
                } elseif ($sub_district_id > 0 && $course_id == 0 && $district_id == 0) {
                    $data['course_id_selected']       = 0;
                    $data['district_id_selected']     = 0;
                    $data['sub_district_id_selected'] = $sub_district_id;
                    //$single_sub_district = $this->app_user_model->get_single_sub_district_by_id($sub_district_id);
                    $applicants = $this->app_user_model->get_applicants_list_by_sub_district($sub_district_id);
                } elseif ($sub_district_id > 0 && $course_id > 0 && $district_id == 0) {
                    $data['course_id_selected']       = $course_id;
                    $data['district_id_selected']     = 0;
                    $data['sub_district_id_selected'] = $sub_district_id;
                    $applicants                       = $this->app_user_model->get_applicants_list_by_course_sub_district($course_id, $sub_district_id);
                } elseif ($district_id > 0 && $sub_district_id > 0 && $course_id == 0 && $to_date == '' && $from_date == '') {
                    $data['course_id_selected']       = 0;
                    $data['district_id_selected']     = $district_id;
                    $data['sub_district_id_selected'] = $sub_district_id;
                    $data['from_date']                = '';
                    $data['to_date']                  = '';
                    $all_sub_districts                = $this->app_user_model->get_sub_district_by_district_id($district_id);
                    $applicants                       = $this->app_user_model->get_applicants_list_by_district_sub_district($district_id, $sub_district_id);
                } elseif ($course_id > 0 && $district_id > 0 && $sub_district_id == 0 && $to_date == '' && $from_date == '') {
                    $data['course_id_selected']       = $course_id;
                    $data['district_id_selected']     = $district_id;
                    $data['sub_district_id_selected'] = 0;
                    $data['from_date']                = '';
                    $data['to_date']                  = '';
                    $applicants                       = $this->app_user_model->get_applicants_list_by_course_district($course_id, $district_id);
                    $all_sub_districts                = $this->app_user_model->get_sub_district_by_district_id($district_id);
                } elseif ($course_id > 0 && $district_id > 0 && $sub_district_id > 0 && $to_date == '' && $from_date == '') {
                    $data['course_id_selected']       = $course_id;
                    $data['district_id_selected']     = $district_id;
                    $data['sub_district_id_selected'] = $sub_district_id;
                    $data['from_date']                = '';
                    $data['to_date']                  = '';
                    $all_sub_districts                = $this->app_user_model->get_sub_district_by_district_id($district_id);
                    $applicants                       = $this->app_user_model->get_applicants_list_by_course_district_sub($course_id, $district_id, $sub_district_id);

                } elseif ($course_id > 0 && $district_id > 0 && $to_date != '' && $from_date != '') {
                    $data['course_id_selected']       = $course_id;
                    $data['district_id_selected']     = $district_id;
                    $data['sub_district_id_selected'] = $sub_district_id;
                    $data['from_date']                = $from_date;
                    $data['to_date']                  = $to_date;
                    $all_sub_districts                = $this->app_user_model->get_sub_district_by_district_id($district_id);
                    $applicants                       = $this->app_user_model->get_applicants_list_by_course_district_daterange($course_id, $district_id, $to_date, $from_date);

                } elseif ($course_id > 0 && $district_id == 0 && $to_date != '' && $from_date != '') {
                    $data['course_id_selected']   = $course_id;
                    $data['district_id_selected'] = 0;
                    $data['from_date']            = $from_date;
                    $data['to_date']              = $to_date;
                    $applicants                   = $this->app_user_model->get_applicants_list_by_course_daterange($course_id, $to_date, $from_date);
                } elseif ($course_id == 0 && $district_id > 0 && $to_date != '' && $from_date != '') {
                    $data['course_id_selected']   = 0;
                    $data['district_id_selected'] = $district_id;
                    $data['from_date']            = $from_date;
                    $data['to_date']              = $to_date;
                    $applicants                   = $this->app_user_model->get_applicants_list_by_district_daterange($district_id, $to_date, $from_date);

                } elseif ($course_type == '' && $course_id == 0 && $district_id == 0 && $sub_district_id == 0 && $to_date == '' && $from_date == '') {
                    $this->session->set_flashdata('please_select_one', "Please Select At least one parameter");
                    $data['course_id_selected']       = 0;
                    $data['district_id_selected']     = 0;
                    $data['sub_district_id_selected'] = 0;
                    $data['from_date']                = '';
                    $data['to_date']                  = '';
                    $applicants                       = NULL;
                } elseif ($course_id == 0 && $district_id == 0 && $sub_district_id == 0 && $to_date != '' && $from_date != '') {
                    $data['course_id_selected']   = 0;
                    $data['district_id_selected'] = 0;
                    $data['from_date']            = $from_date;
                    $data['to_date']              = $to_date;
                    $applicants                   = $this->app_user_model->get_applicants_list_by_daterange($to_date, $from_date);
                } elseif ($course_id == 0 && $district_id == 0 && $sub_district_id == 0 && (date_create($to_date) < date_create($from_date))) {
                    $this->session->set_flashdata('fare_date_selection', "From date never be bigger than To date");
                    $data['course_id_selected']       = 0;
                    $data['district_id_selected']     = 0;
                    $data['sub_district_id_selected'] = 0;
                    $data['from_date']                = '';
                    $data['to_date']                  = '';
                    $applicants                       = NULL;
                }
                $data['applicants_list']   = $applicants;
                $data['all_sub_districts'] = $all_sub_districts;
                $data['title']             = 'List of Applicants - BLRI Training Application Management';
                $data['blri_admin_name']   = $this->session->userdata('blri_admin_name');
                $data['page_title']        = 'Search Applicants';
                $data['navbar_title']      = 'BLRI Admin Panel';
                $data['footer_title']      = Admin::$footer_title;
                $data['data_list_title']   = 'Applicants List';

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_applicants_list_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            }
        }
    }

    public function admin_enroll_applicant($applicant_id)
    {
        $applicant_id_dec = base64_decode($applicant_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $is_enrolled = $this->app_user_model->enroll_applicant($applicant_id_dec, 1);
            if ($is_enrolled) {
                $this->session->set_flashdata('admin_enroll_applicant_message', "Your Selected Applicant is Enrolled successfully.");
            } else {
                $this->session->set_flashdata('admin_enroll_applicant_error_message', "Your Selected Applicant is not Enrolled successfully. Please try again.");
            }
            redirect(base_url() . 'admin/show/applicants');

        }

    }

    public function admin_withdraw_applicant($applicant_id)
    {
        $applicant_id_dec = base64_decode($applicant_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $is_withdrawn = $this->app_user_model->enroll_applicant($applicant_id_dec, 0);
            if ($is_withdrawn) {
                $this->session->set_flashdata('admin_withdrawn_applicant_message', "Your Selected Applicant is Withdrawn successfully.");
            } else {
                $this->session->set_flashdata('admin_withdrawn_applicant_error_message', "Your Selected Applicant is not Withdrawn successfully. Please try again.");
            }
            redirect(base_url() . 'admin/show/applicants');

        }

    }

    public function admin_passed_applicant($applicant_id)
    {
        $applicant_id_dec = base64_decode($applicant_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $is_passed = $this->app_user_model->pass_applicant($applicant_id_dec);
            if ($is_passed) {
                $this->session->set_flashdata('admin_pass_applicant_message', "Your Selected Applicant is Passed successfully.");
            } else {
                $this->session->set_flashdata('admin_pass_applicant_error_message', "Your Selected Applicant is not Passed successfully. Please try again.");
            }
            redirect(base_url() . 'admin/show/applicants');
        }
    }

    public function admin_delete_applicant($applicant_id)
    {
        $applicant_id_dec = base64_decode($applicant_id);
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {
            $is_trashed = $this->app_user_model->trash_applicant($applicant_id_dec);
            if ($is_trashed) {
                $this->session->set_flashdata('admin_trashed_applicant_message', "Your Selected Applicant is Trashed successfully.");
            } else {
                $this->session->set_flashdata('admin_trashed_applicant_error_message', "Your Selected Applicant is not Trashed successfully. Please try again.");
            }
            redirect(base_url() . 'admin/show/applicants');
        }
    }

    public function show_sub_district()
    {
        $districtId = $_POST['districtId'];
        echo "<option value=''>Please Select a Sub District</option>";
        $all_sub_districts = $this->app_user_model->get_sub_district_by_district_id($districtId);
        if (isset($all_sub_districts) && $all_sub_districts->num_rows() > 0):
            foreach ($all_sub_districts->result() as $row): ?>
                <option
                    value="<?php echo $row->sub_district_id ?>"><?php echo $row->sub_district_name; ?></option>
                <?php
            endforeach;
        endif;
    }

    public function show_course_by_type()
    {
        $course_type = $_POST['course_type'];
        echo "<option value=''>Please Select a Course Name</option>";
        if ($course_type != '') {
            $all_courses = $this->app_user_model->get_all_course_by_type($course_type);
        } else {
            $all_courses = $this->app_user_model->get_all_distinct_courses();
        }
        if (isset($all_courses) && $all_courses->num_rows() > 0):
            foreach ($all_courses->result() as $row): ?>
                <option
                    value="<?php echo $row->course_id ?>"><?php echo $row->course_name; ?></option>
                <?php
            endforeach;
        endif;
    }

    public function update_admin_user()
    {
        $blri_admin_id = $this->session->userdata('blri_admin_id');
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {

            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('nid', 'Your NID', 'trim');
            $this->form_validation->set_rules('cell_number', 'Your Mobile Number', 'trim');

            $particular_user = $this->app_user_model->get_user_by_id($blri_admin_id);

            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Update BLRI Admin Profile';
                $data['page_title']      = 'Update Your Profile';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');
                $data['particular_user'] = $particular_user;
                $data['footer_title']    = Admin::$footer_title;

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_profile_update_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            } else {
                $this->app_user_model->update_admin_info($blri_admin_id);
                $this->session->set_flashdata('admin_info_update_message', "Your information is updated successfully.");
                redirect(base_url() . 'admin/profile/update', 'refresh');
            }
        }
    }

    public function update_admin_password()
    {
        $blri_admin_id       = $this->session->userdata('blri_admin_id');
        $blri_admin_username = $this->session->userdata('blri_admin_username');
        if (($this->session->userdata('blri_admin_username') == "")) {
            $this->logout();
        } else {

            $this->load->library('Form_validation');
            // field name, error message, validation rules
            $this->form_validation->set_rules('email', 'Sorry! Your Email address', 'trim|required|valid_email|callback_exist_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data['title']           = 'Update BLRI Admin Password';
                $data['footer_title']    = Admin::$footer_title;
                $data['page_title']      = 'Update Your Password';
                $data['navbar_title']    = 'BLRI Admin Panel';
                $data['blri_admin_name'] = $this->session->userdata('blri_admin_name');

                $this->load->view('admin/admin_dashboard_header_view', $data);
                $this->load->view('admin/admin_password_update_view', $data);
                $this->load->view('admin/admin_dashboard_footer_view', $data);
            } else {
                $this->app_user_model->admin_password_update($blri_admin_id, $blri_admin_username);
                $this->session->set_flashdata('admin_password_update_message', "Your Password is updated successfully.");
                redirect(base_url() . 'admin/password/update', 'refresh');
            }
        }
    }


    function not_found_email($str)
    {
        $this->load->model('app_user_model');
        if (!$this->app_user_model->check_user_email($str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('not_found_email', "%s {$str} not found!");

            return FALSE;
        }
    }

    function unique_email($str)
    {
        $this->load->model('app_user_model');
        if (!$this->app_user_model->exist_user_email($str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('unique_email', "%s {$str} already exist!");

            return FALSE;
        }
    }

    function unique_form_name($str)
    {
        $this->load->model('app_user_model');
        if (!$this->app_user_model->exist_unique_form_name($str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('unique_form_name', "%s {$str} already exist!");

            return FALSE;
        }
    }

    function exist_email($str)
    {
        $this->load->model('app_user_model');
        if (!$this->app_user_model->exist_admin_email($str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('exist_email', "%s {$str} doesn't exist");

            return FALSE;
        }
    }

    function unique_inst_email($str)
    {
        $this->load->model('app_user_model');
        if (!$this->app_user_model->exist_instructor_email($str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('unique_inst_email', "%s {$str} already exist");

            return FALSE;
        }
    }

    function unique_inst_phone($str)
    {
        $this->load->model('app_user_model');
        if (!$this->app_user_model->exist_instructor_phone($str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('unique_inst_phone', "%s {$str} already exist");

            return FALSE;
        }
    }

    public function logout()
    {
        $newdata = array(
            'blri_admin_id'       => '',
            'blri_admin_username' => '',
            'blri_admin_name'     => '',
            'logged_in'           => FALSE,
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        redirect('/admin', 'refresh');
    }
}