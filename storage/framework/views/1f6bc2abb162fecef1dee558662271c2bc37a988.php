<?php 

use App\Models\Subject;
use App\Models\Session;
use App\Models\Gradebook;

$active_session = get_school_settings(auth()->user()->school_id)->value('running_session');

$index = 0;

?>


   
<?php $__env->startSection('content'); ?>
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4><?php echo e(get_phrase('View Marks')); ?></h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#"><?php echo e(get_phrase('Home')); ?></a></li>
                        <li><a href="#"><?php echo e(get_phrase('Examination')); ?></a></li>
                        <li><a href="#"><?php echo e(get_phrase('Marks')); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="eSection-wrap">
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
                    <a class="dropdown-item" id="pdf" href="javascript:;" onclick="generatePDF()"><?php echo e(get_phrase('PDF')); ?></a>
                </li>
                <li>
                    <a class="dropdown-item" id="print" href="javascript:;" onclick="ePrintDiv('mark_report')"><?php echo e(get_phrase('Print')); ?></a>
                </li>
              </ul>
            </div>
            <div class="view_mark" id="mark_report">
                <table class="table eTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(get_phrase('Subject name')); ?></td>
                            <?php $__currentLoopData = $exam_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <th><?php echo e($exam_category->name); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index = $index+1); ?></td>
                            <td><?php echo e($subject->name); ?></td>
                            <?php $__currentLoopData = $exam_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <td>
                                <?php 
                                $exam_marks = Gradebook::where('exam_category_id', $exam_category['id'])
                                    ->where('class_id', $student_details['class_id'])
                                    ->where('section_id', $student_details['section_id'])
                                    ->where('student_id', $student_details['user_id'])
                                    ->where('school_id', auth()->user()->school_id)
                                    ->where('session_id', $active_session)
                                    ->first();

                                    if(isset($exam_marks->marks) && $exam_marks->marks){
                                        $subject_list = json_decode($exam_marks->marks, true);
                                    }else{
                                        $subject_list = array();
                                    }
                                ?>
                                <?php if(is_array($subject_list)): ?>
                                    <?php if(array_key_exists($subject->id, $subject_list)): ?>
                                        <?php echo e($subject_list[$subject->id]); ?>

                                    <?php else: ?>
                                        <?php echo e("-"); ?>

                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<script type="text/javascript">

  "use strict";

    function ePrintDiv(ePrintDivId) {
        var printContents = document.getElementById(ePrintDivId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    function generatePDF() {

        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("mark_report");

        // clone the element
        var clonedElement = element.cloneNode(true);

        // change display of cloned element 
        $(clonedElement).css("display", "block");

        // Choose the clonedElement and save the PDF for our user.

        var opt = {
          margin:       1,
          filename:     'Mark report.pdf',
          image:        { type: 'jpeg', quality: 0.98 },
          html2canvas:  { scale: 2 }
        };

        // New Promise-based usage:
        html2pdf().set(opt).from(clonedElement).save();

        // remove cloned element
        clonedElement.remove();
    }
</script>
<?php echo $__env->make('student.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\fernandez\Ekattor8\resources\views/student/marks/index.blade.php ENDPATH**/ ?>