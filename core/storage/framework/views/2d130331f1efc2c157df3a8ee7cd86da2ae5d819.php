<li class="loginSystem">
<?php if(auth('web')->check()): ?>

    <a href="<?php echo e(route('user.home')); ?>">
        <i class="lar la-user icon"></i>
    </a>
<!-- Show Logged info -->
<ul class="loggedWrapper">
    <li class="single"><a href="<?php echo e(route('user.home')); ?>"><?php echo e(__('Dashboard')); ?></a> </li>
    <li class="single"><a href="<?php echo e(route('user.home.edit.profile')); ?>"><?php echo e(__('Edit Profile')); ?></a> </li>
    <li class="single"><a href="<?php echo e(route('user.home.change.password')); ?>"><?php echo e(__('Change Password')); ?></a> </li>
    <li class="single"><a href="<?php echo e(route('user.product.order.all')); ?>"><?php echo e(__('My Orders')); ?></a> </li>
    <li class="single"><a href="<?php echo e(route('user.shipping.address.all')); ?>"><?php echo e(__('Shipping Address')); ?></a> </li>
    <li class="single"><a href="<?php echo e(route('user.home.support.tickets')); ?>"><?php echo e(__('Support Ticket')); ?></a> </li>
    <li class="single">
        <a  href="<?php echo e(route('user.logout')); ?>"
           onclick="event.preventDefault();document.getElementById('menu_logout_submit_btn').dispatchEvent(new MouseEvent('click'));">
            <?php echo e(__('Logout')); ?>

        </a>
        <form  action="<?php echo e(route('user.logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
            <button id="menu_logout_submit_btn" type="submit"></button>
        </form>
    </li>
</ul>

<?php elseif(auth('admin')->check()): ?>

    <a href="<?php echo e(route('admin.home')); ?>">
        <i class="lar la-user icon"></i>
    </a>
<?php else: ?>

    <a href="<?php echo e(route('user.login')); ?>">
        <i class="lar la-user icon"></i>
    </a>
    
    <!-- Show Logged info -->
    <ul class="loggedWrapper">
        <li class="single"><a href="<?php echo e(route('user.login')); ?>" ><?php echo e(__('Sign In')); ?></a> </li>
        <li class="single"><a href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Sign Up')); ?></a> </li>
    </ul>
<?php endif; ?>
</li><?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/components//frontend/user-menu.blade.php ENDPATH**/ ?>