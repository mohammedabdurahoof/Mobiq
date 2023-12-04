
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Admin')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between mb-4">
                           <h4 class="header-title"><?php echo e(__('Edit Admin')); ?></h4>
                           <div class="btn-wrapper">
                               <a class="btn btn-secondary" href="<?php echo e(route('admin.all.user')); ?>"><?php echo e(__("All Admin")); ?></a>
                           </div>
                       </div>
                        <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('backend/partials/error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form action="<?php echo e(route('admin.user.update')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="user_id" value="<?php echo e($admin->id); ?>">
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control"  value="<?php echo e($admin->name); ?>" name="name" placeholder="<?php echo e(__('Enter name')); ?>">
                            </div>

                            <div class="form-group">
                                <label for="email"><?php echo e(__('Email')); ?></label>
                                <input type="text" class="form-control"  value="<?php echo e($admin->email); ?>" name="email" placeholder="<?php echo e(__('Email')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="role"><?php echo e('Role'); ?></label>
                                <select name="role" class="form-control">
                                    <option value=""><?php echo e(__('Select Role')); ?></option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role); ?>" <?php if(in_array($role,$adminRole)): ?> selected <?php endif; ?>><?php echo e($role); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="site_favicon"><?php echo e(__('Image')); ?></label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php
                                            $image = get_attachment_image_by_id($admin->image,null,true);
                                            $image_btn_label = __( 'Upload Image');
                                        ?>
                                        <?php if(!empty($image)): ?>
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="<?php echo e($image['img_url']); ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php  $image_btn_label = __('Change Image'); ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" id="image" name="image" value="<?php echo e($admin->image); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e(__($image_btn_label)); ?>

                                    </button>
                                </div>
                                <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Submit')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/admin-role-manage/edit-user.blade.php ENDPATH**/ ?>