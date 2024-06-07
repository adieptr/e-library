
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        document.querySelectorAll('.popup-message').forEach(function(el) {
            el.style.display = 'none';
        });
    }, 3000);

    document.querySelectorAll('.tutupsal').forEach(function(btn) {
        btn.addEventListener('click', closeModalAndClearSession);
    });
});

function closeModalAndClearSession() {
    // Menghilangkan modal
    document.getElementById('gagal-message').style.display = 'none';

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
