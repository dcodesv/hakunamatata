window.onload=function(){

/*Funcion para añadir reactividad al boton del menu y al menu*/
    let el = document.querySelector('#menu-mobile-button');
    let icon = document.querySelector('#menu-mobile-button i');
    el.addEventListener('click', function(){
        this.classList.toggle('active');
        if(el.classList.contains('active')){
            icon.classList.remove('ri-menu-3-fill');
            icon.classList.add('ri-close-fill');
        }else{
            icon.classList.remove('ri-close-fill');
            icon.classList.add('ri-menu-3-fill');
        }
        document.querySelector('#menu-mobile').classList.toggle('active');
    });
}
