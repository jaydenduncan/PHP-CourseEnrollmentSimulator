$(document).ready(function(){
    function convertTo24Hour(timeString){
        let date = new Date(`01/01/2000 ${timeString}`);

        let formattedTime = date.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        });

        return formattedTime;
    }

    let elements = document.getElementsByClassName("classSlot"); // get class slots in schedule calendar
    let startHours = [];

    // get start hours of every student class in current schedule
    for(let i=0; i<elements.length; i++){
        let classTime = elements[i].children[1].innerHTML;
        let startTime = classTime.split(" - ")[0];
        startTime = convertTo24Hour(startTime); // convert 12-hour time to 24-hour time
        let startHour = startTime.split(":")[0];
        startHours.push(parseInt(startHour));
    }

    // find minimum start hour
    startHours.sort((a, b) => a - b);
    let minStartHour = startHours[0];

    $("#scheduleDiv").scrollTop(minStartHour * 100); // scroll schedule div to top of minimum start hour
}
);