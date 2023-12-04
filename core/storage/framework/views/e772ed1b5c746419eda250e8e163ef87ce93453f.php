
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($page_post->meta_description); ?>">
    <meta name="tags" content="<?php echo e($page_post->meta_tags); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
    <?php echo e($page_post->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e($page_post->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('og-meta'); ?>
    <meta name="og:title" content="<?php echo e($page_post->title); ?>">
    <meta name="og:description" content="<?php echo e($page_post->meta_description); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="dynamic-page-content-area">
    <?php
    // dd(!!$page_post->page_container_option);
        $page_container_option = $page_post->page_container_option ? 'container-fluid px-0' : 'container';
    ?>
    <div class="<?php echo e($page_container_option); ?>">
        <div class="row">
            <div class="col-lg-12">
                <?php if(!empty($page_post->page_builder_status)): ?>
                    <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page',$page_post->id); ?>

                <?php else: ?>
                    <?php echo $__env->make('frontend.partials.dynamic-page-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/pages/dynamic-single.blade.php ENDPATH**/ ?>