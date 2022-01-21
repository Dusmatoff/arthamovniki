<label>Размер (по большей стороне)</label>

<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           value="small"
           name="size"
           id="size-1"
		<?php echo is_filter_item_checked( 'size', 'small' ) ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="size-1">
        До 50 см
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           value="medium"
           name="size"
           id="size-50"
		<?php echo is_filter_item_checked( 'size', 'medium' ) ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="size-50">
        От 50 до 100см
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           value="large"
           name="size"
           id="size-100"
		<?php echo is_filter_item_checked( 'size', 'large' ) ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="size-100">
        От 100 см
    </label>
</div>
