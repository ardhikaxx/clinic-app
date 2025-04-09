// Toggle Sidebar
document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.getElementById('wrapper').classList.toggle('toggled');
});

// Auto close alerts
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000);

// Responsive behavior
function handleResponsive() {
    const wrapper = document.getElementById('wrapper');
    if (window.innerWidth <= 768) {
        wrapper.classList.add('toggled');
    } else {
        wrapper.classList.remove('toggled');
    }
}

// Init dan event listener
window.addEventListener('DOMContentLoaded', handleResponsive);
window.addEventListener('resize', handleResponsive);