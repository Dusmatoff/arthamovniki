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
           value="50000_150000"
           id="price-51"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '50000_150000' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-51">
        От 50 до 150 тыс руб
    </label>
</div>

<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="150000_400000"
           id="price-150"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '150000_400000' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-150">
        От 150 до 400 тыс руб
    </label>
</div>

<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="400000_1000000"
           id="price-400"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '400000_1000000' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-400">
        От 400 тыс руб до 1 млн руб
    </label>
</div>

<div class="form-check">
    <input class="form-check-input"
           type="radio"
           name="price"
           value="1000001"
           id="price-mln"
            <?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '1000001' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-mln">
        Свыше 1 млн руб
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