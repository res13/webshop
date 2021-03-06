function billingDiffers(cb) {
    let billingDiv = document.getElementById("billingDiv");
    if (cb.checked) {
        billingDiv.style.display = "block";
    }
    else {
        billingDiv.style.display = "none";
    }
}

function validateForm(id, validateFunctions) {
    let element = document.getElementById(id);
    if (element != null) {
        let result = true;
        element.style.borderColor = "initial";
        validateFunctions.forEach(function (validateFunction) {
            if (!validateFunction(element)) {
                element.style.borderColor = "Red";
                result = false;
            }
        });
        return result;
    }
    return false;
}

function validateNotEmpty(element) {
    return element.value !== "";
}

function validateMoreThan5(element) {
    return element.value.length > 5;
}

function validateEmail(element) {
    let emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return emailRegex.test(element.value);
}

function validateLessThan51(element) {
    return element.value.length < 51;
}

function validateLessThan256(element) {
    return element.value.length < 256;
}

function validateLessThan21(element) {
    return element.value.length < 21;
}

function validateMoreThan2(element) {
    return element.value.length > 2;
}

function validateDate(element) {
    let date = new Date(element.value);
    return date instanceof Date;
}

function validateOnlyText(element) {
    let regex = /^([a-zA-Z]+)$/;
    return regex.test(element.value);
}

function validateUsername(element) {
    let regex = /^([a-zA-Z0-9_\-]+)$/;
    return regex.test(element.value);
}

function validateOnlyTextAndNumbers(element) {
    let regex = /^([a-zA-Z0-9]+)$/;
    return regex.test(element.value);
}

function validateOnlyNumbers(element) {
    let regex = /^([0-9]+)$/;
    return regex.test(element.value);
}

function validateCountry(element) {
    return element.value == 1;
}

function validateLanguage(element) {
    return element.value === 'de' || element.value === 'en';
}

function validatePasswordSame(password1, password2) {
    let password1Element = document.getElementById(password1);
    let password2Element = document.getElementById(password2);
    if (password1Element != null && password2Element != null) {
        password1Element.style.borderColor = "initial";
        password2Element.style.borderColor = "initial";
        if (password1Element.value !== password2Element.value) {
            password1Element.style.borderColor = "Red";
            password2Element.style.borderColor = "Red";
            return false;
        }
        return true;
    }
    return false;
}

function validateLogin() {
    let result = true;
    result &= validateForm('usernameOrEmail', [validateMoreThan2, validateLessThan256]);
    result &= validateForm('password', [validateMoreThan5, validateLessThan256]);
    return result == 1 ? true : false;
}

function validateForgotPassword() {
    let result = true;
    result &= validateForm('email', [validateMoreThan2, validateLessThan256, validateEmail]);
    return result == 1 ? true : false;
}

