function billingDiffers(cb) {
    let billingDiv = document.getElementById("billingDiv");
    if (cb.checked) {
        billingDiv.style.display = "block";
    }
    else {
        billingDiv.style.display = "none";
    }
}
