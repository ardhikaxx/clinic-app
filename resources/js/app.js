import './bootstrap';
// Sidebar toggle
document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.getElementById('wrapper').classList.toggle('toggled');
});

// Auto close alerts
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000);

document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.getElementById('wrapper').classList.toggle('toggled');
});