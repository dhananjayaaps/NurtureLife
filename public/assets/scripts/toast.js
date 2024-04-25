function showToast(message, type) {
    var toast = document.getElementById("toast");
    toast.innerHTML = message;
    toast.className = "toast show " + type;

    // Create close button
    var closeButton = document.createElement("span");
    closeButton.classList.add("toast-close");
    closeButton.innerHTML = "&times;";
    closeButton.onclick = function() {
        toast.classList.remove("show");
    };
    toast.appendChild(closeButton);

    // Create timer line
    var timerLine = document.createElement("div");
    timerLine.classList.add("timer-line");
    var timerProgress = document.createElement("div");
    timerProgress.classList.add("timer-progress");
    timerLine.appendChild(timerProgress);
    toast.appendChild(timerLine);

    setTimeout(function(){
        toast.classList.remove("show");
    }, 3000);
}

// Function to show success toast
function showSuccessToast(message) {
    showToast(message, "success");
}

// Function to show error toast
function showErrorToast(message) {
    showToast(message, "error");
}