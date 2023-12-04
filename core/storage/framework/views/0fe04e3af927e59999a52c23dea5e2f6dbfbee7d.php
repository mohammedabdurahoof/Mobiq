<div class="additional_info_repeater">
    <div class="form-row">
        <div class="col">
            <input type="text" name="info_title[]" class="form-control" placeholder="<?php echo e(__('Info Title')); ?>" <?php if(isset($infoTitle)): ?> value="<?php echo e($infoTitle); ?>" <?php endif; ?>>
        </div>
        <div class="col">
            <input type="text" name="info_text[]" class="form-control" placeholder="<?php echo e(__('Info Text')); ?>" <?php if(isset($infoText)): ?> value="<?php echo e($infoText); ?>" <?php endif; ?>>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-sm btn-success add_more_info_btn"> + </button>
            <button type="button" class="btn btn-sm btn-danger remove_this_info_btn" <?php if(isset($isFirst) && $isFirst): ?> disabled <?php endif; ?> > - </button>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/components/product/more-info/repeater.blade.php ENDPATH**/ ?>