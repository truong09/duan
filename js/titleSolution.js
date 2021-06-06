titleProcessSmall = title => {
    if ($(window).width() < 1000) {
        if (title.length > 10) return title.slice(0, 10) + "...";
        else return title;

    }else if ($(window).width() > 1000 && $(window).width() < 1450) {
        if (title.length > 15) return title.slice(0, 15) + "...";
        else return title;

    } else {
        if (title.length > 30) return title.slice(0, 30) + "...";
        else return title;
    }
}

titleProcessLarge = title => {
    if ($(window).width() < 850) {
        if (title.length > 10) return title.slice(0, 10) + "...";
        else return title;

    }else if ($(window).width() > 850 && $(window).width() < 1400) {
        if (title.length > 30) return title.slice(0, 30) + "...";
        else return title;

    } else {
        if (title.length > 75) return title.slice(0, 75) + "...";
        else return title;
    }
}