function validateRegister() {
    let result = true;
    result &= validateForm('firstname', [validateNotEmpty, validateLessThan51, validateOnlyText]);
    result &= validateForm('lastname', [validateNotEmpty, validateLessThan51, validateOnlyText]);
    result &= validateForm('username', [validateMoreThan2, validateLessThan21, validateUsername]);
    result &= validateForm('email', [validateMoreThan2, validateLessThan256, validateEmail]);
    result &= validateForm('password', [validateMoreThan5, validateLessThan256]);
    result &= validatePasswordSame('password', 'passwordRepeat');
    result &= validateForm('birthdate', [validateNotEmpty, validateDate]);
    result &= validateForm('phone', [validateMoreThan5, validateOnlyNumbers, validateLessThan21]);
    result &= validateForm('street', [validateNotEmpty, validateOnlyTextAndNumbers]);
    result &= validateForm('homenumber', [validateNotEmpty, validateOnlyTextAndNumbers]);
    result &= validateForm('city', [validateNotEmpty, validateOnlyTextAndNumbers]);
    result &= validateForm('zip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21]);
    result &= validateForm('country', [validateNotEmpty, validateCountry]);
    result &= validateForm('lang', [validateNotEmpty, validateLanguage]);
    return result == 1 ? true : false;
}

function validateUserChange() {
    let result = true;
    result &= validateForm('firstname', [validateNotEmpty, validateLessThan51, validateOnlyText]);
    result &= validateForm('lastname', [validateNotEmpty, validateLessThan51, validateOnlyText]);
    result &= validateForm('username', [validateMoreThan2, validateLessThan21, validateUsername]);
    result &= validateForm('email', [validateMoreThan2, validateLessThan256, validateEmail]);
    result &= validatePasswordSame('password', 'passwordRepeat');
    result &= validateForm('birthdate', [validateNotEmpty, validateDate]);
    result &= validateForm('phone', [validateMoreThan5, validateOnlyNumbers, validateLessThan21]);
    result &= validateForm('street', [validateNotEmpty, validateOnlyTextAndNumbers]);
    result &= validateForm('homenumber', [validateNotEmpty, validateOnlyTextAndNumbers]);
    result &= validateForm('city', [validateNotEmpty, validateOnlyTextAndNumbers]);
    result &= validateForm('zip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21]);
    result &= validateForm('country', [validateNotEmpty, validateCountry]);
    result &= validateForm('lang', [validateNotEmpty, validateLanguage]);
    return result == 1 ? true : false;
}

function validateResetPassword() {
    let result = true;
    result &= validateForm('usernameOrEmail', [validateMoreThan2, validateLessThan256]);
    result &= validateForm('oldPassword', [validateMoreThan5, validateLessThan256]);
    result &= validateForm('newPassword', [validateMoreThan5, validateLessThan256]);
    result &= validatePasswordSame('newPassword', 'repeatNewPassword');
    return result == 1 ? true : false;
}

alreadyDialogShown = false;

function validateCheckout(title, text, yes, no) {
    let result = true;
    result &= validateForm('deliveryFirstname', [validateNotEmpty, validateLessThan51, validateOnlyText]) &
      validateForm('deliveryLastname', [validateNotEmpty, validateLessThan51, validateOnlyText]) &
      validateForm('deliveryStreet', [validateNotEmpty, validateOnlyTextAndNumbers]) &
      validateForm('deliveryHomenumber', [validateNotEmpty, validateOnlyTextAndNumbers]) &
      validateForm('deliveryCity', [validateNotEmpty, validateOnlyTextAndNumbers]) &
      validateForm('deliveryZip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21]) &
      validateForm('deliveryCountry', [validateNotEmpty, validateCountry]);
    let billingDiffersCB = document.getElementById('billingDiffersCB');
    if (billingDiffersCB != null && billingDiffersCB.checked) {
        result &= validateForm('billingFirstname', [validateNotEmpty, validateLessThan51, validateOnlyText]) &
          validateForm('billingLastname', [validateNotEmpty, validateLessThan51, validateOnlyText]) &
          validateForm('billingStreet', [validateNotEmpty, validateOnlyTextAndNumbers]) &
          validateForm('billingHomenumber', [validateNotEmpty, validateOnlyTextAndNumbers]) &
          validateForm('billingCity', [validateNotEmpty, validateOnlyTextAndNumbers]) &
          validateForm('billingZip', [validateNotEmpty, validateOnlyNumbers, validateLessThan21]) &
          validateForm('billingCountry', [validateNotEmpty, validateCountry]);
    }
    if(result == 1 ? true : false){
        if (!alreadyDialogShown) {
            showDialog(title, text, yes, no);
            return false;
        } else {
            alreadyDialogShown = false;
            return true;
        }
    }
    return false;
}

function showDialog(title, text, yes, no) {
    $('<div></div>').
      appendTo('#checkout').
      html('<div><h6>'+ text +'</h6></div>').
      dialog({
          modal: true,
          title: title,
          width: 300,
          height: 'auto',
          resizable: false,
          buttons: [
              {
                  text: yes,
                  click: function () {
                      alreadyDialogShown = true;
                      $('form#checkout').submit();
                  }
              },
              {
                  text: no,
                  click: function () {
                      $('#msg').show();
                      $(this).dialog("close");
                  }
              }
          ],
          close: function (event, ui) {
              $(this).remove();
          }
      });
    $('#msg').hide();
}

function validateUser() {

}

function validateAddProduct() {

}