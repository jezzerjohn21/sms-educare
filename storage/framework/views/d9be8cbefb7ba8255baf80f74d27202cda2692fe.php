<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="<?php echo e(route('admin.accountant.create')); ?>">
        <?php echo csrf_field(); ?> 
        <div class="form-row">
            <div class="fpb-7">
                <label for="name" class="eForm-label"><?php echo e(get_phrase('Name')); ?></label>
                <input type="text" class="form-control eForm-control" id="name" name = "name" required>
            </div>

            <div class="fpb-7">
                <label for="email" class="eForm-label"><?php echo e(get_phrase('Email')); ?></label>
                <input type="email" class="form-control eForm-control" id="email" name = "email" required>
            </div>

            <div class="fpb-7">
                <label for="password" class="eForm-label"><?php echo e(get_phrase('Password')); ?></label>
                <input type="password" class="form-control eForm-control" id="password" name = "password" required>
            </div>

            <div class="fpb-7">
                <label for="birthday" class="eForm-label"><?php echo e(get_phrase('Birthday')); ?><span class="required"></span></label>
                <input type="text" class="form-control eForm-control inputDate" id="birthday" name="birthday" value="<?php echo e(date('m/d/Y')); ?>" />
                </div>
            </div>

            <div class="fpb-7">
                <label for="gender" class="eForm-label"><?php echo e(get_phrase('Gender')); ?></label>
                <select name="gender" id="gender" class="form-select eForm-select eChoice-multiple-with-remove"  required>
                    <option value=""><?php echo e(get_phrase('Select gender')); ?></option>
                    <option value="Male"><?php echo e(get_phrase('Male')); ?></option>
                    <option value="Female"><?php echo e(get_phrase('Female')); ?></option>
                    <option value="Others"><?php echo e(get_phrase('Others')); ?></option>
                </select>
            </div>

            <div class="fpb-7">
                <label for="phone" class="eForm-label"><?php echo e(get_phrase('Phone number')); ?></label>
                <input type="text" class="form-control eForm-control" id="phone" name = "phone" required>
            </div>

            <div class="fpb-7">
                <label for="blood_group" class="eForm-label"><?php echo e(get_phrase('Blood group')); ?></label>
                <select name="blood_group" id="blood_group" class="form-select eForm-select eChoice-multiple-with-remove">
                    <option value=""><?php echo e(get_phrase('Select a blood group')); ?></option>
                    <option value="a+"><?php echo e(get_phrase('A+')); ?></option>
                    <option value="a-"><?php echo e(get_phrase('A-')); ?></option>
                    <option value="b+"><?php echo e(get_phrase('B+')); ?></option>
                    <option value="b-"><?php echo e(get_phrase('B-')); ?></option>
                    <option value="ab+"><?php echo e(get_phrase('AB+')); ?></option>
                    <option value="ab-"><?php echo e(get_phrase('AB-')); ?></option>
                    <option value="o+"><?php echo e(get_phrase('O+')); ?></option>
                    <option value="o-"><?php echo e(get_phrase('O-')); ?></option>
                </select>
            </div>

            <div class="fpb-7">
                <label for="phone" class="eForm-label"><?php echo e(get_phrase('Address')); ?></label>
                <textarea class="form-control eForm-control" id="address" name = "address" rows="5" required></textarea>
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

            <div class="fpb-7 pt-2">
                <button class="btn-form" type="submit"><?php echo e(get_phrase('Create')); ?></button>
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
    
</script><?php /**PATH C:\wamp64\www\fernandez\Ekattor8\resources\views/admin/accountant/add_accountant.blade.php ENDPATH**/ ?>