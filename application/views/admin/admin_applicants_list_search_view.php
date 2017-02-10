<body class="nav-md">
<script language="javascript">
    function checkMe() {
        if (confirm("Are you sure you want to delete the selected Course?")) {
            return true;
        } else {
            return false;
        }
    }
</script>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo base_url(); ?>admin" class="site_title">
                        <i class="fa fa-user"></i> <span><?php echo $navbar_title; ?></span>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="profile">
                    <div class="profile_pic">
                        <img src="<?php echo base_url(); ?>images/avatar.png" alt="<?php echo $blri_admin_name; ?>"
                             class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>

                        <h2><?php echo $blri_admin_name; ?></h2>
                    </div>
                </div>
                <br/>
                <?php $this->load->view('admin/admin_dashboard_navbar_view'); ?>
            </div>
        </div>
        <?php $this->load->view('admin/admin_dashboard_top_nevigation_view'); ?>
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $page_title; ?></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php if (validation_errors()) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo validation_errors(); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('please_select_one')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('please_select_one'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('fare_date_selection')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('fare_date_selection'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_enroll_applicant_message')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_enroll_applicant_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_enroll_applicant_error_message')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_enroll_applicant_error_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_withdrawn_applicant_message')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_withdrawn_applicant_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_withdrawn_applicant_error_message')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_withdrawn_applicant_error_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_pass_applicant_message')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_pass_applicant_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_pass_applicant_error_message')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_pass_applicant_error_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_trashed_applicant_message')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_trashed_applicant_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_trashed_applicant_error_message')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_trashed_applicant_error_message'); ?></strong>
                                    </div>
                                <?php } ?>

                                <br/>

                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                      method="POST">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="course_id">Select
                                            Course Type</label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="course_type" name="course_type" class="form-control">
                                                <option value="" selected>Please Select a Course
                                                    Type <?= $course_type_selected ?></option>
                                                <option
                                                    value="Revenue Budget" <?php if ($course_type_selected == "Revenue Budget") echo 'selected'; ?>>
                                                    Revenue Budget
                                                </option>
                                                <option
                                                    value="Development Budget" <?php if ($course_type_selected == "Development Budget") echo 'selected'; ?>>
                                                    Development Budget
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="course_id">Select
                                            Course Name</label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="course_id" name="course_id" class="form-control">
                                                <option value="">Please Select a Course Name</option>
                                                <?php if (isset($all_courses) && $all_courses->num_rows() > 0):
                                                    foreach ($all_courses->result() as $row): ?>
                                                        <option
                                                            value="<?php echo $row->course_id ?>" <?php if ($course_id_selected == $row->course_id) echo 'selected'; ?>>
                                                            <?php echo $row->course_name; ?>
                                                        </option>
                                                    <?php
                                                    endforeach;
                                                endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="course_id">Select
                                            Course Venue </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="course_venue" name="course_venue" class="form-control">
                                                <option value="">Please Select a Course Venue
                                                </option>
                                                <?php if (isset($all_venues) && $all_venues->num_rows() > 0):
                                                    foreach ($all_venues->result() as $row): ?>
                                                        <option
                                                            value="<?php echo $row->course_venue ?>" <?php if ($course_venue_selected == $row->course_venue) echo 'selected'; ?>>
                                                            <?php echo $row->course_venue; ?>
                                                        </option>
                                                    <?php
                                                    endforeach;
                                                endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="district_id">Select
                                            District</label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="district_ids" name="district_id" class="form-control">
                                                <option value="">Please Select a District</option>
                                                <?php if (isset($all_districts) && $all_districts->num_rows() > 0):
                                                    foreach ($all_districts->result() as $row): ?>
                                                        <option
                                                            value="<?php echo $row->district_id ?>" <?php if ($district_id_selected == $row->district_id) echo 'selected'; ?>><?php echo $row->district_name; ?></option>
                                                    <?php
                                                    endforeach;
                                                endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_district_id">Select
                                            Sub District</label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="sub_district_ids" name="sub_district_id" class="form-control">
                                                <?php
                                                if ($sub_district_id_selected || $district_id_selected) {
                                                    echo "<option value=''>Please Select a Sub District</option>";
                                                    if (isset($all_sub_districts) && $all_sub_districts->num_rows() > 0):
                                                        foreach ($all_sub_districts->result() as $row): ?>
                                                            <option
                                                                value="<?php echo $row->sub_district_id ?>" <?php if ($sub_district_id_selected == $row->sub_district_id) echo 'selected'; ?>><?php echo $row->sub_district_name; ?></option>
                                                        <?php
                                                        endforeach;
                                                    endif;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="applicant_gender">Select
                                            Sub District</label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="applicant_gender" name="applicant_gender" class="form-control">
                                                <option value="">Please Select Gender</option>
                                                <option
                                                    value="Male" <?php //if($applicant_gender_selected == 'Male') echo 'selected'; ?>>
                                                    পুরুষ
                                                </option>
                                                <option
                                                    value="Female" <?php //if($applicant_gender_selected == 'Female') echo 'selected'; ?>>
                                                    মহিলা
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                               for="applicant_NID">NID</label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="applicant_NID" name="applicant_NID"
                                                   placeholder="National ID Number"
                                                   value="<?php if ($applicant_NID != '') echo $applicant_NID; ?>"
                                                   class="form-control col-md-6 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_date">From
                                            Date</label>

                                        <div class="col-md-2 col-sm-3 col-xs-12">
                                            <input id="from_date" name="from_date" placeholder="Select From Date"
                                                   value="<?php if ($from_date != '') echo $from_date; ?>"
                                                   class="date-picker form-control col-md-6 col-xs-12" type="text">
                                        </div>
                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="to_date">To
                                            Date</label>

                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input id="to_date" name="to_date" placeholder="Select To Date"
                                                   value="<?php if ($to_date != '') echo $to_date; ?>"
                                                   class="date-picker form-control col-md-6 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <a type="button" href="<?php echo base_url() ?>admin/show/applicants"
                                               class="btn btn-danger">Reset</a>
                                            <button type="submit" class="btn btn-success">Search</button>
                                            <button type="submit" class="btn btn-info" name="print_list"
                                                    formtarget="_blank">Print List
                                            </button>
                                            <a id="report_app_list" class="btn btn-warning" name="report_app_list"
                                               formtarget="_blank">Report for Applicant List</a>
                                            <a id="report_app_details" class="btn btn-dark" name="report_app_list"
                                               formtarget="_blank">Report For Applicant Details</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $data_list_title; ?></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php if (isset($all_applicants) && !is_null($all_applicants)) : ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Applicant Name</th>
                                            <th>Applicant Mobile</th>
                                            <th>District Name</th>
                                            <th>Sub District Name</th>
                                            <th>Applicant Village</th>
                                            <th>Course Name</th>
                                            <th>Course Type</th>
                                            <th>Venue</th>
                                            <th>Applicant Photo</th>
                                            <th>Applicant NID</th>
                                            <th>Apply Date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($all_applicants->result() as $row): ?>
                                            <?php $applicant_is_enrolled = $row->applicant_is_enrolled; ?>
                                            <?php $applicant_is_passed = $row->applicant_is_passed; ?>
                                            <?php $applicant_is_trashed = $row->applicant_is_trashed; ?>
                                            <?php if (!$applicant_is_trashed): ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="applicantList"
                                                               class="applicantList"
                                                               id="appid<?php echo $row->applicant_id ?>"
                                                               value="<?php echo $row->applicant_id ?>">
                                                    </td>
                                                    <td><?php echo $row->applicant_name; ?></td>
                                                    <td><?php echo $row->applicant_mobile; ?></td>
                                                    <td><?php echo $row->district_name; ?></td>
                                                    <td><?php echo $row->sub_district_name; ?></td>
                                                    <td><?php echo $row->applicant_village; ?></td>
                                                    <td><?php echo $row->course_name; ?></td>
                                                    <td><?php echo $row->course_type; ?></td>
                                                    <td><?php echo $row->course_venue; ?></td>
                                                    <td style="text-align: center">
                                                        <img class="img-thumb" height="45px" width="45px"
                                                             src="<?php echo base_url(); ?>uploaded/applicants_photo/<?php echo $row->applicant_photo ? $row->applicant_photo : 'blank_person.png'; ?>"
                                                             alt="<?php echo $row->applicant_photo; ?>"/>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <a href="<?php echo base_url(); ?>uploaded/applicants_photo/<?php echo $row->applicant_NID_image; ?>"
                                                           target="_blank" title="Download NID">
                                                            <img class="img-thumb" height="45px" width="45px"
                                                                 src="<?php echo base_url(); ?>uploaded/applicants_photo/<?php echo $row->applicant_NID_image ? $row->applicant_NID_image : 'blank_person.png'; ?>"
                                                                 alt="<?php echo $row->applicant_NID_image; ?>"/>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: center"><?php echo $row->application_date; ?></td>
                                                    <td style="text-align: right">
                                                        <?php if ($applicant_is_passed) : ?>
                                                            <a class="btn btn-xs btn-danger" title="Delete"
                                                               href="<?php echo base_url(); ?>admin/applicant/delete/<?php echo base64_encode($row->applicant_id); ?>"
                                                               role="button">
                                                                <span class="glyphicon glyphicon-trash"></span> Remove
                                                            </a>
                                                        <?php else : ?>
                                                            <?php if ($applicant_is_enrolled) : ?>
                                                                <div class="btn-group btn-group-xs" role="group"
                                                                     aria-label="...">
                                                                    <a class="btn btn-xs btn-warning" title="Withdraw"
                                                                       href="<?php echo base_url(); ?>admin/applicant/withdraw/<?php echo base64_encode($row->applicant_id); ?>"
                                                                       role="button">
                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                        Withdraw
                                                                    </a>
                                                                    <a class="btn btn-xs btn-primary" title="Passed"
                                                                       href="<?php echo base_url(); ?>admin/applicant/passed/<?php echo base64_encode($row->applicant_id); ?>"
                                                                       role="button">
                                                                        <span class="glyphicon glyphicon-ok"></span>
                                                                        Passed
                                                                    </a>
                                                                </div>
                                                            <?php else : ?>
                                                                <a class="btn btn-xs btn-success" title="Enroll"
                                                                   href="<?php echo base_url(); ?>admin/applicant/enroll/<?php echo base64_encode($row->applicant_id); ?>"
                                                                   role="button">
                                                                    <span class="glyphicon glyphicon-education"></span>
                                                                    Enroll
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="">No Applicant Found</td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <div class="alert alert-danger text-center">No result found</div>
                                <?php endif; ?>
                                <?php echo isset($pagination) ? $pagination : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>