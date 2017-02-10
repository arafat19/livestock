<body class="nav-md">
<div class="container body">
    <div class="main_containerFull">
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <!--<div class="page-title">
                    <div class="title_left">
                        <h3><?php /*echo $form_top_title; */ ?></h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        </div>
                    </div>
                </div>-->
                <div class="row headerArea">
                    <div class="col-md-2 col-xs-12"><img class="img-responsive avatar-view"
                                                         src="<?php echo base_url(); ?>images/blri.png" alt=""
                                                         title=""/></div>
                    <div class="col-md-10 col-xs-12"><h1><?php echo $title; ?></h1>
                        <hr/>
                        <span><?php echo $site_address; ?></span>
                    </div>
                </div>
                <br/>
                <div class="clearfix"></div>
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="row align-right">
                               <!-- <a href="<?php /*echo base_url(); */?>home/confirm/application/pdf/<?php /*echo base64_encode($single_applicant['applicant_id']); */?>"
                                   class="btn btn-dark purple" target="_blank"><i
                                        class="fa fa-print"></i></a>
                                <a href="javascript:window.print();"
                                   class="btn btn-dark purple"><i
                                        class="fa fa-print"></i></a>-->
                                <a href="<?php echo base_url().$applicant_application_form_url; ?>"
                                   class="btn btn-dark purple" target="_blank"><i
                                        class="fa fa-print"></i></a>
                            </div>
                            <div class="x_title">
                                <h3>
                                    <?php echo $online_application . ' ' . $confirmation; ?>

                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php
                                if ($this->session->flashdata('applicant_create_success_message')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('applicant_create_success_message'); ?></strong>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="form-group form-md-line-input has-danger">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <form method="post"
                                                  enctype="multipart/form-data" novalidate>
                                            <span class="section"><h4
                                                    class="text-center"><?php echo $application_for_training . ' ' . $confirmation; ?></h4></span>

                                                <div class="row">
                                                    <div class="col-md-8 col-xs-8 col-sm-3">
                                                        <table class="table-responsive align-left">
                                                            <tr>
                                                                <td><?php echo $application_subject; ?>
                                                                    :&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['course_name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $applicant_type; ?>
                                                                    : </td>
                                                                <td><?php echo $single_applicant['applicant_type'] == 'Farmer' ? $farmer: $entrepreneur; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <?php if($single_applicant['applicant_type'] == 'Farmer') {?>
                                                            <tr>
                                                                <td><?php echo $farmer_desc; ?>
                                                                    : </td>
                                                                <td><?php echo $single_applicant['farmer_desc']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <td><?php echo $applicant_name; ?>:&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['applicant_name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $applicant_father_name; ?>
                                                                    :&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['applicant_father_name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $applicant_date_of_birth; ?>
                                                                    :&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['applicant_date_of_birth']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $applicant_gender; ?>
                                                                    :&nbsp;&nbsp;</td>
                                                                <td><?php if($single_applicant['applicant_gender'] == 'Male'){ $applicant_gender = $male; } else{$applicant_gender = $female;} echo $applicant_gender; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $national_id_no; ?>:&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['applicant_NID']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $mobile_number; ?>:&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['applicant_mobile']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $village; ?>:&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['applicant_village']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $post_office; ?>:&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['applicant_post_office']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $district; ?>:&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['district_name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $union; ?>:&nbsp;&nbsp;</td>
                                                                <td><?php echo $single_applicant['sub_district_name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>

                                                        </table>

                                                    </div>

                                                    <div class="col-md-4 col-xs-4 col-sm-3">
                                                        <table class="table-responsive align-right">
                                                            <tr>
                                                                <!--                                                            <td>-->
                                                                <?php //echo $your_photo; ?><!--:&nbsp;&nbsp;</td>-->
                                                                <td><img class="img-thumb" height="142px" width="114px"
                                                                         src="<?php echo base_url(); ?>uploaded/applicants_photo/<?php echo $single_applicant['applicant_photo'] ?$single_applicant['applicant_photo'] : 'pdfdimga.png'; ?>"
                                                                         alt="<?php echo $single_applicant['applicant_photo']; ?>"/>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="ln_solid" id="ln_solid"></div>
                                                <input type="hidden" value="1" name="finally_submitted"/>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <a href="<?php echo base_url(); ?>"
                                                           class="btn btn-primary"><?php echo $cancel; ?></a>
                                                        <a href="<?php echo base_url(); ?>home/edit/applicant/data/<?php echo base64_encode($single_applicant['applicant_id']); ?>"
                                                           class="btn btn-warning"><?php echo $edit; ?></a>
                                                        <button id="send_submit_btn" type="submit" name="confirm_submit"
                                                                class="btn btn-success"><?php echo $confirmation; ?></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div
            <!-- /page content -->