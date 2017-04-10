function showPopup(popup)
{
    var p = document.getElementById(popup);
    p.style.display = 'block';
}

function closePopup(popup)
{
    var p = document.getElementById(popup);
    p.style.display = 'none';
}

$(document).ready(function () {     //NU MERGE
    var $addEmployee = $('#addEmployee');

        $addEmployee.click(function () {
                var _action = $('#addEmployeeAction'). val();
                var _name = $('#addEmployeeName').val();
                var _surname = $('#addEmployeeSurname').val();
                var _cnp = $('#addEmployeeCNP').val();
                var _address = $('#addEmployeeAddress').val();
                var _sex = $('#addEmployeeSex').val();
                var _hiringDate = $('#addEmployeeHiringDate').val();
                var _birthDate = $('#addEmployeeBirthDate').val();
                var _salary = $('#addEmployeeSalary').val();
                var _hoursWorkedWeekly = $('#addEmployeeHoursWorkedWeekly').val();

                if(_name === '' && _surname === '')
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
                    $('.popup-loading').css('visibility', 'visible');
                    $.post(
                        'file/actions.php',
                        {   //trebuie toate?
                            action: _action,
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
                            $('.popup-loading').css('visibility', 'hidden');
                            if(data.startsWith('Success'))
                            {
                                //var employee_id = data.substr(20);  *ca la blog? --> see popup.js*
                                $('#addEmployeeForm')[0].reset();
                                closePopup('addEmployeePopup');
                            }
                            else {
                                alert(data);
                            }
                        }
                    );
                }
            }

        );
    });      //end of addEmployee.click

$(document).ready(function () {     //NU ESTE IMPLEMENTAT + NU ESTE SCRIS FORM-ul
    var $editEmployee = $('#editEmployee');

        $editEmployee.click(function () {
                var _action = $('#editEmployeeAction'). val();
                var _name = $('#editEmployeeName').val();
                var _surname = $('#editEmployeeSurname').val();
                var _cnp = $('#editEmployeeCNP').val();
                var _address = $('#editEmployeeAddress').val();
                var _sex = $('#editEmployeeSex').val();
                var _hiringDate = $('#editEmployeeHiringDate').val();
                var _birthDate = $('#editEmployeeBirthDate').val();
                var _salary = $('#editEmployeeSalary').val();
                var _hoursWorkedWeekly = $('#editEmployeeHoursWorkedWeekly').val();

                if(_name === '' && _surname === '')     //trebuie toate?
                {
                    $('#editEmployeeName').attr('placeholder', 'Enter name');
                    $('#editEmployeeSurname').attr('placeholder', 'Enter surname');
                    $('#editEmployeeCNP').attr('placeholder', 'Enter CNP');
                    $('#editEmployeeAddress').attr('placeholder', 'Enter address');
                    $('#editEmployeeSex').attr('placeholder', 'Enter sex');
                    $('#editEmployeeHiringDate').attr('placeholder', 'Enter hiring date');
                    $('#editEmployeeBirthDate').attr('placeholder', 'Enter birth date');
                    $('#editEmployeeSalary').attr('placeholder', 'Enter salary');
                    $('#editEmployeeHoursWorkedWeekly').attr('placeholder', 'Enter hours worked weekly');
                }
                else {
                    $('.popup-loading').css('visibility', 'visible');
                    $.post(
                        'file/actions.php',
                        {   //trebuie toate?
                            action: _action,
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
                            $('.popup-loading').css('visibility', 'hidden');
                            if(data.startsWith('Success'))
                            {
                                //var employee_id = data.substr(20);  *ca la blog? --> see popup.js*
                                $('#editEmployeeForm')[0].reset();
                                closePopup('editEmployeePopup');
                            }
                            else {
                                alert(data);
                            }
                        }
                    );
                }
            }

        );
    });      //end of editEmployee.click
