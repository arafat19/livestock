<body class="nav-md">
<script language="javascript">
    function checkMe() {
        if (confirm("Are you sure you want to delete the selected Instructor?")) {
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

                <!-- menu profile quick info -->
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
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <?php $this->load->view('admin/admin_dashboard_navbar_view'); ?>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <!--<div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>-->
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <?php $this->load->view('admin/admin_dashboard_top_nevigation_view'); ?>
        <!-- /top navigation -->
        <!-- page content -->
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
                                if ($this->session->flashdata('admin_create_instructor_message')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_create_instructor_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_create_instructor_error_message')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_create_instructor_error_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_update_instructor_message')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_update_instructor_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_update_instructor_error_message')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_update_instructor_error_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_delete_instructor_message')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_delete_instructor_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('admin_delete_instructor_error_message')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('admin_delete_instructor_error_message'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('file_errors')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('file_errors'); ?></strong>
                                    </div>
                                <?php }
                                if ($this->session->flashdata('upload_ins_photo_success')) { ?>
                                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><?php echo $this->session->flashdata('upload_ins_photo_success'); ?></strong>
                                    </div>
                                <?php } ?>

                                <br/>

                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                      enctype="multipart/form-data"
                                      method="post">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instructor_name">Trainer
                                            Name<span class="required">*</span>
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="instructor_name"
                                                   id="instructor_name"
                                                   placeholder="Trainer Name" required autofocus/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                               for="instructor_designation">Trainer Designation<span
                                                class="required">*</span>
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" name="instructor_designation"
                                                   id="instructor_designation"
                                                   placeholder="Trainer Designation" required/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                               for="instructor_email">Trainer Email<span
                                                class="required">*</span>
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input class="form-control col-md-7 col-xs-12"
                                                   placeholder="Trainer E-mail" name="instructor_email" type="email"
                                                   id="instructor_email" value=""
                                                   pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                                                   required="required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                               for="instructor_phone_number">Trainer Phone Number<span
                                                class="required">*</span>
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="tel" class="form-control col-md-7 col-xs-12"
                                                   id="instructor_phone_number" name="instructor_phone_number"
                                                   pattern="[0][1-9]{4}[0-9]{6}"
                                                   placeholder="Trainer Mobile Number (Format: 01XXXXXXXXX)"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                               for="instructor_organization">Trainer
                                            Organization<span
                                                class="required">*</span>
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12"
                                                   id="instructor_organization" name="instructor_organization"
                                                   placeholder="Trainer Organization"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userfile">Upload
                                            Photo
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="uploadBtn" name="userfile" type="file"
                                                   class="form-control col-md-7 col-xs-12"/>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">Create</button>
                                            <button type="reset" class="btn btn-primary">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


               <!-- --><?php
/*                require('fpdf.php');

                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',16);
                $pdf->Cell(40,10,'Hello World!');
                $pdf->Output();*/
                ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $data_list_title; ?></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Trainer Name</th>
                                        <th>Trainer Email</th>
                                        <th>Trainer Phone</th>
                                        <th>Trainer Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <?php $i = 1; ?>
                                    <?php if (isset($all_instructors) && $all_instructors->num_rows() > 0): ?>
                                    <tbody>
                                    <?php foreach ($all_instructors->result() as $row):
                                        ?>


                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row->instructor_name; ?></td>
                                            <td><?php echo $row->instructor_email; ?></td>
                                            <td><?php echo $row->instructor_phone_number; ?></td>
                                            <td align="center">
                                                <img class="img-thumb" height="45px" width="45px"
                                                     src="<?php echo base_url(); ?>uploaded/instructors_photo/<?php echo $row->instructor_photo ? $row->instructor_photo : 'blank_person.png'; ?>"
                                                     alt="Image Preview not found!"/>
                                            </td>
                                            <td align="center">
                                                <?php
                                                $course_count = $row->course_count;
                                                if ($course_count > 0) { ?>
                                                    <a class="btn btn-danger" title="Deassign"
                                                       href="<?php echo base_url(); ?>admin/assign/course/to/instructor/<?php echo base64_encode($row->instructor_id); ?>"
                                                       role="button"><span class="glyphicon glyphicon-remove"></span>
                                                        Remove Courses</a>

                                                <?php } else { ?>
                                                    <a class="btn btn-success"
                                                       href="<?php echo base_url(); ?>admin/assign/course/to/instructor/<?php echo base64_encode($row->instructor_id); ?>"
                                                       title="Assign"
                                                       role="button"><span
                                                            class="glyphicon glyphicon-check"></span> Assign Courses</a>

                                                <?php }
                                                ?>

                                                <a class="btn btn-success" title="Edit"
                                                   href="<?php echo base_url(); ?>admin/instructor/update/<?php echo base64_encode($row->instructor_id); ?>"
                                                   role="button"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <a class="btn btn-danger"
                                                   href="<?php echo base_url(); ?>admin/instructor/delete/<?php echo base64_encode($row->instructor_id); ?>"
                                                   onclick="return checkMe()" title="Delete"
                                                   role="button"><span class="glyphicon glyphicon-trash"></span></a>
                                            </td>

                                        </tr>

                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php else: ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info " role="alert">
                                            No Results were found.
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->