<?php

?>
<form action="<?php echo admin_url( 'admin-ajax.php' ) ?>" id="pictures-filter-form">
    <div class="filter-wrap">
        <div class="filter-show-btn btn btn--border">
            Показать фильтр
        </div>
        <div class="filter-hide-btn btn btn--border">
            Скрыть фильтр
        </div>
        <div class="filter">
            <div class="filter__group active">
                <div class="filter__group-header">
                    <div class="filter__group-title">Тема</div>
                    <div class="filter__group-arr">
                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.0831 1L6.76019 7L1 1" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="filter__group-body">
	                <?php render_term_checkboxes('picture_category'); ?>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-header">
                    <div class="filter__group-title">Сюжет</div>
                    <div class="filter__group-arr">
                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.0831 1L6.76019 7L1 1" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="filter__group-body">
		            <?php render_term_checkboxes('picture_subject'); ?>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-header">
                    <div class="filter__group-title">Размер</div>
                    <div class="filter__group-arr">
                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.0831 1L6.76019 7L1 1" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="filter__group-body">
	                <?php get_template_part('template-parts/filters/size'); ?>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-header">
                    <div class="filter__group-title">Цена</div>
                    <div class="filter__group-arr">
                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.0831 1L6.76019 7L1 1" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="filter__group-body">
		            <?php get_template_part('template-parts/filters/price'); ?>
                </div>
            </div>
            <br/>
            <div class="filter__btn" onclick="location.href = '/picture/';">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1L1.08855 9M1 1L8.91145 9L1 1Z" stroke-width="1.7" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                Очистить фильтр
            </div>
        </div>
    </div>
</form>
