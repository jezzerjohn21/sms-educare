<form action="<?php echo e(route('superadmin.save_valid_purchase_code', 'update')); ?>" class="mt-3" method="post">
	<?php echo csrf_field(); ?>
	<div class="form-group">
		<label for="purchase_code_form_field"><?php echo e(get_phrase('Purchase code')); ?></label>
		<input type="text" class="form-control mb-1" name="purchase_code" id="purchase_code_form_field">
		<small id="invalid_purchase_code_message" class="d-hidden badge bg-danger"><?php echo e(get_phrase('Invalid purchase code')); ?></small>
	</div>
	<div class="form-group mt-3">
		<button class="btn btn-primary" onclick="save_purchase_code()" type="button"><?php echo e(get_phrase('Submit')); ?></button>
	</div>
</form>

<script type="text/javascript">
    "use strict";
	function save_purchase_code(){
		var purchase_code = $('#purchase_code_form_field').val();
		$.ajax({
			url: '<?php echo e(route('superadmin.save_valid_purchase_code', 'update')); ?>',
			type: 'post',
			data: {purchase_code : purchase_code},
            headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
				if(response == 1){
					window.location.reload();
				}else{
					$('#invalid_purchase_code_message').show();
				}
			}
		});
	}
</script><?php /**PATH C:\wamp64\www\fernandez\Ekattor8\resources\views/superadmin/settings/save_purchase_code_form.blade.php ENDPATH**/ ?>