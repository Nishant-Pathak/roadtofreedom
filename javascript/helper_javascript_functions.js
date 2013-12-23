/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function collapseDiv(showDiv) {
    var categoriesDivArray = new Array('One', //MostRecent
                                       'Two', // MostPopular
                                       'Three'); //Trending
    for (itr in categoriesDivArray) {
        if ( categoriesDivArray[itr] === showDiv) {
            $('#' + showDiv).collapse('show');
        } else {
            $('#' + categoriesDivArray[itr]).collapse('hide');
        }
    }
}

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
    $('#login_form').submit();
}

function showPanelAndHideLabel() {
    $("#sidePanelLabel").hide(300, function() {
        location.href = "#sidePanel";
    });
}

function hidePanelAndShowLabel() {
    location.href = "#";
    $("#sidePanelLabel").show(300);
}




