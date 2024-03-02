// Create task button should add a row of input
// fields and create a task after submission
$(document).ready(function (e) {
    var mLst = $("#main");

    // Show confirm button and convert task details to input fields when modify is clicked
    mLst.on("click", "button.modify", function (e) {
        e.preventDefault();

        //Hide modify, show modify2 (aka confirmation button)
        $(this).hide();
        $(this).parent().find(".delete").hide(); //Hide delete button
        $(this).parent().find(".modify2").show(); //Show confirm button
        $(this).parent().find(".mdCancel").show(); //Show cancel button (mdCancel)

        //Get elements
        var tr = $(this).parent().parent();
        var title = tr.find(".title");
        var description = tr.find(".description");
        var dueDate = tr.find(".dueDate");
        var TimeEstimate = tr.find(".timeEstimate");
        var progress = tr.find(".progress");
        var status = tr.find(".status");
        var priority = tr.find(".priority");
        
        //Get specifc values for status, priority, and progress
        var statusVal = status.text() == "Not Started" ? 1 : status.text() == "In Progress" ? 2 : 3;
        var priorityVal = priority.text() == "High" ? 3 : priority.text() == "Medium" ? 2 : 1;
        var progressVal = progress.text().substring(0, progress.text().length - 1);
        //Whether progress should be disabled or not (if task status is Completed or Not Started)
        var progressDisable = statusVal == 1 ? "disabled='true'" : statusVal == 3 ? "disabled='true'" : " ";
        
        //Modify html and add input fields
        title.html(`<input name='Title' type='text' required value='${title.text()}'></input>`);
        description.html(`<input name='Description' type='text' required value='${description.text()}'></input>`);
        dueDate.html(`<input name='DueDate' type='date' required value='${dueDate.text()}'></input>`);
        TimeEstimate.html(`<input name='TimeEstimate' type='number' min=0 required value='${TimeEstimate.text()}'></input>`);
        progress.html(`<input name='Progress' type='range' min=0 max=100 required
                        value='${progressVal}' ${progressDisable}></input><span>${progress.text()}</span>`);
        status.html(`<select name="Status">
                    <option value=1>Not Started
                    <option value=2>In Progress
                    <option value=3>Completed
                    </select>`);
        priority.html(`<select name="Priority">
                       <option value=3>High
                       <option value=2>Medium
                       <option value=1>Low
                       </select>`);

        //Set status and priority values
        status.find(`option[value='${statusVal}']`).attr("selected", "true");
        priority.find(`option[value=${priorityVal}]`).attr("selected", "true");

    });
});
