<?php
  namespace Frontend;
?>
<h2></h2>

<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1>Integração com acervo digital - memoriafredericomorais</h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<button type="button" class="handlediv" aria-expanded="true" >
							<span class="screen-reader-text">Toggle panel</span>

						</button>
						<!-- Toggle -->

						<h2 class="hndle"><span>Shortcodes válidos para utilização</span>
						</h2>

						<div class="inside">
              <?php
            		printf(
            			// translators: %1$s is a code fragment for the notice information and %2$s is the inline class code.
            			esc_attr__( 'O shortcode %1$s é utilizado para carregar uma página com os items do sistema.', 'WpAdminStyle' ),
            			'<code>[items]</code>'
            		);
              ?>
                <br>
              <?php  printf(
            			// translators: %1$s is a code fragment for the notice information and %2$s is the inline class code.
            			esc_attr__( 'O shortcode %1$s representa uma página que detalha informações de um item apenas.', 'WpAdminStyle' ),
            			'<code>[items_single]</code>'
            		);
          		?>
              <br>
            <?php  printf(
                // translators: %1$s is a code fragment for the notice information and %2$s is the inline class code.
                esc_attr__( 'O shortcode %1$s representa a página que lista os favoritos do usuário logado.', 'WpAdminStyle' ),
                '<code>[meus_favoritos]</code>'
              );
            ?>
            <br>
          <?php  printf(
              // translators: %1$s is a code fragment for the notice information and %2$s is the inline class code.
              esc_attr__( 'O shortcode %1$s exibe o filtro de pesquisa dos itens.', 'WpAdminStyle' ),
              '<code>[filtro]</code>'
            );
          ?>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->
