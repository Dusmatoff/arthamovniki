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
                    <div class="filter__group-title">Раздел</div>
                    <div class="filter__group-arr">
	                    <?php if ( !isset( $_GET['picture_category'] ) ): ?>
                            <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.0831 1L6.76019 7L1 1" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
	                    <?php endif; ?>
                    </div>
                </div>
                <div class="filter__group-body">
					<?php render_term_radio( 'picture_category' ); ?>
                </div>
            </div>
            <div class="filter__group <?php echo ! empty( $_GET['picture_subject'] ) ? 'active' : ''; ?>">
                <div class="filter__group-header">
                    <div class="filter__group-title">Жанр/Тема</div>
                    <div class="filter__group-arr">
						<?php if ( !isset( $_GET['picture_subject'] ) ): ?>
                            <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.0831 1L6.76019 7L1 1" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
						<?php endif; ?>
                    </div>
                </div>
                <div class="filter__group-body">
					<?php render_term_radio( 'picture_subject' ); ?>
                </div>
            </div>
            <div class="filter__group <?php echo ! empty( $_GET['size'] ) ? 'active' : ''; ?>">
                <div class="filter__group-header">
                    <div class="filter__group-title">Размер</div>
                    <div class="filter__group-arr">
	                    <?php if ( !isset( $_GET['size'] ) ): ?>
                            <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.0831 1L6.76019 7L1 1" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
	                    <?php endif; ?>
                    </div>
                </div>
                <div class="filter__group-body">
					<?php get_template_part( 'template-parts/filters/size' ); ?>
                </div>
            </div>
            <div class="filter__group <?php echo ! empty( $_GET['price'] ) ? 'active' : ''; ?>">
                <div class="filter__group-header">
                    <div class="filter__group-title">Ценовая категория</div>
                    <div class="filter__group-arr">
	                    <?php if ( !isset( $_GET['price'] ) ): ?>
                            <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.0831 1L6.76019 7L1 1" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
	                    <?php endif; ?>
                    </div>
                </div>
                <div class="filter__group-body">
					<?php get_template_part( 'template-parts/filters/price' ); ?>
                </div>
            </div>
        </div>
    </div>
</form>
<span class="filter-btn" onclick="location.href = '/picture/?see=<?php echo $_GET['see']; ?>';">
    Очистить фильтр
</span>
