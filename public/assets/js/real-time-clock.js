function updateTime() {
    const clockElement = document.getElementById("real-time-clock");
    const currentTime = new Date().toLocaleTimeString();
    clockElement.textContent = currentTime;
}

// Update the time every second (1000 milliseconds)
setInterval(updateTime, 1000);

// Initial update
updateTime();
