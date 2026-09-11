// Sarvodaya Awasiya Vidyalaya - front-end scripts

document.addEventListener('DOMContentLoaded', function () {
  // Auto-hide alerts after 4 seconds
  document.querySelectorAll('.auto-alert').forEach(function (el) {
    setTimeout(function () {
      el.style.transition = 'opacity 0.5s';
      el.style.opacity = '0';
      setTimeout(function () { el.remove(); }, 500);
    }, 4000);
  });

  // Simple client-side validation feedback for contact form
  var contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      var name = contactForm.querySelector('[name=name]');
      var email = contactForm.querySelector('[name=email]');
      var message = contactForm.querySelector('[name=message]');
      if (!name.value.trim() || !email.value.trim() || !message.value.trim()) {
        e.preventDefault();
        alert('कृपया सभी आवश्यक फ़ील्ड भरें।');
      }
    });
  }
});
