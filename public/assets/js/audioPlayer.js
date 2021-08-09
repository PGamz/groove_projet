let count = 0;
const audio = document.getElementById("audio");
const audioPlayPause = document.getElementById("audioPlayPause");
const audioStop = document.getElementById("audioStop");

let track = audio;

let volume = document.querySelector("#volume-control");
volume.addEventListener("change", function (e) {
    track.volume = e.currentTarget.value / 100;
});

audioPlayPause.addEventListener("click", function () {
    let audioList;
    if (count === 0) {
        count = 1;
        audio.play();
        audioPlayPause.innerHTML = "<i class='fa fa-pause'></i>";

        audioList = document.querySelectorAll(".aTrigger");
        audioList.forEach(function (audioSingle, index) {
            const dataActive = audioSingle.getAttribute("data-active");
            if (dataActive === "pause") {
                audioSingle.setAttribute("data-active", "active");
            }
        });
    } else {
        count = 0;
        audio.pause();
        audioPlayPause.innerHTML = "<i class='fa fa-play'></i>";

        audioList = document.querySelectorAll(".aTrigger");
        audioList.forEach(function (audioSingle, index) {
            const dataActive = audioSingle.getAttribute("data-active");
            if (dataActive === "active") {
                audioSingle.setAttribute("data-active", "pause");
            }
        });
    }
});

audioStop.addEventListener("click", function () {
    count = 0;
    audio.pause();
    audio.currentTime = 0;
    audioPlayPause.innerHTML = "<i class='fa fa-pause'></i>";
    audioPlayPause.className = "";
    audioStop.className = "";
    document.getElementById("audioTitle").innerHtml = "&nbsp;";

    const audioList = document.querySelectorAll(".aTrigger");

    audioList.forEach(function (audioSingle, index) {
        const dataActive = audioSingle.getAttribute("data-active");
        if (dataActive === "active" || dataActive === "pause") {
            audioSingle.setAttribute("data-active", "");
        }
    });
});

const audioList = document.querySelectorAll(".aTrigger");
audioList.forEach(function (audioSingle, index) {
    const audioTitle = audioSingle.getAttribute("data-title");

    audioList[index].nextElementSibling.innerHTML = audioTitle;
    audioSingle.addEventListener("click", function (index) {
        let thisisAudioSingle = this;
        audioPlayPause.className = "active";
        audioStop.className = "active";
        const dataAudio = this.getAttribute("data-audio");

        const dataActive = this.getAttribute("data-active");

        const audioSource = document.getElementById("audioSource");

        audioSource.src = dataAudio;

        document.getElementById("audioTitle").innerHTML = audioTitle;

        for (let i = 0; i < audioList.length; i++) {
            audioList[i].innerHTML = "<i class='fa fa-play'></i>";
            audioList[i].setAttribute("data-active", "");
        }
        if (dataActive === "") {
            count = 1;
            audio.load();
            audio.play();
            this.setAttribute("data-active", "active");
            audioPlayPause.innerHTML = "<i class='fa fa-pause'></i>";
        } else if (dataActive === "pause") {
            count = 1;
            audio.play();
            this.setAttribute("data-active", "active");
            audioPlayPause.innerHTML = "<i class='fa fa-pause'></i>";
        } else {
            count = 0;
            audio.pause();
            this.setAttribute("data-active", "pause");
            audioPlayPause.innerHTML = "<i class='fa fa-play'></i>";
        }
        const duration = document.getElementById("duration");
        setTimeout(function () {
            let s = parseInt(audio.duration % 60);
            const m = parseInt((audio.duration / 60) % 60);
            if (s < 10) {
                s = "0" + s;
            }
            duration.innerHTML = m + ":" + s;
            audio.addEventListener(
                "timeupdate",
                function () {
                    const durationUpdate = document.getElementById("durationUpdate");
                    let s = parseInt(audio.currentTime % 60);
                    const m = parseInt((audio.currentTime / 60) % 60);
                    if (s < 10) {
                        s = "0" + s;
                    }
                    durationUpdate.innerHTML = m + ":" + s;
                    if (duration.textContent === durationUpdate.textContent) {
                        audioPlayPause.innerHTML = "<i class='fa fa-play'></i>";
                        thisisAudioSingle.setAttribute("data-active", "pause");
                        count = 0;
                    }
                },
                false
            );
        }, 200);
    });
});
