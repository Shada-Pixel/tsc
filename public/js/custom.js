// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    localStorage.setItem('color-theme','dark');
    document.documentElement.classList.add('dark');
} else {
    localStorage.removeItem("mytime");
    document.documentElement.classList.remove('dark')
}

// Dark mode toggle
function darkModeToggle() {
    if (localStorage.getItem('color-theme') !== 'dark') {
        localStorage.setItem('color-theme','dark');
        document.documentElement.classList.add('dark');

    }else if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        localStorage.setItem('color-theme','light');
        document.documentElement.classList.remove('dark')

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
