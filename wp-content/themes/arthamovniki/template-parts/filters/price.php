<label>Цена</label>

<div class="form-check">
    <input class="form-check-input" type="radio" value="any" name="price" id="price-any">
    <label class="form-check-label" for="price-any">
        Любая
    </label>
</div>

<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="300000"
           id="price-300"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '300000' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-300">
        До 300 тыс руб
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="100000"
           id="price-100"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '100000' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-100">
        До 100 тыс руб
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="30000"
           id="price-30"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '30000' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-30">
        До 30 тыс руб
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="0"
           id="price-0"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '0' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-0">
        Не показывать без цены
    </label>
</div>