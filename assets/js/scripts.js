// JavaScript Document

$(document).ready(function(){
  
  AOS.init({
	  duration: 1500,
	  delay: 20,
    });
	
window.addEventListener('load', AOS.refresh);


    
const second = 1000,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;

let countDown = new Date('Nov 25, 2020 13:00:00').getTime(),
    x = setInterval(function() {    

      let now = new Date().getTime(),
          distance = countDown - now;

      document.getElementById('days').innerText = Math.floor(distance / (day)),
        document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
        document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
        document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

      //do something later when date is reached
      //if (distance < 0) {
      //  clearInterval(x);
      //  'IT'S MY BIRTHDAY!;
      //}

    }, second)

    y = setInterval(function() {    

      let now = new Date().getTime(),
          distance = countDown - now;

      document.getElementById('days2').innerText = Math.floor(distance / (day)),
        document.getElementById('hours2').innerText = Math.floor((distance % (day)) / (hour)),
        document.getElementById('minutes2').innerText = Math.floor((distance % (hour)) / (minute)),
        document.getElementById('seconds2').innerText = Math.floor((distance % (minute)) / second);

      //do something later when date is reached
      //if (distance < 0) {
      //  clearInterval(x);
      //  'IT'S MY BIRTHDAY!;
      //}

    }, second)


});


