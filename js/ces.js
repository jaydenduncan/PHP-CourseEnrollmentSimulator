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

let active_faq_answer_id = ""; // holds id of the currently open faq answer

// Display faq answer to the user
function faq_handler(target_id){
    let vals = target_id.split("_");
    let answer_id = vals[0] + "_faq_answer_" + vals[vals.length-1];
    let answerDiv = document.getElementById(answer_id);
    answerDiv.style.display = "block";
    active_faq_answer_id = answer_id;
}

// Close faq answer
function faq_close(){
    let faq_answer = document.getElementById(active_faq_answer_id);
    faq_answer.style.display = "none";
}