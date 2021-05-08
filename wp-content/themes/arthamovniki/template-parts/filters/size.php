<label>Размер (по большей стороне)</label>

<div class="form-check">
    <input class="form-check-input" type="radio" value="any" name="size" id="size-any">
    <label class="form-check-label" for="size-any">
        Любой
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="radio"
           value="100"
           name="size"
           id="size-100"
		<?php echo ! empty( $_GET['size'] ) && $_GET['size'] === '100' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="size-100">
        Большой от 100 см
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="radio"
           value="50"
           name="size"
           id="size-50"
		<?php echo ! empty( $_GET['size'] ) && $_GET['size'] === '50' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="size-50">
        Средний от 50 до 100см
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="radio"
           value="0"
           name="size"
           id="size-0"
		<?php echo ! empty( $_GET['size'] ) && $_GET['size'] === '0' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="size-0">
        Небольшой до 50 см
    </label>
</div>