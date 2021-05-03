document.addEventListener('DOMContentLoaded', function(){
    console.log('dupa');

    const nav = document.querySelector('nav')
    function addShadow(){
        if(window.scrollY >= 300) {
            navbar.classList.add('shadow-bg')
            console.log('co jest')
        }
        else{
            navbar.classList.remove('shadow-bg')
        }
    }

    document.addEventListener('scroll', addShadow)
})

