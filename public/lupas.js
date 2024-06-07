function sendOTP(){
    const email = document.getElementById('email').value;

    // Generate a random number as OTP
    let otp_val = Math.floor(Math.random()*10000);

    // Simpan nilai OTP ke dalam localStorage
    localStorage.setItem('otp_val', otp_val);

    // Fetch email content from email.blade.php (diasumsikan email.blade.php mengembalikan emailBody dengan token {otp_val})
    fetch('/load-email')
    .then(response => response.text())
    .then(emailBody => {
        // Replace {otp_val} in emailBody with the actual OTP value
        emailBody = emailBody.replace('{otp_val}', otp_val);

        // Send OTP via Email using SMTP.js
        Email.send({
            SecureToken : "d34b7df6-7a9b-49e7-875c-d5018f2ce4ba",
            To : email,
            From : "daikoasikbetgilak56@gmail.com",
            Subject : "Email Verification",
            Body : emailBody
        }).then(message => {
            if(message === "OK"){
                alert("Kode OTP telah dikirim ke email Anda" + email);
                // Make OTP input visible
                document.querySelector('.otpverify').style.display = "block";
            } else {
                alert("Failed to send OTP. Please try again later.");
            }
        });
    })
    .catch(error => console.error('Error fetching email content:', error));
}

function verifyOTP(){
    const enteredOTP = document.getElementById('otp_inp').value;
    const otp_btn = document.getElementById('otp-btn');

    // Ambil nilai OTP dari localStorage
    let otp_val = localStorage.getItem('otp_val');

    if(enteredOTP === otp_val){
        alert("OTP verified successfully!");
        // Redirect user to another page after OTP verification
        window.location.href = '/update-pass'; // Change the URL to your desired page
    } else {
        alert("Invalid OTP. Please try again.");
    }
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
