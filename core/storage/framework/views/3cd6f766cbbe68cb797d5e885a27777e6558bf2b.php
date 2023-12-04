
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.css','data' => []]); ?>
<?php $component->withName('summernote.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Page')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        use App\CategoryMenu;
        $mega_menu_categories = CategoryMenu::get()->pluck("title","id");
        $selected_megamenu = get_static_option("megamenu");
    ?>

    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.flash','data' => []]); ?>
<?php $component->withName('msg.flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title"><?php echo e(__('Edit Page')); ?></h4>
                            <a href="<?php echo e(route('admin.page')); ?>" class="btn btn-primary"><?php echo e(__('All Pages')); ?></a>
                        </div>
                        <form action="<?php echo e(route('admin.page.update',$page_post->id)); ?>" method="post"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               value="<?php echo e($page_post->title); ?>">
                                    </div>
                                    <div class="form-group mt-5">
                                        <label for="page_builder_status"><strong><?php echo e(__('Page Builder Enable/Disable')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="page_builder_status"
                                                   <?php if(!empty($page_post->page_builder_status)): ?> checked <?php endif; ?> >
                                            <span class="slider onff"></span>
                                        </label>
                                    </div>
                                    <div class="form-group classic-editor-wrapper <?php if(!empty($page_post->page_builder_status)): ?> d-none <?php endif; ?> ">
                                        <label><?php echo e(__('Content')); ?></label>
                                        <input type="hidden" name="page_content" value="<?php echo e($page_post->content); ?>">
                                        <div class="summernote" data-content='<?php echo e($page_post->content); ?>'></div>
                                    </div>
                                    <div class="btn-wrapper page-builder-btn-wrapper <?php if(empty($page_post->page_builder_status)): ?> d-none <?php endif; ?> ">
                                        <a href="<?php echo e(route('admin.dynamic.page.builder',['type' =>'dynamic-page','id' => $page_post->id])); ?>"
                                           target="_blank" class="btn btn-primary"> <i
                                                    class="fas fa-external-link-alt"></i> <?php echo e(__('Open Page Builder')); ?>

                                        </a>
                                    </div>
                                    <div class="navbar_variants mt-5">
                                        <p class="mb-3 lead">
                                            <?php echo e(__('Navbar Variant')); ?>

                                        </p>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="navbar_variant" value="<?php echo e($page_post->navbar_variant); ?>" name="navbar_variant">
                                        </div>
                                        <?php for($i = 1; $i <= 2; $i++): ?>
                                            <div class="img-select img-select-nav <?php if($page_post->navbar_variant == $i): ?> selected <?php endif; ?>" data-navbar_id="<?php echo e($i); ?>">
                                                <div class="img-wrap">
                                                    <img src="<?php echo e(asset('assets/frontend/navbar-variant/0'.$i.'.jpg')); ?>" data-nav_id="<?php echo e($i); ?>" alt="">
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    
                                    <div class="form-group">
                                        <label><strong><?php echo e(__('Breadcrumb Show/Hide')); ?></strong></label>
                                        <label class="switch role">
                                            <input type="checkbox" name="breadcrumb_status" <?php if(!empty($page_post->breadcrumb_status)): ?> checked <?php endif; ?>>
                                            <span class="slider-yes-no"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label><strong><?php echo e(__('Full Page Width')); ?></strong></label>
                                        <label class="switch role">
                                            <input type="checkbox" name="page_container_option" <?php if(!empty($page_post->page_container_option)): ?> checked <?php endif; ?>>
                                            <span class="slider-yes-no"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label><strong><?php echo e(__('Navbar Category Dropdown Open')); ?></strong></label>
                                        <label class="switch role">
                                            <input type="checkbox" name="navbar_category_dropdown_open" <?php if(!empty($page_post->navbar_category_dropdown_open)): ?> checked <?php endif; ?>>
                                            <span class="slider-yes-no"></span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="slug"><?php echo e(__('Slug')); ?></label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="<?php echo e($page_post->slug); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(__('Status')); ?></label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="publish"><?php echo e(__('Publish')); ?></option>
                                            <option value="draft"><?php echo e(__('Draft')); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="megamenu" style="display: <?php echo e($page_post->navbar_variant != 1 ? "none!important" : "block"); ?>">
                                        <label><?php echo e(__('Select Mega Menu')); ?></label>
                                        <select name="megamenu" class="form-control">
                                            <?php $__currentLoopData = $mega_menu_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e($key == $selected_megamenu ? "selected" : ""); ?>><?php echo e(html_entity_decode($value)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(__('Visibility')); ?></label>
                                        <select name="visibility" class="form-control">
                                            <option <?php if($page_post->visibility === 'all'): ?> selected
                                                    <?php endif; ?> value="all"><?php echo e(__('All')); ?></option>
                                            <option <?php if($page_post->visibility === 'user'): ?> selected
                                                    <?php endif; ?> value="user"><?php echo e(__('Only Logged In User')); ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_tags"><?php echo e(__('Page Meta Tags')); ?></label>
                                        <input type="text" name="meta_tags" class="form-control"
                                               value="<?php echo e($page_post->meta_tags); ?>" data-role="tagsinput" id="meta_tags">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description"><?php echo e(__('Page Meta Description')); ?></label>
                                        <textarea name="meta_description" class="form-control"
                                                  id="meta_description"><?php echo e($page_post->meta_description); ?></textarea>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Page')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    
    <script>
        $(document).ready(function () {
            $(document).on('change', 'input[name="page_builder_status"]', function () {
                if ($(this).is(':checked')) {
                    $('.classic-editor-wrapper').addClass('d-none');
                    $('.page-builder-btn-wrapper').removeClass('d-none');
                } else {
                    $('.classic-editor-wrapper').removeClass('d-none');
                    $('.page-builder-btn-wrapper').addClass('d-none');
                }
            });

            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function (contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if ($('.summernote').length > 0) {
                $('.summernote').each(function (index, value) {
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            //For Navbar
            var imgSelect1 = $('.img-select-nav');
            var id = $('#navbar_variant').val();
            imgSelect1.removeClass('selected');
            $('img[data-nav_id="'+id+'"]').parent().parent().addClass('selected');
            $(document).on('click','.img-select-nav img',function (e) {
                e.preventDefault();
                imgSelect1.removeClass('selected');
                $(this).parent().parent().addClass('selected').siblings();
                $('#navbar_variant').val($(this).data('nav_id'));

                // if navbar id is one then you need to show mega menu select box
                if($(this).data('nav_id') == 1){
                    $("#megamenu").fadeIn();
                }else{
                    $("#megamenu").fadeOut();
                }
            });

            //For Footer
            var imgSelect2 = $('.img-select-footer');
            var id = $('#footer_variant').val();
            imgSelect2.removeClass('selected');
            $('img[data-foot_id="'+id+'"]').parent().parent().addClass('selected');
            $(document).on('click','.img-select-footer img',function (e) {
                e.preventDefault();
                imgSelect2.removeClass('selected');
                $(this).parent().parent().addClass('selected').siblings();
                $('#footer_variant').val($(this).data('foot_id'));
            });
        });
    </script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/pages/page/edit.blade.php ENDPATH**/ ?>