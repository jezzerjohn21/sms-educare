<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="<?php echo e(route('admin.teacher.update', ['id' => $user->id])); ?>">
         <?php echo csrf_field(); ?> 
        <div class="form-row">
            <div class="fpb-7">
                <label for="name" class="eForm-label"><?php echo e(get_phrase('Full Name *fname,mi,lname ')); ?></label>
                <input type="text" class="form-control eForm-control" value="<?php echo e($user->name); ?>" id="name" name = "name" required>
            </div>

            <div class="fpb-7">
                <label for="email" class="eForm-label"><?php echo e(get_phrase('Email')); ?></label>
                <input type="email" class="form-control  eForm-control" value="<?php echo e($user->email); ?>" id="email" name = "email" required>
            </div>
            <?php 
            $info = json_decode($user->user_information);
            ?>

            <div class="fpb-7">
                <label for="department_id" class="eForm-label"><?php echo e(get_phrase("Department")); ?></label>
                <select name="department_id" id="department_id" class="form-select eForm-select eChoice-multiple-with-remove" required>
                    <option value=""><?php echo e(get_phrase("Select a department")); ?></option>
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>" <?php echo e($department['id'] == $user->department_id ?  'selected':''); ?>><?php echo e($department->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="fpb-7">
                <label for="designation" class="eForm-label"><?php echo e(get_phrase('Designation')); ?></label>
                <input type="text" class="form-control eForm-control" value="<?php echo e($user->designation); ?>" id="designation" name = "designation" required>
            </div>

            <div class="fpb-7">
                <label for="birthday" class="eForm-label"><?php echo e(get_phrase('Birthday')); ?><span class="required"></span></label>
                <input type="text" class="form-control eForm-control inputDate" id="birthday" name="birthday" value="<?php echo e(date('m/d/Y', $info->birthday)); ?>" />
                </div>
            </div>

            <div class="fpb-7">
                <label for="gender" class="eForm-label"><?php echo e(get_phrase('Gender')); ?></label>
                <select name="gender" id="gender" class="form-select eForm-select eChoice-multiple-with-remove"  required>
                    <option value=""><?php echo e(get_phrase('Select gender')); ?></option>
                    <option value="Male" <?php echo e($info->gender == 'Male' ?  'selected':''); ?> ><?php echo e(get_phrase('Male')); ?></option>
                    <option value="Female" <?php echo e($info->gender == 'Female' ?  'selected':''); ?>><?php echo e(get_phrase('Female')); ?></option>
                    <option value="Others" <?php echo e($info->gender == 'Others' ?  'selected':''); ?>><?php echo e(get_phrase('Others')); ?></option>
                </select>
            </div>
            <div class="fpb-7">
                <label for="phone" class="eForm-label"><?php echo e(get_phrase('Phone number')); ?></label>
                <input type="text" class="form-control  eForm-control" value="<?php echo e($info->phone); ?>" id="phone" name = "phone" required>
            </div>
            <div class="fpb-7">
                <label for="blood_group" class="eForm-label"><?php echo e(get_phrase('Blood group')); ?></label>
                <select name="blood_group" id="blood_group" class="form-select eForm-control">
                    <option value=""><?php echo e(get_phrase('Select a blood group')); ?></option>
                    <option value="a+" <?php echo e($info->blood_group == 'a+' ?  'selected':''); ?> ><?php echo e(get_phrase('A+')); ?></option>
                    <option value="a-" <?php echo e($info->blood_group == 'a-' ?  'selected':''); ?> ><?php echo e(get_phrase('A-')); ?></option>
                    <option value="b+" <?php echo e($info->blood_group == 'b+' ?  'selected':''); ?> ><?php echo e(get_phrase('B+')); ?></option>
                    <option value="b-" <?php echo e($info->blood_group == 'b-' ?  'selected':''); ?> ><?php echo e(get_phrase('B-')); ?></option>
                    <option value="ab+" <?php echo e($info->blood_group == 'ab+' ?  'selected':''); ?> ><?php echo e(get_phrase('AB+')); ?></option>
                    <option value="ab-" <?php echo e($info->blood_group == 'ab-' ?  'selected':''); ?> ><?php echo e(get_phrase('AB-')); ?></option>
                    <option value="o+" <?php echo e($info->blood_group == 'o+' ?  'selected':''); ?> ><?php echo e(get_phrase('O+')); ?></option>
                    <option value="o-" <?php echo e($info->blood_group == 'o-' ?  'selected':''); ?> ><?php echo e(get_phrase('O-')); ?></option>
                </select>
            </div>

            <div class="fpb-7">
                <label for="address" class="eForm-label"><?php echo e(get_phrase('Address')); ?></label>
                <textarea class="form-control eForm-control" id="address" name = "address" rows="5" required>><?php echo e($info->address); ?></textarea>
            </div>

            <div class="fpb-7">
              <label for="formFile" class="eForm-label"
                ><?php echo e(get_phrase('Photo')); ?></label
              >
              <input
                class="form-control eForm-control-file"
                id="photo" name="photo" accept="image/*"
                type="file"
              />
            </div>

            <div class="form-group mt-2 col-md-12">
                <button class="btn-form" type="submit"><?php echo e(get_phrase('Update')); ?></button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    "use strict";
    $(document).ready(function () {
      $(".eChoice-multiple-with-remove").select2();
    });

    $(function () {
      $('.inputDate').daterangepicker(
        {
          singleDatePicker: true,
          showDropdowns: true,
          minYear: 1901,
          maxYear: parseInt(moment().format("YYYY"), 10),
        },
        function (start, end, label) {
          var years = moment().diff(start, "years");
        }
      );
    });
</script><?php /**PATH /home/u523039989/domains/educareschoolhouse.online/public_html/sms-educare/resources/views/admin/teacher/edit_teacher.blade.php ENDPATH**/ ?>