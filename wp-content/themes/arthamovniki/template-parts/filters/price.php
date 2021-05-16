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
           value="50000"
           id="price-50"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '50000' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-50">
        До 50 тыс руб
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
        От 50 до 300 тыс руб
    </label>
</div>
<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="301000"
           id="price-301"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '301000' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-300">
        Свыше  300 тыс руб
    </label>
</div>


<!--<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="0"
           id="price-0"
		<?php //echo ! empty( $_GET['price'] ) && $_GET['price'] === '0' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-0">
        Не показывать без цены
    </label>
</div>-->