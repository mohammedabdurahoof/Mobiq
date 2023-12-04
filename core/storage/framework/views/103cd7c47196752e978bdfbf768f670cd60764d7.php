
<?php
    $post_img = null;
    $blog_image = get_attachment_image_by_id($blog_post->image, 'full', false);
    $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
?>

<?php $__env->startSection('style'); ?>
    <?php if(!empty(get_static_option('site_disqus_key'))): ?>
        <script id="dsq-count-scr" src="//<?php echo e(get_static_option('site_disqus_key')); ?>.disqus.com/count.js" async></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('og-meta'); ?>
    <meta name="og:title" content="<?php echo e(purify_html($blog_post->og_meta_title)); ?>">
    <meta name="og:description" content="<?php echo e(purify_html($blog_post->og_meta_description)); ?>">
    <?php echo render_og_meta_image_by_attachment_id($blog_post->og_meta_image); ?>

    <meta name="og:tags" content=" <?php echo e(purify_html($blog_post->meta_tags)); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(purify_html($blog_post->meta_description)); ?>">
    <meta name="tags" content="<?php echo e(purify_html($blog_post->meta_tag)); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(purify_html($blog_post->title)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(purify_html($blog_post->title)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="blog-details-area-wrapper">
        <div class="container custom-container-1318">
            <div class="row row-reverse justify-content-around">
                <div class="col-lg-9">
                    <div class="blog-details-area-inner">
                        <div class="img-box main-img">
                            <?php if(!empty($blog_image)): ?>
                                <img src="<?php echo e($blog_image['img_url']); ?>" alt="<?php echo e(purify_html($blog_post->title)); ?>">
                            <?php endif; ?>
                        </div>

                        <div class="content">
                            <h4 class="main-title"><?php echo $blog_post->title; ?> </h4>
                            <div class="post-meta">
                                <ul class="post-meta-list">
                                    <li class="post-meta-item">
                                        <a href="#">
                                            <i class="lar la-calendar icon"></i>
                                            <span class="text"><?php echo e(date_format($blog_post->created_at, 'Y F Y')); ?></span>
                                        </a>
                                    </li>
                                    <li class="post-meta-item">
                                        <a href="<?php echo e(route('frontend.blog.category',  ['id' => optional($blog_post->category)->id, 'name' => optional($blog_post->category)->title]) ?? ''); ?>">
                                            <i class="las la-tag icon"></i>
                                            <span class="text"><?php echo e(optional($blog_post->category)->name); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <p class="info info-1">
                                <?php echo $blog_post->blog_content; ?>

                            </p>
                        </div>

                        <!-- Tag and social link area start -->
                        <div class="blog-details-tag-and-social-link">
                            <?php $all_tags = explode(',', purify_html($blog_post->tags)); ?>
                            <?php if(count($all_tags) > 1): ?>
                                <div class="tag">
                                    <p class="name"><?php echo e(get_static_option('blog_single_page_tags_title')); ?>:</p>
                                    <?php $__currentLoopData = $all_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $slug = Str::slug($tag); ?>
                                        <a href="<?php echo e(route('frontend.blog.tags.page', ['name' => $slug])); ?>"
                                           class="tag-btn"><?php echo e($tag); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                            <div class="social-link-wrap">
                                <p class="name"><?php echo e(get_static_option('blog_single_page_share_title')); ?>:</p>
                                <div class="social-link">
                                    <ul class="social-link-list">
                                        <?php echo single_post_share(route('frontend.blog.single', purify_html($blog_post->slug)), purify_html($blog_post->title), $post_img); ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Tag and social link area end -->
                        <div class="disqus-comment-area margin-top-40">
                            <div id="disqus_thread"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget-area-wrapper">
                        <?php echo render_frontend_sidebar('blog', ['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php if(!empty(get_static_option('site_disqus_key'))): ?>
        <div id="disqus_thread"></div>
        <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function () { // DON'T EDIT BELOW THIS LINE
                var d = document,
                    s = d.createElement('script');
                s.src = 'https://<?php echo e(get_static_option('site_disqus_key')); ?>.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/pages/blog/blog-single.blade.php ENDPATH**/ ?>