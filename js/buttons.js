/*$(document).ready(function(){
    $(".dropdown-menu li a").click(function(){
        $("#selected").text($(this).text());
    });
});
*/

function addEmployee() {
    var _action = $('#addEmployeeAction'). val();
    var _department = $('#addEmployeeDepartment').val();
    var _supervisor = $('#addEmployeeSupervisor').val();
    var _name = $('#addEmployeeName').val();
    var _surname = $('#addEmployeeSurname').val();''
    var _cnp = $('#addEmployeeCNP').val();
    var _address = $('#addEmployeeAddress').val();
    var _sex = $('#addEmployeeSex').val();
    var _hiringDate = $('#addEmployeeHiringDate').val();
    var _birthDate = $('#addEmployeeBirthDate').val();
    var _salary = $('#addEmployeeSalary').val();
    var _hoursWorkedWeekly = $('#addEmployeeHoursWorkedWeekly').val();

    alert("am primit ceva");

    if(_department === '' || _name === '' || _surname === '' || _cnp === '' || _address === '' || _sex === '' || _hiringDate === '' ||
        _birthDate === '' || _salary === '' || _hoursWorkedWeekly === '')
    {
        $('#addEmployeeDepartment').attr('placeholder', 'Enter name');
        $('#addEmployeeSupervisor').attr('placeholder', 'Enter name');
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
                department: _department,
                supervisor: _supervisor,
                name: _name,
                surname: _surname,
                cnp: _cnp,
                address: _address,
                sex: _sex,
                hiringDate: _hiringDate,
                birthDate: _birthDate,
                salary: _salary,
                hoursWorkedWeekly: _hoursWorkedWeekly
            },
            function(data)
            {
                //$('.popup-loading').css('visibility', 'hidden');
                if(data.startsWith('Success'))
                {
                    //var employee_id = data.substr(20);  *ca la blog? --> see popup.js*
                    //$('#addEmployeeForm')[0].reset();
                    //closePopup('addEmployeePopup');
                    alert(data);
                    //var modal = $(this);
                    //modal.hide();
                }
                else {
                    alert(data);
                }
            }
        );
    }
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