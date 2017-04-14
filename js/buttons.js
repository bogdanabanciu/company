function addDepartment() {
    var _action = $('#addDepartmentAction').val();
    var _name = $('#addDepartmentName').val();

    if ( _name === '' )
        $('#addDepartmentName').attr('placeholder', 'Enter department name');
    else
    {
        $.post(
            '../file/actions.php',
            {
                action: _action,
                name: _name,
            },
            function(data)
            {
                //$('.popup-loading').css('visibility', 'hidden');
                if(data.startsWith('Success'))
                {
                    location.href = 'departmentList.php';
                }
                else {
                    alert(data);
                }
            }
        );
    }
}

function addProject() {
    var _action = $('#addProjectAction').val();
    var _name = $('#addProjectName').val();
    var _budget = $('#addProjectBudget').val();
    var _deadline = $('#addProjectDeadline').val();

    var e = document.getElementById("addProjectDepartment");
    var _department = e.options[e.selectedIndex].value;

    e = document.getElementById("addProjectManager");
    var _manager = e.options[e.selectedIndex].value;

    if ( _name === '' || _budget === '' || _deadline === '' || _department == -1 || _manager == -1) {
        $('#addProjectName').attr('placeholder', 'Enter department name');
        $('#addProjectBudget').attr('placeholder', 'Enter department budget');
        $('#addProjectDeadline').attr('placeholder', 'Enter department deadline');
    }
    else
    {
        $.post(
            '../file/actions.php',
            {
                action: _action,
                name: _name,
                budget: _budget,
                deadline: _deadline,
                department: _department,
                manager: _manager
            },
            function(data)
            {
                //$('.popup-loading').css('visibility', 'hidden');
                if(data.startsWith('Success'))
                {
                    location.href = 'projectList.php';
                }
                else {
                    alert(data);
                }
            }
        );
    }
}

function addEmployee() {
    var _action = $('#addEmployeeAction'). val();
    var _name = $('#addEmployeeName').val();
    var _surname = $('#addEmployeeSurname').val();''
    var _cnp = $('#addEmployeeCNP').val();
    var _address = $('#addEmployeeAddress').val();
    var _sex = $('#addEmployeeSex').val();
    var _hiringDate = $('#addEmployeeHiringDate').val();
    var _birthDate = $('#addEmployeeBirthDate').val();
    var _salary = $('#addEmployeeSalary').val();
    var _hoursWorkedWeekly = $('#addEmployeeHoursWorkedWeekly').val();

    var e = document.getElementById("addEmployeeDepartment");
    var _department = e.options[e.selectedIndex].value;

    e = document.getElementById("addEmployeeSupervisor");
    var _supervisor = e.options[e.selectedIndex].value;

    if(_department == -1 || _supervisor == -1 || _name === '' || _surname === '' || _cnp === '' || _address === '' ||
        _sex === '' || _hiringDate === '' || _birthDate === '' || _salary === '' || _hoursWorkedWeekly === '')
    {
        $('#addEmployeeName').attr('placeholder', 'Enter name');
        $('#addEmployeeSurname').attr('placeholder', 'Enter surname');
        $('#addEmployeeCNP').attr('placeholder', 'Enter CNP');
        $('#addEmployeeAddress').attr('placeholder', 'Enter address');
        $('#addEmployeeSex').attr('placeholder', 'Enter sex');
        $('#addEmployeeHiringDate').attr('placeholder', 'Enter hiring date');
        $('#addEmployeeBirthDate').attr('placeholder', 'Enter birth date');
        $('#addEmployeeSalary').attr('placeholder', 'Enter salary');
        $('#addEmployeeHoursWorkedWeekly').attr('placeholder', 'Enter hours worked weekly');
    }
    else {
        //$('.popup-loading').css('visibility', 'visible');
        $.post(
            '../file/actions.php',
            {
                action: _action,
                id_department: _department,
                id_supervisor: _supervisor,
                name: _name,
                surname: _surname,
                cnp: _cnp,
                address: _address,
                sex: _sex,
                hiring_date: _hiringDate,
                birth_date: _birthDate,
                salary: _salary,
                hours_worked_weekly: _hoursWorkedWeekly
            },
            function(data)
            {
                //$('.popup-loading').css('visibility', 'hidden');
                if(data.startsWith('Success'))
                {
                    $('#addEmployeeModal').hide();
                }
                else {
                    alert(data);
                }
            }
        );
    }
}

function executeAction(_action, _id, _location)
{
    $.post(
        '../file/actions.php',
        {
            action: _action,
            id: _id
        },
        function(data)
        {
            //$('.popup-loading').css('visibility', 'hidden');
            if(data.startsWith('Success'))
            {
                location.href = _location;
            }
            else {
                alert(data);
            }
        }
    );
}

$(document).ready(function () {

    $('#addEmployeeModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('addEmployeeForm'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        //alert("aici?");




        //modal.find('.modal-title').text('New message to ' + recipient);
        //modal.find('.modal-body input').val(recipient);

    });
});