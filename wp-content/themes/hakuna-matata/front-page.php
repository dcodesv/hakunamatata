<?php get_header(); ?>
<!--BANNER PRINCIPAL-->
<div class="contenedor-banner">
    <div class="contenedor-banner-inner">
        <div class="text-banner">
            <h1 class="t-portada">Hakuna Matata</h1>
            <h3 class="t-entrada">Productos naturales y frescos</h3>
            <a href="http://hakunamatata.test/productos/" id="btn-productos" class="btn btn-primary">Ver Productos <i class="ri-arrow-right-fill"></i></a>
        </div>
        <div class="video-banner">
            <button class="play-video"><i class="ri-play-circle-fill"></i><span>Reproducir video</span></button>
        </div>
    </div>
</div>

<!--Cotizaciones-->
<section class="contenedor-cotizaciones">
    <h1 class="">Cotizar productos</h1>
    <div class="opciones-cotizaciones">
        <form action="#">
            <div class="col">
                <span>Producto:</span>
                <select name="product" id="">
                    <option value="">Lechuga Hidropónica</option>
                    <option value="">Baby Lechuga</option>
                    <option value="">Lechuga Escarola</option>
                    <option value="">Lechuga de palmita</option>
                    <option value="">Lechuga Romana</option>
                    <option value="">Arúgula</option>
                    <option value="">Menta</option>
                    <option value="">Romero</option>
                    <option value="">Ejote</option>
                    <option value="">Tomillo</option>
                </select>
            </div>
            <div class="col">
                <span>Cantidad:</span>
                <div class="inner-col">
                    <input type="number" name="" id="" min="1" max="9999" value="1" /><span>lb</span>
                </div>
            </div>
            <div class="col">
                <span></span>
                <button type="submit" id="btn-cotizacion" class="btn btn-primary">Enviar Cotización</button>
            </div>
            <div class="col">
                <span></span>
                <a href="" id="btn-cotizacion-mas" class="btn btn-primary">Cotizar más productos</a>
            </div>
        </form>
    </div>
</section>


<!--NUESTOS SOCIOS-->
<section class="nts-scs">
    <div class="nts-logos">
        <img class="nts-logos-item" src="<?php echo get_stylesheet_directory_uri() ?>/img/walmart.png" alt="">
        <img class="nts-logos-item" src="<?php echo get_stylesheet_directory_uri() ?>/img/despensa-de-don-juan.png" alt="">
        <img class="nts-logos-item" src="<?php echo get_stylesheet_directory_uri() ?>/img/super-selectos.png" alt="">
    </div>
</section>


<section class="section-about">
    <div class="about-cont">
        <img src="<?php echo get_stylesheet_directory_uri() ?>/img/lechuga-hidroponica.jpg" alt="muestra">
        <div class="about-cont-inner">
            <h1>Acerca de Nosotros</h1>
            <p>
                HAKUNA MATATA. S.A de C.V se constituyó formalmente en el año 2016, previa realización de actividades y
                adecuaciones
                para la actividad que se realizaría desde el 2015. Nació con la idea de innovar la agricultura tradicional
                que se realiza en
                el país, mediante la implementación de técnología en los cultivos y principalmente el desarrollo de
                hipodronía a gran escala. <br>Hakuna Matata
                es la única empresa productora de vegetales
                y de hierbas que cuenta con certificación orgánica bajo la norma NOP USDA.
            </p>
            <a href="http://hakunamatata.test/acerca-de-nosotros/" class="btn btn-outline">Conocer más</a>
        </div>
    </div>
</section>

<section id="contacto" class="contacto">
    <h1>Contacta con Nosotros</h1>
    <div class="form-contenedor">
        <form action="">
            <h2>Formulario de contacto</h2>
            <p>Si deseas comunicarte con nostros, completa el siguiente formulario.</p>
            <input type="text" placeholder="Nombre Completo"><br>
            <input type="text" placeholder="correo@email.com"><br>
            <textarea name="msj" id="textarea-f" cols="30" rows="8" placeholder="Por favor, escriba su mensaje aquí"></textarea><br>
            <button id="btn-send" class="btn btn-primary">Enviar Mensaje</button>
        </form>
    </div>
    <div class="map-contenedor">
        <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.023894808394!2d-89.5835348495156!3d13.717002601747144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f62cfe576cecc51%3A0xc6136944638f1da9!2sFinca%20Los%20Angeles!5e0!3m2!1ses!2ssv!4v1571282240822!5m2!1ses!2ssv" 
            frameborder="0" allowfullscreen="">
        </iframe>
    </div>
</section>


<?php get_footer(); ?>