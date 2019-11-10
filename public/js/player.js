var player = $('.player'),
    audio = $('.audio'),
    duration = $('.duration'),
    currentTime = $('.current-time'),
    progressBar = $('.process-bar'),
    volumeBar = $('.volume-bar'),
    currentVolume,
    mouseDown = false,
    mediaPath = 'https://docs.google.com/uc?id=',
    index = 0,
    showCurrentTime;
if (tracks.length > 1) {
    $.each(tracks, function (key, value) {
        var trackName = value.name;
        $('#plList').append('<li> \
                    <div class="plItem"> \
                        <span class="plTitle">' + trackName + '</span> \
                    </div> \
                </li>');
    });
}

$(document).ready(function () {
    volumeBar[0].value = audio[0].volume;
    playTrack(index);
    console.log(tracks[index])
});

function secsToMins(time) {
    var int = Math.floor(time),
        mins = Math.floor(int / 60),
        secs = int % 60,
        newTime = mins + ':' + ('0' + secs).slice(-2);

    return newTime;
}

function getCurrentTime() {
    var currentTimeFormatted = secsToMins(audio[0].currentTime);

    currentTime.text(currentTimeFormatted);
    progressBar[0].value = audio[0].currentTime;

    if (player.hasClass('playing')) {
        showCurrentTime = requestAnimationFrame(getCurrentTime);
    } else {
        cancelAnimationFrame(showCurrentTime);
    }
}


audio.on('loadedmetadata', function () {
    var durationFormatted = secsToMins(audio[0].duration);
    duration.text(durationFormatted);
    progressBar[0].max = audio[0].duration;
    progressBar[0].value = 0;
}).on('ended', function () {
    if ($('.loop-btn').hasClass('active')) {
        audio[0].currentTime = 0;
        audio[0].play();
    } else {
        player.removeClass('playing').addClass('paused');
        $('.play-btn').removeClass("fa-pause").addClass("fa-play");
        if ($('.random-btn').hasClass('active')) {
            index = Math.floor(Math.random() * tracks.length);
        } else {
            index++;
            if (index > tracks.length - 1) {
                index = 0;
            }
        }
        playTrack(index);
    }
});

progressBar.on('mousedown mouseup', function () {
    mouseDown = !mouseDown;
});

progressBar.on('click mousemove', function (e) {
    if (mouseDown || e.type === 'click') {
        audio[0].currentTime = progressBar[0].value;
    }
});

volumeBar.on('mousedown mouseup', function () {
    mouseDown = !mouseDown;
});

volumeBar.on('click mousemove', function (e) {
    if (mouseDown || e.type === 'click') {
        audio[0].volume = volumeBar[0].value;
        if (volumeBar[0].value == 0) {
            $('.mute-btn').removeClass("fa-volume-up").addClass("fa-volume-off");
            audio[0].muted = true;
        } else {
            $('.mute-btn').removeClass("fa-volume-off").addClass("fa-volume-up");
            audio[0].muted = false;
        }
    }
});

$('.play-btn').click(function () {
    if ($(this).hasClass("fa-play")) {
        playMusic();
    } else {
        $(this).removeClass("fa-pause").addClass("fa-play");
        player.removeClass('playing').addClass('paused');
        audio[0].pause();
    }
});

$('.mute-btn').click(function () {
    if ($(this).hasClass("fa-volume-up")) {
        $(this).removeClass("fa-volume-up").addClass("fa-volume-off");
        audio[0].muted = true;
        volumeBar[0].value = 0;
    } else {
        $(this).removeClass("fa-volume-off").addClass("fa-volume-up");
        audio[0].muted = false;
        currentVolume = audio[0].volume;
        volumeBar[0].value = currentVolume;
    }
});

$('.prev-btn').on('click', function () {
    if ($('.random-btn').hasClass('active')) {
        index = Math.floor(Math.random() * tracks.length);
    } else {
        if ((index - 1) > -1) {
            index--;
        } else {
            index = tracks.length - 1;
        }
    }
    playTrack(index);
});

$('.next-btn').on('click', function () {
    if ($('.random-btn').hasClass('active')) {
        index = Math.floor(Math.random() * tracks.length);
    } else {
        if ((index + 1) <= tracks.length - 1) {
            index++;
        } else {
            index = 0;
        }
    }
    playTrack(index);
});

$('.button').click(function () {
    $(this).toggleClass("active");
});

function playMusic() {
    $('.play-btn').removeClass("fa-play").addClass("fa-pause");
    player.removeClass('paused').addClass('playing');
    audio[0].play();
    getCurrentTime();
}

$('#plList li').on('click', function () {
    var id = parseInt($(this).index());
    if (id !== index) {
        playTrack(id);
    }
});

function loadTrack(id) {
    $('.plSel').removeClass('plSel');
    $('#plList li:eq(' + id + ')').addClass('plSel');
    $('.title').text(tracks[id].name);
    index = id;
    audio[0].src = mediaPath + tracks[id].path;
}

function playTrack(id) {
    loadTrack(id);
    playMusic();
}



