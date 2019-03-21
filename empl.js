  window.setInterval(function(){ // Set interval for checking
    var date = new Date(); // Create a Date object to find out what time it is
    if(date.getDay() === 30 && date.getMonth() === 11){ 
        alert ("This year you got a bonus of" <?php echo $primeT?>);
    }
}, 60000);

