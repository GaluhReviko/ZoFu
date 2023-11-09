let prevScrollPos = window.pageYOffset;

window.onscroll = function () {
  let currentScrollPos = window.pageYOffset;
  const navbar = document.querySelector('.navbar');

  if (prevScrollPos > currentScrollPos) {
    // User is scrolling up, show the navbar
    navbar.style.top = '0';
    navbar.style.display = 'block';
  } else {
    // User is scrolling down, hide the navbar
    navbar.style.top = '-80px'; // Adjust this value to control the hiding distance
  }

  prevScrollPos = currentScrollPos;
};