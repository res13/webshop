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