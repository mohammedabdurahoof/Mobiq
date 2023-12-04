
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Coupon')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.css','data' => []]); ?>
<?php $component->withName('datatable.css'); ?>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action.css','data' => []]); ?>
<?php $component->withName('bulk-action.css'); ?>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.niceselect.css','data' => []]); ?>
<?php $component->withName('niceselect.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <style>
        #form_category, #edit_#form_category,
        #form_subcategory, #edit_#form_subcategory,
        #form_products, #edit_#form_products {
            display: none;
        }

        .lds-ellipsis {
            position: fixed;
            width: 80px;
            height: 80px;
            left: 50vw;
            top: 40vh;
            z-index: 50;
            display: none;
        }
        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: <?php echo e(get_static_option('site_color')); ?>;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }
        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }
        @keyframes  lds-ellipsis1 {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }
        @keyframes  lds-ellipsis3 {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }
        @keyframes  lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(24px, 0);
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40">
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
            </div>
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('All Product Coupon')); ?></h4>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-coupon-delete')): ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action.dropdown','data' => []]); ?>
<?php $component->withName('bulk-action.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endif; ?>
                          <div class="table-wrap table-responsive">
                                <table class="table table-default">
                                    <thead>
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action.th','data' => []]); ?>
<?php $component->withName('bulk-action.th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        <th><?php echo e(__('ID')); ?></th>
                                        <th><?php echo e(__('Code')); ?></th>
                                        <th><?php echo e(__('Discount')); ?></th>
                                        <th><?php echo e(__('Expire Date')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $all_product_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action.td','data' => ['id' => $data->id]]); ?>
<?php $component->withName('bulk-action.td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <td><?php echo e($data->id); ?></td>
                                            <td><?php echo e($data->code); ?></td>
                                            <td><?php if($data->discount_type == 'percentage'): ?> <?php echo e($data->discount); ?>% <?php else: ?> <?php echo e(amount_with_currency_symbol($data->discount)); ?> <?php endif; ?></td>
                                            <td><?php echo e(date('d M Y', strtotime($data->expire_date))); ?></td>
                                            <td>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.status-span','data' => ['status' => $data->status]]); ?>
<?php $component->withName('status-span'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-coupon-delete')): ?>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.table.btn.swal.delete','data' => ['route' => route('admin.products.coupon.delete', $data->id)]]); ?>
<?php $component->withName('table.btn.swal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.products.coupon.delete', $data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-coupon-edit')): ?>
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#category_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 category_edit_btn"
                                                   data-id="<?php echo e($data->id); ?>"
                                                   data-title="<?php echo e($data->title); ?>"
                                                   data-code="<?php echo e($data->code); ?>"
                                                   data-discount_on="<?php echo e($data->discount_on); ?>"
                                                   data-discount_on_details="<?php echo e($data->discount_on_details); ?>"
                                                   data-discount="<?php echo e($data->discount); ?>"
                                                   data-discount_type="<?php echo e($data->discount_type); ?>"
                                                   data-expire_date="<?php echo e($data->expire_date); ?>"
                                                   data-status="<?php echo e($data->status); ?>"
                                                >
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                          </div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-coupon-create')): ?>
            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Add New Coupon')); ?></h4>
                        <form action="<?php echo e(route('admin.products.coupon.new')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="title"><?php echo e(__('Coupon Title')); ?></label>
                                <input type="text" class="form-control"  id="title" name="title" placeholder="<?php echo e(__('Title')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="code"><?php echo e(__('Coupon Code')); ?></label>
                                <input type="text" class="form-control"  id="code" name="code" placeholder="<?php echo e(__('Code')); ?>" required>
                                <span id="status_text" class="text-danger" style="display: none"></span>
                            </div>
                            <div class="form-group">
                                <label for="discount_on"><?php echo e(__('Discount On')); ?></label>
                                <select name="discount_on" id="discount_on" class="form-control">
                                    <option value=""><?php echo e(__('Select an option')); ?></option>
                                    <?php $__currentLoopData = $coupon_apply_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group" id="form_category">
                                <label for="category"><?php echo e(__('Category')); ?></label>
                                <select name="category" id="category" class="form-control">
                                    <option value=""><?php echo e(__('Select a Category')); ?></option>
                                    <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group" id="form_subcategory">
                                <label for="subcategory"><?php echo e(__('Subcategory')); ?></label>
                                <select name="subcategory" id="subcategory" class="form-control">
                                    <option value=""><?php echo e(__('Select a Subcategory')); ?></option>
                                    <?php $__currentLoopData = $all_subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group" id="form_products">
                                <label for="products"><?php echo e(__('Products')); ?></label>
                                <select name="products[]" id="products" class="form-control nice-select wide" multiple>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount"><?php echo e(__('Discount')); ?></label>
                                <input type="number" class="form-control"  id="discount" name="discount" placeholder="<?php echo e(__('Discount')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="discount_type"><?php echo e(__('Coupon Type')); ?></label>
                                <select name="discount_type" class="form-control" id="discount_type" required>
                                    <option value="percentage"><?php echo e(__("Percentage")); ?></option>
                                    <option value="amount"><?php echo e(__("Amount")); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expire_date"><?php echo e(__('Expire Date')); ?></label>
                                <input type="date" class="form-control flatpickr"  id="expire_date" name="expire_date" placeholder="<?php echo e(__('Expire Date')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('Status')); ?></label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="publish"><?php echo e(__("Publish")); ?></option>
                                    <option value="draft"><?php echo e(__("Draft")); ?></option>
                                </select>
                            </div>
                            <button type="submit" id="coupon_create_btn" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New Coupon')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-coupon-edit')): ?>
    <div class="modal fade" id="category_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Update Coupon')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.products.coupon.update')); ?>"  method="post">
                    <input type="hidden" name="id" id="coupon_id">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="title"><?php echo e(__('Coupon Title')); ?></label>
                            <input type="text" class="form-control"  id="edit_title" name="title" placeholder="<?php echo e(__('Title')); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_code"><?php echo e(__('Coupon Code')); ?></label>
                            <input type="text" class="form-control"  id="edit_code" name="code" placeholder="<?php echo e(__('Code')); ?>">
                            <span id="status_text" class="text-danger" style="display: none"></span>
                        </div>
                        <div class="form-group">
                            <label for="discount_on"><?php echo e(__('Discount On')); ?></label>
                            <select name="discount_on" id="edit_discount_on" class="form-control">
                                <option value=""><?php echo e(__('Select an option')); ?></option>
                                <?php $__currentLoopData = $coupon_apply_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group" id="edit_form_category">
                            <label for="category"><?php echo e(__('Category')); ?></label>
                            <select name="category" id="edit_category" class="form-control">
                                <option value=""><?php echo e(__('Select a Category')); ?></option>
                                <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group" id="edit_form_subcategory">
                            <label for="subcategory"><?php echo e(__('Subcategory')); ?></label>
                            <select name="subcategory" id="edit_subcategory" class="form-control">
                                <option value=""><?php echo e(__('Select a Subcategory')); ?></option>
                                <?php $__currentLoopData = $all_subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group" id="edit_form_products">
                            <label for="products"><?php echo e(__('Products')); ?></label>
                            <select name="products[]" id="products" class="form-control nice-select wide" multiple>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_discount"><?php echo e(__('Discount')); ?></label>
                            <input type="number" class="form-control"  id="edit_discount" name="discount" placeholder="<?php echo e(__('Discount')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_type"><?php echo e(__('Coupon Type')); ?></label>
                            <select name="discount_type" class="form-control" id="edit_discount_type">
                                <option value="percentage"><?php echo e(__("Percentage")); ?></option>
                                <option value="amount"><?php echo e(__("Amount")); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_expire_date"><?php echo e(__('Expire Date')); ?></label>
                            <input type="date" class="form-control flatpickr"  id="edit_expire_date" name="expire_date" placeholder="<?php echo e(__('Expire Date')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_status"><?php echo e(__('Status')); ?></label>
                            <select name="status" class="form-control" id="edit_status">
                                <option value="draft"><?php echo e(__("Draft")); ?></option>
                                <option value="publish"><?php echo e(__("Publish")); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save Change')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.js','data' => []]); ?>
