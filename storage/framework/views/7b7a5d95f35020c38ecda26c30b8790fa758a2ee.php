<?php

use App\Models\User;
use App\Models\Subject;
use App\Models\Gradebook;
use App\Models\Grade;

?>

<div
  class="att-report-banner d-flex justify-content-center justify-content-md-between align-items-center flex-wrap"
>
  <div class="att-report-summary order-1">
    <h4 class="title"><?php echo e(get_phrase('Manage marks')); ?></h4>
    <p class="summary-item"><?php echo e(get_phrase('Class')); ?> : <span><?php echo e($page_data['class_name']); ?></span></p>
    <p class="summary-item"><?php echo e(get_phrase('Section')); ?> : <span><?php echo e($page_data['section_name']); ?></span></p>
    <p class="summary-item"><?php echo e(get_phrase('Subject')); ?> : <span><?php echo e($page_data['subject_name']); ?></span>
    </p>
  </div>
  <div class="att-banner-img order-0 order-md-1">
    <img
      src="<?php echo e(asset('public/assets/images/attendance-report-banner.png')); ?>"
      alt=""
    />
  </div>
</div>

<?php if(count($enroll_students) > 0): ?>
<div class="export position-relative">
  <button class="eBtn-3 dropdown-toggle float-end mb-4" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
    <span class="pr-10">
      <svg xmlns="http://www.w3.org/2000/svg" width="12.31" height="10.77" viewBox="0 0 10.771 12.31">
        <path id="arrow-right-from-bracket-solid" d="M3.847,1.539H2.308a.769.769,0,0,0-.769.769V8.463a.769.769,0,0,0,.769.769H3.847a.769.769,0,0,1,0,1.539H2.308A2.308,2.308,0,0,1,0,8.463V2.308A2.308,2.308,0,0,1,2.308,0H3.847a.769.769,0,1,1,0,1.539Zm8.237,4.39L9.007,9.007A.769.769,0,0,1,7.919,7.919L9.685,6.155H4.616a.769.769,0,0,1,0-1.539H9.685L7.92,2.852A.769.769,0,0,1,9.008,1.764l3.078,3.078A.77.77,0,0,1,12.084,5.929Z" transform="translate(0 12.31) rotate(-90)" fill="#00a3ff"></path>
      </svg>
    </span>
    <?php echo e(get_phrase('Export')); ?>

  </button>
  <ul class="dropdown-menu dropdown-menu-end eDropdown-menu-2">
    <li>
        <a class="dropdown-item" id="pdf" href="javascript:;" onclick="Export()"><?php echo e(get_phrase('PDF')); ?></a>
    </li>
    <li>
        <a class="dropdown-item" id="print" href="javascript:;" onclick="printableDiv('mark_report')"><?php echo e(get_phrase('Print')); ?></a>
    </li>
  </ul>
</div>
<?php endif; ?>

<?php if(count($enroll_students) > 0): ?>
<div class="mark_report_content" id="mark_report">
    <table class="table eTable table-bordered">
        <thead>
            <tr>
                <th scope="col"><?php echo e(get_phrase('Student name')); ?></td>
                <th scope="col"><?php echo e(get_phrase('(Input Grade)')); ?></td>
                
                
                <th scope="col"><?php echo e(get_phrase('Action')); ?></td>
            </tr>   
        </thead>
        <tbody>
            <?php $__currentLoopData = $enroll_students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enroll_student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php

                $student_details = User::find($enroll_student->user_id);
                $filterd_data = Gradebook::where('exam_category_id', $page_data['exam_category_id'])
                ->where('class_id', $page_data['class_id'])
                ->where('section_id', $page_data['section_id'])
                ->where('student_id', $enroll_student->user_id);

                if($filterd_data->value('marks')){
                    $subject_mark = json_decode($filterd_data->value('marks'), true);
                    if(!empty($subject_mark[$page_data['subject_id']])) {
                        $user_marks = $subject_mark[$page_data['subject_id']];
                    } else {
                        $user_marks = 0;
                    }


                } else {
                    $user_marks = 0;
                }

                if($filterd_data->value('comment')){
                    $comment = $filterd_data->value('comment');
                } else {
                    $comment = '';
                }

                ?>
                <tr>
                    <td><?php echo e($student_details->name); ?></td>
                    <td>
                        <input class="form-control eForm-control" type="number" id="mark-<?php echo e($enroll_student->user_id); ?>" name="mark" placeholder="mark" min="0" value="<?php echo e($user_marks); ?>" required onchange="get_grade(this.value, this.id)">
                    </td>
                    
                    
                    <td class="text-center">
                        <button class="btn btn-success" onclick="mark_update('<?php echo e($enroll_student->user_id); ?>')"><i class="bi bi-check2-circle"></i></button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="empty_box center">
    <img class="mb-3" width="150px" src="<?php echo e(asset('public/assets/images/empty_box.png')); ?>" />
    <br>
    <span class=""><?php echo e(get_phrase('No data found')); ?></span>
</div>
<?php endif; ?>

<script type="text/javascript">

  "use strict";

    function mark_update(student_id){
        var class_id = '<?php echo e($page_data['class_id']); ?>';
        var section_id = '<?php echo e($page_data['section_id']); ?>';
        var subject_id = '<?php echo e($page_data['subject_id']); ?>';
        var exam_category_id = '<?php echo e($page_data['exam_category_id']); ?>';
        var mark = $('#mark-' + student_id).val();
        // var comment = $('#comment-' + student_id).val();
        if(subject_id != ""){
            $.ajax({
                type : 'GET',
                url : "<?php echo e(route('update.mark')); ?>",
                data : {student_id : student_id, class_id : class_id, section_id : section_id, subject_id : subject_id, exam_category_id : exam_category_id, mark : mark},
                success : function(response){
                    toastr.success('<?php echo e(get_phrase('Value has been updated successfully')); ?>');
                }
            });
        }else{
            toastr.error('<?php echo e(get_phrase('Required mark field')); ?>');
        }
    }

    function get_grade(exam_mark, id){
        let url = "<?php echo e(route('get.grade', ['exam_mark' => ":exam_mark"])); ?>";
        url = url.replace(":exam_mark", exam_mark);
        console.log(url);
        $.ajax({
            url : url,
            success : function(response){
                $('#grade-for-'+id).text(response);
            }
        });
    }

    function Export() {
        html2canvas(document.getElementById('mark_report'), {
            onrendered: function(canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("mark_report.pdf");
            }
        });
    }

    function printableDiv(printableAreaDivId) {
        var printContents = document.getElementById(printableAreaDivId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

</script><?php /**PATH /home/u523039989/domains/educareschoolhouse.online/public_html/sms-educare/resources/views/admin/marks/marks_list.blade.php ENDPATH**/ ?>