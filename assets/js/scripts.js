// JavaScript Document

$(document).ready(function() {

    AOS.init({
        duration: 1500,
        delay: 20,
    });

    window.addEventListener('load', AOS.refresh);
});