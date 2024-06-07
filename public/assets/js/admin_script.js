let body = document.body;

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   searchForm.classList.remove('active');
}

let searchForm = document.querySelector('.header .flex .search-form');

document.querySelector('#search-btn').onclick = () =>{
   searchForm.classList.toggle('active');
   profile.classList.remove('active');
}

let sideBar = document.querySelector('.side-bar');

document.querySelector('#menu-btn').onclick = () =>{
   sideBar.classList.toggle('active');
   body.classList.toggle('active');
}

document.querySelector('.side-bar .close-side-bar').onclick = () =>{
   sideBar.classList.remove('active');
   body.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   searchForm.classList.remove('active');

   if(window.innerWidth < 1200){
      sideBar.classList.remove('active');
      body.classList.remove('active');
   }

}

let toggleBtn = document.querySelector('#toggle-btn');
let darkMode = localStorage.getItem('dark-mode');

const enabelDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}


toggleBtn.onclick = (e) =>{
   let darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enabelDarkMode();
   }else{
      disableDarkMode();
   }
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}


// Script to close the popup after 3 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.querySelectorAll('.popup-message').forEach(function(el) {
            el.style.display = 'none';
        });
    }, 3000);

    // Menutup modal box saat tombol "OK" pada pesan sukses diklik
    document.querySelectorAll('.tutupbut').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('success-message').style.display = 'none';
        });
    });

    document.querySelectorAll('.tutupbutup').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('success-message').style.display = 'none';
        });
    });
});


function closeModalAndClearSession() {
    // Menghilangkan modal
    document.getElementById('success-message').style.display = 'none';

    // Mengirim permintaan HTTP untuk menghapus session
    fetch('/clear-session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to clear session');
        }
        // Jika berhasil, perbarui halaman
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

