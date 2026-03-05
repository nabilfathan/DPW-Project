const countdownTimer = {
    targetDate: new Date("Feb 28, 2090 10:00:00").getTime(),

    update: function() {
        const now = new Date().getTime();
        const distance = this.targetDate - now;
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("days").innerText = days.toString().padStart(2, '0');
        document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
        document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
        document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0'); 
    }
}
document.addEventListener('DOMContentLoaded', () => {

    countdownTimer.update();

setInterval(() => {
    countdownTimer.update();
}, 1000);
});

document.addEventListener("DOMContentLoaded", function() {
    const rsvpForm = document.querySelector(".rsvp-form");

    // Cek dulu apakah form-nya beneran ada di HTML
    if (rsvpForm) {
        rsvpForm.addEventListener("submit", function(event) {
            // 1. Stop form biar nggak refresh halaman
            event.preventDefault();

            // 2. Ambil nilai input nama
            const nameInput = document.getElementById("name");
            const name = nameInput ? nameInput.value : "Tamu";

            // 3. Tampilkan pesan
            Swal.fire({
            title: 'Terima Kasih!',
            text: `Konfirmasi kehadiran ${name} telah kami terima.`,
            icon: 'success',
            confirmButtonColor: '#d4af37' // Warna gold sesuai tema lo
        });
            // 4. Reset form setelah sukses
            rsvpForm.reset();
        });
    } else {
        console.error("Form dengan class .rsvp-form tidak ditemukan!");
    }
});

 function scrollToContent() {
            document.getElementById('pembuka').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }