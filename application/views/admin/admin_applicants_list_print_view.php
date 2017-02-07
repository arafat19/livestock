<div class="container-fluid">
    <!--<a href="javascript:void(0)" onclick="PrintElem('print_area')">Print</a>-->
    <div id="print_area">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <p><strong>Course Name : </strong><span><?php echo $course_name ?></span></p>
                <p><strong>Venue : </strong><span><?php echo $course_venue ?></span></p>
                <p><strong>Date of Course : </strong><span><?php echo $from_date ?></span>,
                    <strong>Project Type : </strong><span><?php echo $course_type ?></span>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>District</th>
                        <th>Photo</th>
                        <th>Remark</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($all_applicants->result() as $row): ?>
                        <?php $applicant_is_trashed = $row->applicant_is_trashed; ?>
                        <?php if (!$applicant_is_trashed): ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row->applicant_name; ?></td>
                                <td><?php echo $row->applicant_mobile; ?></td>
                                <td><?php echo $row->district_name; ?></td>
                                <td style="text-align: center">
                                    <img class="img-thumb" height="45px" width="45px" src="<?php echo base_url(); ?>uploaded/applicants_photo/<?php echo $row->applicant_photo ? $row->applicant_photo : 'blank_person.png'; ?>" alt="<?php echo $row->applicant_photo; ?>"/>
                                </td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function readTextFile(file) {
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function () {
            if (rawFile.readyState === 4) {
                if (rawFile.status === 200 || rawFile.status == 0) {
                    var allText = rawFile.responseText;
                    alert(allText);
                }
            }
        }
        rawFile.send(null);
    }
    function PrintElem(elem) {
        var css = '<?php echo base_url(); ?>css/bootstrap.min.css';
        alert(readTextFile(css));
        var mywindow = window.open('', 'PRINT');
        mywindow.document.write('<html><head><title>' + document.title + '</title>');
        mywindow.document.write('<style>'+readTextFile(css)+'</style></head><body >');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>