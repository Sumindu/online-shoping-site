  // Function to close the alert with a fading effect after 1 second
  function closeAlert(alert) {
    setTimeout(function() {
      alert.style.opacity = 1;
      var fadeEffect = setInterval(function () {
        if (!alert.style.opacity) {
          alert.style.opacity = 1;
        }
        if (alert.style.opacity > 0) {
          alert.style.opacity -= 0.1;
        } else {
          clearInterval(fadeEffect);
          alert.style.display = 'none';
        }
      }, 50); // 100 milliseconds interval for smooth fading
    }, 500); // 1000 milliseconds = 1 second
  }

  // Automatically close alerts after 3 seconds (1 second delay + 2 seconds for fading)
  var alerts = document.querySelectorAll('.alert');
  alerts.forEach(function(alert) {
    closeAlert(alert);
  });