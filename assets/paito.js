$(document).ready(function() {
    let selectedColor = "";

    // Memilih warna dari palet
    $(".color").click(function() {
        selectedColor = $(this).attr("data-color");
        $(".color").css("border", "1px solid #000");
        $(this).css("border", "3px solid #000");
    });

    // Mewarnai sel saat diklik
    $("#drawing-table td").click(function() {
        if (!$(this).closest('thead').length) {
            if (selectedColor === "eraser") {
                $(this).css("background-color", "transparent");
            } else if (selectedColor !== "") {
                $(this).css("background-color", selectedColor);
            }
        }
    });

    // Fitur Cari Angka (Highlight Otomatis)
    $('#asc, #kopc, #kepalac, #ekorc').keyup(function() {
        let val = $(this).val();
        let id = $(this).attr('id').charAt(0); // a, k, e, c
        if (val !== "") {
            $(".asu").each(function() {
                if ($(this).text().trim() === val) {
                    $(this).addClass(id + val);
                } else {
                    $(this).removeClass(id + $(this).text().trim());
                }
            });
        }
    });

    // Sticky Menu Palet Warna
    let colorMenu = $("#colormenu");
    if (colorMenu.length) {
        let mcolpos = colorMenu.offset().top;
        $(window).scroll(function() {
            if ($(window).scrollTop() >= mcolpos) colorMenu.addClass('fixed');
            else colorMenu.removeClass('fixed');
        });
    }
});
