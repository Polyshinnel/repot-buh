
$( document ).ready(function() {
    let location = window.location.pathname;
    console.log(location)
    $('.nav-sidebar .nav-item .nav-link').each(function () {
        $(this).removeClass('active')
        let sidebarLink = $(this).attr('href');
        if(sidebarLink !== '/') {
            if(location.includes(sidebarLink)) {
                $(this).addClass('active')
            }
        }
        if(sidebarLink === location) {
            $(this).addClass('active')
        }
    })
})

