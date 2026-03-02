const countdownTimer = {
    targetDate: new Date("Feb 29, 2090 10:00:00").getTime(),

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

setInterval(() => {
    countdownTimer.update();
}, 1000);


const rsvpForm = document.querySelector(".rsvp-form");
  rsvpForm.addEventListener("submit", function(event) {
    event.preventDefault();
    const name = document.getElementById("name").value;
    alert(`Terima kasih, ${name}!.`);
    rsvpForm.reset();
  });

