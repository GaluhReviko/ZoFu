// Data keramaian jam sewa lapangan futsal (contoh data)
const jamSewa = ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00', '24:00'];
const jumlahPemesan = [12, 15, 20, 18, 25, 16, 8, 6, 2]; // Jumlah pemesan untuk setiap jam

var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: jamSewa,
        datasets: [{
            label: 'Jumlah pemesan dalam 1 hari',
            data: jumlahPemesan,
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                stepSize: 5 // Atur langkah sumbu Y sesuai kebutuhan
            }
        }
    }
});

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

