// Create task button should add a row of input
// fields and create a task after submission

$(document).ready(function (e) {

    //Get elements
    var mLst = $("#main");
    var crBtn = $("#create");
    var crBtn2 = $("#create2");
    var cancel = $("#crCancel");
    var nr = $("<tr></tr>");
    var td;

    //Add input fields for task creation when create button is clicked
    crBtn.click(function (e) {
        e.preventDefault();

        //Create "input" field "td" element
        for (var i = 0; i < 7; i++) {
            switch (i) {
                case 0:
                    td = $("<td></td>").append('<input name="Title" type="text" required></input>');
                    break;
                case 1:
                    td = $("<td></td>").append('<input name="Description" type="text" required></input>');
                    break;
                case 2:
                    td = $("<td></td>").append('<input name="DueDate" type="date" required></input>');
                    break;
                case 3:
                    td = $("<td></td>").append('<input name="TimeEstimate" type="number" placeholder="in minutes" min=1></input>');
                    break;
                case 4:
                    td = $("<td></td>").append('<input name="Progress" type="range" min=0 max=100 disabled="true"></input> <span>0%</span>');
                    break;
                case 5:
                    td = $("<td></td>").append('<select name="Status"><option value=1>Not Started</option><option value=2>In Progress</option><option value=3>Completed</option></select>');
                    break;
                case 6:
                    td = $("<td></td>").append('<select name="Priority"><option value=1>Low</option><option value=2>Medium</option><option value=3>High</option></select>');
                    break;
                default:
                    break;
            }
            //Add "td" to new table row
            td.appendTo(nr);
        }

        //Add row to table
        mLst.append(nr);

        //Update button display to show "Cancel" and "Confirm" buttons
        crBtn.hide();
        crBtn2.show();
        cancel.show();
    });

    //Cancel task creation
    cancel.click(function (e) {
        e.preventDefault();
        
        //Remove new row
        nr.remove();
        
        //Update button display to show "Create Task" button
        cancel.hide();
        crBtn2.hide();
        crBtn.show();

        //Reset nr and td for future task creations
        nr = $("<tr></tr>");
        td = $("<td></td>");
    })

    //For form input related enhancements and effects
    mLst.on("input", 'input[type="range"]', function (e) {
        //Update the span next to the range input
        $(this).next().text($(this).val() + "%");
    });

    mLst.on("change", 'select[name="Status"]', function (e) {
        var progInp = $(this).closest('td').prev().find('input[type="range"]');
        if ($(this).val() == 1) {
            progInp.val(0).next().text("0%");
            progInp.prop("disabled", true);
        } else if ($(this).val() == 3) {
            progInp.val(100).next().text("100%");
            progInp.prop("disabled", true);
        } else {
            progInp.prop("disabled", false);
        }
    });
});
