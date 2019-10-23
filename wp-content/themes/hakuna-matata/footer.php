<footer>

    <?php wp_footer(); ?>
    <div class="cont-footer">
        <div class="text-left">
            <p class="title-footer">Hakuna Matata</p>
            <p>HAKUNA MATATA, S.A de C.V se contruyó
                formalmente en el año 2018, previa realización de
                actividades y adecuaciones necesarias para la
                actividad que se realizaría desde el 2015</p>
        </div>
        <div class="text-center">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo.png">
        </div>
        <div class="text-rigth">
            <p class="title-footer">Contactanos</p>
            <p>
                fincalosangeles2016@gmail.com<br>
                fincalosangeles@hakunamatata.com.sv<br>
                Comunidad los ángeles km 54 carretera a
                San Julian, Sonsonate
            </p>
        </div>
        <div class="nav-footer">
            <span> 2019 Todos los derechos reservados </span>
            <div class="nav-menu-footer">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu_principal'
                ));
                ?>
            </div>
        </div>
</footer>
</body>

</html>