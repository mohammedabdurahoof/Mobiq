<div class="single-blog-item">
    <div class="img-box">
        <?php echo render_image_markup_by_attachment_id($image); ?>

    </div>
    <div class="content">
        <ul class="post-meta">
            <li class="meta-item">
                <a href="<?php echo e(route('frontend.blog.single', $slug)); ?>">
                    <i class="las la-calendar icon"></i>
                    <?php echo e(date('d M Y', strtotime($date))); ?>

                </a>
            </li>
            <li class="meta-item">
                <a href="#">
                    <i class="las la-tag icon"></i>
                    <?php echo get_blog_category_by_id($catid, 'link'); ?>

                </a>
            </li>
        </ul>
        <h4 class="title"><a href="<?php echo e(route('frontend.blog.single', $slug)); ?>"><?php echo e($title); ?></a></h4>
        <p class="info"><?php echo Str::words(purify_html_raw($content), 60); ?></p>
        <div class="btn-wrapper mt-3">
            <a href="<?php echo e(route('frontend.blog.single', $slug)); ?>" class="borderless-btn btn-default rounded-btn"><?php echo e(get_static_option('blog_page_read_more_btn_text')); ?></a>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/components/frontend/blog/list01.blade.php ENDPATH**/ ?>