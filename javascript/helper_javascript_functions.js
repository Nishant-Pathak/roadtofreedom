/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function submit_logout_form(logout_form) {
    logout_form.submit();
}

function submitOnEnter(event, buttonToClick) {
    if (event.keyCode === 13) {
        $("#".concat(buttonToClick)).click();
    }
}

function guestLogin(login_form) {
    $('#email').val('rtfguest@gmail.com');
    $('#password').val('freebsd123$%^');
    formhash(login_form, login_form.password);
}




