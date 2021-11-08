<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           name="price"
           value="50"
           id="price-50"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '50' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-50">
        До 50 тыс руб
    </label>
</div>

<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           name="price"
           value="50_150"
           id="price-51"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '50_150' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-51">
        От 50 до 150 тыс руб
    </label>
</div>

<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           name="price"
           value="150_400"
           id="price-150"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '150_400' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-150">
        От 150 до 400 тыс руб
    </label>
</div>

<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           name="price"
           value="400_1m"
           id="price-400"
		<?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '400_1m' ? 'checked' : ''; ?>
    >
    <label class="form-check-label" for="price-400">
        От 400 тыс руб до 1 млн руб
    </label>
</div>

<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           name="price"
           value="1m"
           id="price-mln"
            <?php echo ! empty( $_GET['price'] ) && $_GET['price'] === '1m' ? 'checked' : ''; ?>
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
