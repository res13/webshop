function billingDiffers(cb) {
    let billingDiv = document.getElementById("billingDiv");
    if (cb.checked) {
        billingDiv.style.display = "block";
    }
    else {
        billingDiv.style.display = "none";
    }
}

function filterProducts() {
    let input, filter, productWrapper, productList, product, name, i;
    input = document.getElementById("productFilterText");
    filter = input.value.toUpperCase();
    productWrapper = document.getElementById("productList");
    productList = productWrapper.getElementsByTagName("div");
    for (i = 0; i < productList.length; i++) {
        product = productList[i];
        name = product.getAttribute("data-name");
        if (name) {
            if (name.toUpperCase().indexOf(filter) > -1) {
                product.style.display = "";
            } else {
                product.style.display = "none";
            }
        }
    }
}

function validateForm(id, validateFunctions) {
    let element = document.getElementById(id);
    element.style.borderColor = "initial";
    validateFunctions.forEach(function (validateFunction) {
        if (!validateFunction(element)) {
            element.style.borderColor = "Red";
            return false;
        }
    });
    return true;
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

function validateMoreThan3(element) {
    return element.value.length > 3;
}

function validateDate(element) {
    let date = new Date(element.value);
    return date instanceof Date;
}

function validateOnlyText(element) {
    let onlyTextRegex = /^([a-zA-Z]+)$/;
    return onlyTextRegex.test(element.value);
}

function validateUsername(element) {
    let onlyUsernameRegex = /^([a-zA-Z0-9_\-]+)$/;
    return onlyUsernameRegex.test(element.value);
}

function validateOnlyTextAndNumbers(element) {
    let onlyUsernameRegex = /^([a-zA-Z0-9]+)$/;
    return onlyUsernameRegex.test(element.value);
}

function validateOnlyNumbers(element) {
    let onlyUsernameRegex = /^([0-9]+)$/;
    return onlyUsernameRegex.test(element.value);
}

function validateCountry(element) {
    return element.value == 1;
}

function validateLanguage(element) {
    return element.value === 'de' || element.value === 'en';
}