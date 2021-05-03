document.addEventListener('DOMContentLoaded', function(){
    const nav = document.querySelector('nav')
    const navLinks = document.querySelectorAll('.nav-link')
    const navList = document.querySelector('.navbar .container div')
    
    function addShadow(){
        if(window.scrollY >= 300) {
            navbar.classList.add('shadow-bg')
        }
        else{
            navbar.classList.remove('shadow-bg')
        }
    }

    navLinks.forEach(item => item.addEventListener('click', () => navList.classList.remove('show')))

    document.addEventListener('scroll', addShadow)
    
})
