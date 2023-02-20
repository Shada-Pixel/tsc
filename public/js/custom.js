

// On page load, check if dark mode is set in local storage
if (localStorage.getItem('color-theme') === 'dark' || (window.matchMedia('(prefers-color-scheme: dark)').matches && !localStorage.getItem('color-theme'))) {
    document.documentElement.classList.add('dark');
    localStorage.setItem('color-theme', 'dark');
} else {
    document.documentElement.classList.remove('dark');
    localStorage.removeItem('color-theme');
}

// Dark mode toggle
function darkModeToggle() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.removeItem('color-theme');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('color-theme', 'dark');
    }
}

// Sidebar toggle


$(document).ready(function () {
    $('#sidemenutoggle').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('rotate-180');
        $('#sidebar').toggleClass('w-52','w-64');
        $('#siteLogo').toggleClass('hidden', 'flex');
        $('.sidelinktext').toggleClass('hidden');
        $('.sidenav a').toggleClass('justify-start','justify-center');
    });

    // success notification
    setTimeout(function(){$( "#notificationflush" ).fadeOut(1000)}, 3000);

    $('input[required], textarea[required], select[required]').each(function() {
        $(this).prev('label').append('<span class="text-red-500">*</span>');
    });




});



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



// Only number in text
$('input.onlynumber').keyup(function(e){
    if (/\D/g.test(this.value)){
      this.value = this.value.replace(/\D/g, '');
    }
});
