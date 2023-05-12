
   
<?php $__env->startSection('content'); ?>
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4><?php echo e(get_phrase('Manage Marks')); ?></h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#"><?php echo e(get_phrase('Home')); ?></a></li>
                        <li><a href="#"><?php echo e(get_phrase('Grading')); ?></a></li>
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
             <div class="row">
                <div class="row justify-content-md-center">
                    <div class="col-md-2">
                        <select class="form-select eForm-select eChoice-multiple-with-remove" id = "exam_category_id" name="exam_category_id">
                            <option value=""><?php echo e(get_phrase('Select category')); ?></option>
                            <?php $__currentLoopData = $exam_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($exam_category->id); ?>"><?php echo e($exam_category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                        <select name="class_id" id="class_id" class="form-select eForm-select eChoice-multiple-with-remove" required onchange="classWiseSection(this.value)">
                            <option value=""><?php echo e(get_phrase('Select class')); ?></option>
                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($class['id']); ?>"><?php echo e($class['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="section_id" id="section_id" class="form-select eForm-select eChoice-multiple-with-remove" required >
                            <option value=""><?php echo e(get_phrase('First select a class')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="subject_id" id="subject_id" class="form-select eForm-select eChoice-multiple-with-remove" required >
                            <option value=""><?php echo e(get_phrase('First select a class')); ?></option>
                        </select>
                    </div>
                    <div class="col-xl-2 mb-3">
                        <button type="button" class="btn btn-icon btn-secondary form-control" onclick="filter_marks()"><?php echo e(get_phrase('Filter')); ?></button>
                    </div>

                    <div class="card-body marks_content">
                        <div class="empty_box center">
                            <img class="mb-3" width="150px" src="<?php echo e(asset('public/assets/images/empty_box.png')); ?>" />
                            <br>
                            <span class=""><?php echo e(get_phrase('No data found')); ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<script type="text/javascript">

  "use strict";

    function classWiseSection(classId) {
        let url = "<?php echo e(route('class_wise_sections', ['id' => ":classId"])); ?>";
        url = url.replace(":classId", classId);
        $.ajax({
            url: url,
            success: function(response){
                $('#section_id').html(response);
                classWiseSubect(classId);
            }
        });
    }

    function classWiseSubect(classId) {
        let url = "<?php echo e(route('class_wise_subject', ['id' => ":classId"])); ?>";
        url = url.replace(":classId", classId);
        $.ajax({
            url: url,
            success: function(response){
                $('#subject_id').html(response);
            }
        });
    }

    function filter_marks(){
        var exam_category_id = $('#exam_category_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var subject_id = $('#subject_id').val();
        if(exam_category_id != "" &&  class_id != "" && section_id!= "" && subject_id!= ""){
            getFilteredMarks();
        }else{
            toastr.error('<?php echo e(get_phrase('Please select all the fields')); ?>');
        }
    }

    var getFilteredMarks = function() {
        var exam_category_id = $('#exam_category_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var subject_id = $('#subject_id').val();
        if(exam_category_id != "" &&  class_id != "" && section_id!= "" && subject_id!= ""){
            let url = "<?php echo e(route('teacher.marks.list')); ?>";
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {exam_category_id: exam_category_id, class_id : class_id, section_id : section_id, subject_id: subject_id},
                success: function(response){
                    $('.marks_content').html(response);
                }
            });
        }
    }

</script>
<?php echo $__env->make('teacher.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u523039989/domains/educareschoolhouse.online/public_html/sms-educare/resources/views/teacher/marks/index.blade.php ENDPATH**/ ?>