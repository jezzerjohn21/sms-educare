<style>
    .hidden-input {
      visibility: hidden;
      position: absolute;
    }
  </style>
  
 






<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="<?php echo e(route('admin.offline_admission.create')); ?>">
        <?php echo csrf_field(); ?> 
        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="name" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('First Name')); ?></label>
            <div class="col-sm-10 col-md-9 col-lg-10">
                <input type="text" class="form-control" id="firstName" required>
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="name" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('MI')); ?></label>
            <div class="col-sm-10 col-md-9 col-lg-10">
                <input type="text" class="form-control" id="middleName">
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="name" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Last Name')); ?></label>
            <div class="col-sm-10 col-md-9 col-lg-10">
                <input type="text" class="form-control" id="lastName" required>
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            
            <div class="col-sm-10 col-md-9 col-lg-10">
                <input type="text" class="form-control eForm-control hidden-input" id="fullName" readonly name="name">
            </div>
        </div>


        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="email"
                class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Email')); ?></label>
            <div class="col-sm-10 col-md-9 col-lg-10">
                <input type="email" class="form-control eForm-control" id="email" name="email" required>
            </div>
        </div>
        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="password"
                class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Password')); ?></label>
            <div class="col-sm-10 col-md-9 col-lg-10">
                <input type="password" class="form-control eForm-control" id="password" name="password" required>
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="class_id" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Class')); ?></label>
            <div class="col-md-10">
                <select name="class_id" id="class_id" class="form-select eForm-select eChoice-multiple-with-remove" required onchange="classWiseSection(this.value)">
                    <option value=""><?php echo e(get_phrase('Select a class')); ?></option>
                    <?php $__currentLoopData = $data['classes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="section_id" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Section')); ?></label>
            <div class="col-md-10" id = "section_content">
                <select name="section_id" id="section_id" class="form-select eForm-select eChoice-multiple-with-remove" required >
                    <option value=""><?php echo e(get_phrase('Select section')); ?></option>
                </select>
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="birthdatepicker" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Birthday')); ?><span class="required"></span></label>
            <div class="col-md-10">
                <input type="text" class="form-control eForm-control" id="eInputDate" name="eDefaultDateRange" value="<?php echo e(date('m/d/Y')); ?>" />
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="gender" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Sex')); ?></label>
            <div class="col-md-10">
                <select name="gender" id="gender" class="form-select eForm-select eChoice-multiple-with-remove"  required>
                    <option value=""><?php echo e(get_phrase('Select sex')); ?></option>
                    <option value="Male"><?php echo e(get_phrase('Male')); ?></option>
                    <option value="Female"><?php echo e(get_phrase('Female')); ?></option>
                   
                </select>
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="blood_group" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Blood type *')); ?></label>
            <div class="col-md-10">
                <select name="blood_group" id="blood_group" class="form-select eForm-select eChoice-multiple-with-remove">
                    <option value=""><?php echo e(get_phrase('Select a blood group *optional')); ?></option>
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
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="address" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Address')); ?></label>
            <div class="col-md-10">
                <textarea class="form-control eForm-control" id="address" rows="4" name = "address" required></textarea>
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="phone" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Phone')); ?></label>
            <div class="col-md-10">
                <input type="text" id="phone" name="phone" class="form-control eForm-control" required>
            </div>
        </div>

        <div class="row fmb-14 justify-content-between align-items-center">
            <label for="photo" class="col-sm-2 col-eForm-label"><?php echo e(get_phrase('Student profile image')); ?></label>
            <div class="col-md-10">
                <input class="form-control eForm-control-file" type="file" id="photo" name="photo" accept="image/*">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn-form"><?php echo e(get_phrase('Add Student')); ?></button>
            </div>
        </div>
    </form>
</div>

<script>
    // Get input elements
    var firstName = document.getElementById('firstName');
    var middleName = document.getElementById('middleName');
    var lastName = document.getElementById('lastName');
    var fullName = document.getElementById('fullName');
    
    // Add input event listeners to firstName, middleName, lastName
    firstName.addEventListener('input', combineInputs);
    middleName.addEventListener('input', combineInputs);
    lastName.addEventListener('input', combineInputs);
    
    // Function to combine input values and update the fullName input
    function combineInputs() {
      var combinedValue = firstName.value + " " + middleName.value + " " + lastName.value;
      fullName.value = combinedValue.trim();
    }
    </script>

<?php /**PATH /home/u523039989/domains/educareschoolhouse.online/public_html/sms-educare/resources/views/admin/offline_admission/single_student_admission.blade.php ENDPATH**/ ?>