<?php $component->withName('datatable.js'); ?>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.table.btn.swal.js','data' => []]); ?>
<?php $component->withName('table.btn.swal.js'); ?>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action.js','data' => ['route' => route('admin.products.coupon.bulk.action')]]); ?>
<?php $component->withName('bulk-action.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.products.coupon.bulk.action'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.niceselect.js','data' => []]); ?>
<?php $component->withName('niceselect.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <script>
        $(document).ready(function () {
            flatpickr(".flatpickr", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });

            $(document).on('click','.category_edit_btn',function(){
                let el = $(this);
                let id = el.data('id');
                let status = el.data('status');
                let modal = $('#category_edit_modal');
                let discount_on = el.data('discount_on');
                let discount_on_details = el.data('discount_on_details');

                modal.find('#coupon_id').val(id);
                modal.find('#edit_status option[value="'+status+'"]').attr('selected',true);
                modal.find('#edit_code').val(el.data('code'));
                modal.find('#edit_discount').val(el.data('discount'));
                modal.find('#edit_discount_type').val(el.data('discount_type'));
                modal.find('#edit_expire_date').val(el.data('expire_date'));
                modal.find('#edit_discount_type[value="'+el.data('discount_type')+'"]').attr('selected',true);
                modal.find('#edit_title').val(el.data('title'));
                modal.find('#edit_discount_on').val(el.data('discount_on'));

                $('#edit_form_category').hide();
                $('#edit_form_subcategory').hide();
                $('#edit_form_products').hide();

                console.log([
                    '#edit_form_' + discount_on + 's',
                    $('#edit_form_' + discount_on + 's')
                ]);

                if (discount_on == 'product') {
                    $('#edit_form_products').hide();
                    loadProductDiscountHtml($('#edit_discount_on'), '#edit_form_products select', true, discount_on_details);
                } else {
                    $('#edit_form_'+discount_on+' option[value='+discount_on_details+']').attr('selected', true);
                    $('#edit_form_' + discount_on).show();
                }
            });

            $('#code').on('keyup', function() {
                validateCoupon(this);
            });

            $('#edit_code').on('keyup', function() {
                validateCoupon(this);
            });

            $('#discount_on').on('change', function () {
                loadProductDiscountHtml(this, '#form_products select', false, []);
            });

            $('#edit_discount_on').on('change', function () {
                loadProductDiscountHtml(this, '#edit_form_products select', true, []);
            });
        });

        function loadProductDiscountHtml(context, target_selector, is_edit, values) {
            let product_select = $(target_selector);

            let selector_prefix = '';
            if (is_edit) {
                selector_prefix = 'edit_';
            }

            $('#'+selector_prefix+'form_category').hide();
            $('#'+selector_prefix+'form_subcategory').hide();
            $('#'+selector_prefix+'form_products').hide();

            if ($(context).val() == 'category') {
                $('#'+selector_prefix+'form_category').show(500);
            } else if ($(context).val() == 'subcategory') {
                $('#'+selector_prefix+'form_subcategory').show(500);
            } else if ($(context).val() == 'product') {
                $('.lds-ellipsis').show();
                $.get('<?php echo e(route("admin.products.coupon.products")); ?>').then(function (data) {
                    $('.lds-ellipsis').hide();

                    let options = '';
                    let discountd_products = [];

                    if (values.length) {
                        discountd_products = values;
                    }

                    if (data.length) {
                        data.forEach(function (product) {
                            let selected_class = '';

                            if (discountd_products.indexOf(product.id) > -1 || discountd_products.indexOf(String(product.id)) > -1) {
                                selected_class = 'selected';
                            }
                            options += '<option value="'+product.id+'" '+selected_class+'>'+product.title+'</option>';
                        });

                        product_select.html('');
                        product_select.html(options);
                        product_select.parent().show(500);
                        product_select.addClass('nice-select')

                        if ($('.nice-select').length) {
                            if ($('.nice-select.form-control.wide.has-multiple').length) {
                                $('.nice-select.form-control.wide.has-multiple').remove();
                            }
                            $('.nice-select').niceSelect();
                        }
                    }
                }).catch(function (err) {
                    $('.lds-ellipsis').hide();
                });
            }
        }

        function validateCoupon(context) {
            let code = $(context).val();
            let submit_btn = $(context).closest('form').find('button[type=submit]');
            let status_text = $(context).siblings('#status_text');
            status_text.hide();

            if (code.length) {
                submit_btn.prop("disabled", true);

                $.get("<?php echo e(route('admin.products.coupon.check')); ?>", {code: code}).then(function (data) {
                    if (data > 0) {
                        let msg = "<?php echo e(__('This coupon is already taken')); ?>";
                        status_text.removeClass('text-success').addClass('text-danger').text(msg).show();
                        submit_btn.prop("disabled", true);
                    } else {
                        let msg = "<?php echo e(__('This coupon is available')); ?>";
                        status_text.removeClass('text-danger').addClass('text-success').text(msg).show();
                        submit_btn.prop("disabled", false);
                    }
                });
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/products/coupon/all-coupon.blade.php ENDPATH**/ ?>