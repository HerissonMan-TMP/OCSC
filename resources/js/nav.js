document.addEventListener('DOMContentLoaded', function () {

    // Navbar's dropdown toggle

    let ocscEvent = document.getElementById('ocsc-event');
    let ocscEventDropdown = document.getElementById('ocsc-event-dropdown');
    let ocscEventDropdownContent = document.getElementById('ocsc-event-dropdown-content');

    ocscEvent.addEventListener('mouseover', function () {
        ocscEventDropdownContent.classList.replace('hidden', 'block');
    });

    ocscEvent.addEventListener('mouseleave', function () {
        ocscEventDropdownContent.classList.replace('block', 'hidden');
    });

    let convoys = document.getElementById('convoys');
    let convoysDropdown = document.getElementById('convoys-dropdown');
    let convoysDropdownContent = document.getElementById('convoys-dropdown-content');

    convoys.addEventListener('mouseover', function () {
        convoysDropdownContent.classList.replace('hidden', 'block');
    });

    convoys.addEventListener('mouseleave', function () {
        convoysDropdownContent.classList.replace('block', 'hidden');
    });

    let recruitment = document.getElementById('recruitment');
    let recruitmentDropdown = document.getElementById('recruitment-dropdown');
    let recruitmentDropdownContent = document.getElementById('recruitment-dropdown-content');

    recruitment.addEventListener('mouseover', function () {
        recruitmentDropdownContent.classList.replace('hidden', 'block');
    });

    recruitment.addEventListener('mouseleave', function () {
        recruitmentDropdownContent.classList.replace('block', 'hidden');
    });

    // Responsive navbar toggle
    let responsiveButtonOpenNav = document.getElementById('responsive-button-open-nav');
    let responsiveButtonCloseNav = document.getElementById('responsive-button-close-nav');
    let responsiveMenu = document.getElementById('responsive-menu');

    responsiveButtonOpenNav.addEventListener('click', function() {
        responsiveMenu.classList.replace('hidden', 'block');
    });

    responsiveButtonCloseNav.addEventListener('click', function() {
        responsiveMenu.classList.replace('block', 'hidden');
    });

    $('#ocsc-event-dropdown-responsive').click(function () {
        $('#ocsc-event-dropdown-content-responsive').slideToggle();
        $(this).find('i').toggleClass('fa-angle-up', 'fa-angle-down');
    });
    $('#convoys-dropdown-responsive').click(function () {
        $('#convoys-dropdown-content-responsive').slideToggle();
        $(this).find('i').toggleClass('fa-angle-up', 'fa-angle-down');
    });
    $('#recruitment-dropdown-responsive').click(function () {
        $('#recruitment-dropdown-content-responsive').slideToggle();
        $(this).find('i').toggleClass('fa-angle-up', 'fa-angle-down');
    });
});
