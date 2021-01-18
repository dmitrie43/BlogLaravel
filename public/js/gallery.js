function setBigImage(foto) {
    document.getElementById("mainImg").src = foto.src;
}

// function randColor() {
//     var r = Math.floor(Math.random() * (256)),
//         g = Math.floor(Math.random() * (256)),
//         b = Math.floor(Math.random() * (256));
//     return '#' + r.toString(16) + g.toString(16) + b.toString(16);
// }
//
// function switchBackground() {
//     const img = document.getElementById('mainImg');
//     img.style.borderColor = randColor();
// }

$(function() {
    $("#mainImg").on("click", function() {
        $(this).toggleClass("is-active");
    });
});