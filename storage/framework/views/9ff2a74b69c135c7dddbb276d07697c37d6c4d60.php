
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
<style>
.intl-tel-input{
    width:100% !important;
}
input[type="date"]::-webkit-calendar-picker-indicator {
  cursor: pointer;
  border-radius: 4px;
  margin-right: 2px;
  color: #acb5be;
  filter: invert(0.5);
}
</style>
<form class="form bravo-form-register" method="post" action="<?php echo e(route('auth.register.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="<?php echo e(__("First Name")); ?>">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-first_name"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="<?php echo e(__("Last Name")); ?>">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-last_name"></span>
            </div>
        </div>
    </div>
    <input type="hidden" id="key" name="key" value="">
    <div class="form-group">
        <input type="text" class="form-control"  id="telephone" name="phone" autocomplete="off" placeholder="<?php echo e(__('Phone')); ?>">
        <i class="input-icon field-icon icofont-ui-touch-phone"></i>
        <span class="invalid-feedback error error-phone"></span>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" autocomplete="off" placeholder="<?php echo e(__('Email address')); ?>">
        <i class="input-icon field-icon icofont-mail"></i>
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div class="form-group">
        <input type="date" class="form-control" name="birthday" autocomplete="off" placeholder="<?php echo e(__('birthday of Birth')); ?>">
        <span class="invalid-feedback error error-birthday"></span>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="<?php echo e(__('Password')); ?>">
        <i class="input-icon field-icon icofont-ui-password"></i>
        <span class="invalid-feedback error error-password"></span>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="confirm_password" autocomplete="off" placeholder="<?php echo e(__('Confirm Password')); ?>">
        <i class="input-icon field-icon icofont-ui-password"></i>
        <span class="invalid-feedback error error-confirm_password"></span>
    </div>
    <div class="form-group">
        <label class=""><?php echo e(__("Country")); ?></label>
        <select name="country" id="country" class="form-control"  >
            <option value=""><?php echo e(__('-- Select --')); ?></option>
            <?php $__currentLoopData = get_country_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($row->country??''==$id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <span class="invalid-feedback error error-country"></span>
    </div>
    <div class="form-group">
        <label for="term">
            <input id="term" type="checkbox" name="term" class="mr5">
            <?php echo __("I have read and accept the <a href=':link' target='_blank'>Terms and Privacy Policy</a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]); ?>

            <span class="checkmark fcheckbox"></span>
        </label>
        <div><span class="invalid-feedback error error-term"></span></div>
    </div>
    <div class="form-group">
        <label for="term">
            <input id="years" type="checkbox" name="years" class="mr5">
            <?php echo __("You should be at least 18 years of age"); ?>

            <span class="checkmark fcheckbox"></span>
        </label>
        <div><span class="invalid-feedback error error-years"></span></div>
    </div>
    <?php if(setting_item("user_enable_register_recaptcha")): ?>
        <div class="form-group">
            <?php echo e(recaptcha_field($captcha_action ?? 'register')); ?>

        </div>
        <div><span class="invalid-feedback error error-g-recaptcha-response"></span></div>
    <?php endif; ?>
    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-submit">
            <?php echo e(__('Sign Up')); ?>

            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
    <?php if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable')): ?>
        <div class="advanced">
            <p class="text-center f14 c-grey"><?php echo e(__("or continue with")); ?></p>
            <div class="row">
                <?php if(setting_item('facebook_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('/social-login/facebook')); ?>" class="btn btn_login_fb_link"
                           data-channel="facebook">
                            <i class="input-icon fa fa-facebook"></i>
                            <?php echo e(__('Facebook')); ?>

                        </a>
                    </div>
                <?php endif; ?>
                <?php if(setting_item('google_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('social-login/google')); ?>" class="btn btn_login_gg_link" data-channel="google">
                            <i class="input-icon fa fa-google"></i>
                            <?php echo e(__('Google')); ?>

                        </a>
                    </div>
                <?php endif; ?>
                <?php if(setting_item('twitter_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('social-login/twitter')); ?>" class="btn btn_login_tw_link" data-channel="twitter">
                            <i class="input-icon fa fa-twitter"></i>
                            <?php echo e(__('Twitter')); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="c-grey f14 text-center">
       <?php echo e(__(" Already have an account?")); ?>

        <a href="#" data-target="#login" data-toggle="modal"><?php echo e(__("Log In")); ?></a>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
<script src="<?php echo e(asset('phone/intlTelInput.js')); ?>"></script><?php /**PATH /home/hatem/Desktop/desertroad/modules/Layout/auth/register-form.blade.php ENDPATH**/ ?>