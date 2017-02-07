<!-- footer content -->
<div class="footer">
    <footer>
        <div class="pull-right">
            পরিকল্পনা ও বাস্তবায়নে:<?php echo ' ' . $footer_title;; ?>
        </div>
        <div class="clearfix"></div>
    </footer>
</div>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<!--<script src="--><?php //echo base_url(); ?><!--js/jquery.min.js"></script>-->
<script src="<?php echo base_url(); ?>js/jquery-1.12.4.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>js/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo base_url(); ?>js/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url(); ?>js/bootstrap-progressbar.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>js/icheck.js"></script>

<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url(); ?>js/moment.min.js"></script>
<!--<script src="--><?php //echo base_url(); ?><!--js/daterangepicker.js"></script>-->

<script src="<?php echo base_url(); ?>framework/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>framework/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="<?php echo base_url(); ?>js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>js/jszip.js"></script>
<script src="<?php echo base_url(); ?>js/pdfmake.js"></script>
<script src="<?php echo base_url(); ?>js/vfs_fonts.js"></script>

<!---->
<script src="<?= base_url() ?>js/jquery-ui.js"></script>

<script type="text/javascript">
    $( function() {
        $( "#course_start_date" ).datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2030"

            /*  onSelect: function(date) {

             var dateSplit = date.split("-");
             var dob = new Date(dateSplit[1] + " " + dateSplit[0] + " " + dateSplit[2]);
             var today = new Date();
             if (dob.getFullYear() + 18 > today.getFullYear())
             {
             alert("You must be atleast 18 years old.");
             $(".dob").val("");
             }
             }*/
        });
        $( "#course_end_date" ).datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2030"
        });

        $( "#from_date" ).datepicker({
            dateFormat: "yy-m-d",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2030"
        });
        $( "#to_date" ).datepicker({
            dateFormat: "yy-m-d",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2030"
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#district_ids').on("change", function () {
            var districtId = $(this).find('option:selected').val();
            $.ajax({
                url: "<?php echo base_url();?>admin/show/sub/district",
                type: "POST",
                data: "districtId=" + districtId,
                success: function (response) {
                    console.log(response);
                    $("#sub_district_ids").html(response);
                }
            });
        });

        $('#course_type').on("change", function () {
            var course_type = $(this).find('option:selected').val();
            $.ajax({
                url: "<?php echo base_url();?>admin/show/course",
                type: "POST",
                data: "course_type=" + course_type,
                success: function (response) {
                    console.log(response);
                    $("#course_id").html(response);
                }
            });
        });

    });

</script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url(); ?>js/custom.min.js"></script>
<!-- Datatables -->
<script>
    $(document).ready(function () {
        var handleDataTableButtons = function () {
            //if ($("#datatable-buttons").length) {
                var table = $("#datatable-buttons").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdf",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },

                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: 'print',
                            text: 'Print all',
                            className: "btn-sm"
                        },

                        {
                            text: 'Report for Applicant List',
                            className: "btn-sm",
                            action: function ( e, dt, node, config ) {
                                reportAppList();
                            }
                        },
                        {
                            text: 'Report For Applicant Details',
                            className: "btn-sm",
                            action: function ( e, dt, node, config ) {
                                reportApplicant();
                            }
                        }
                    ],
                    responsive: true
                });
            //}
        };

        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons();
                }
            };
        }();


        /*$(document).ready(function() {
            $('#datatable-buttons').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'My button',
                        action: function ( e, dt, node, config ) {
                            alert( 'Button activated' );
                        }
                    }
                ]
            } );
        } );*/

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
            keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });

        $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
            'order': [[1, 'asc']],
            'columnDefs': [
                {orderable: false, targets: [0]}
            ]
        });

        $datatable.on('draw.dt', function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });
        });

        TableManageButtons.init();
    });
    
    $('#report_app_list').click(function(){
       reportAppList();
    });
    
    $('#report_app_details').click(function(){
       reportApplicant();
    });

    function reportAppList(){
        var arr = [];
        var  base_url = '<?php echo base_url(); ?>';
        
        $("input:checkbox[name=applicantList]:checked").each(function(){
            arr.push($(this).val());
        });

        if(arr.length == 0){
            alert("Please check at least one applicant");
        }else{
           $.ajax({
                url: '<?php echo site_url();?>report/reportAppList',
                type: 'POST',
                data: {listArr:arr},
                dataType: 'JSON',
                beforeSend: function (jqXHR, textStatus, errorThrown) {
                   //abortAjax(jqXHR);
                },
                success: function (data_st, textStatus) {
                    
                    var str = data_st.responseText;
                    var data = str.match(/\{.+?\}/g).map(function(x){return x.slice(1,-1)});
                    var split = data[0].split(":");
                    console.log('applicant_list' + split[1]);
                    console.log(data[0]);
                    window.open(base_url+'uploaded/downloads/reports/'+'applicants_list_'+split[1]+'.pdf', '_blank');
                },
                complete: function(data_st)
                {
                    var str = data_st.responseText;
                    var data = str.match(/\{.+?\}/g).map(function(x){return x.slice(1,-1)});
                    var split = data[0].split(":");
                    console.log('applicant_list' + split[1]);
                    console.log(str);
                    window.open(base_url+'uploaded/downloads/reports/'+'applicants_list_'+split[1]+'.pdf', '_blank');
                }
            }); 
        }
        
    }

    function reportApplicant(){
        var arr = [];
        var  base_url = '<?php echo base_url(); ?>';
        
        $("input:checkbox[name=applicantList]:checked").each(function(){
            arr.push($(this).val());
        });

        if(arr.length == 0){
            alert("Please check at least one applicant");
        }else{
           $.ajax({
                url: '<?php echo site_url();?>report/reportApplicant',
                type: 'POST',
                data: {listArr:arr},
                dataType: 'JSON',
                beforeSend: function (jqXHR, textStatus, errorThrown) {
                   //abortAjax(jqXHR);
                },
                success: function (data_st, textStatus) {
                    
                    var str = data_st.responseText;
                    var data = str.match(/\{.+?\}/g).map(function(x){return x.slice(1,-1)});
                    var split = data[0].split(":");
                    console.log('applicant_details_list_' + split[1]);
                    window.open(base_url+'uploaded/downloads/reports/'+'applicant_details_list_'+split[1]+'.pdf', '_blank');
                },
                complete: function(data_st)
                {
                    var str = data_st.responseText;
                    var data = str.match(/\{.+?\}/g).map(function(x){return x.slice(1,-1)});
                    var split = data[0].split(":");
                    console.log('applicant_details_list_' + split[1]);
                    window.open(base_url+'uploaded/downloads/reports/'+'applicant_details_list_'+split[1]+'.pdf', '_blank');
                }
            }); 
        }
    }
</script>
<!-- /Datatables -->

</body>
