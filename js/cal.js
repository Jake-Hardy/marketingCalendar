$(document).ready(function() {
    $('.container--calendar-options__shadowbox').hide();
    $('.container--calendar-options').hide();
    $('.formLoginContainer').hide();

    //console.log($('.loadFlag').val());
    if ($('.loadFlag').val() === "true") {
        loadCalendar();
    }
});

$(".buttonOptions").on("click", function() {
    $('.container--calendar-options__shadowbox').show();
    $('.container--calendar-options').show();
});

$('.buttonLogin').on("click", function() {
    $('.container--calendar-options__shadowbox').show();
    $('.formLoginContainer').show();
});

$('.buttonLogout').on("click", function() {
    $.ajax({
        type: 'POST',
        url:  'logout.php',
        success: function(response) {
            window.location.href="index.php?action=create-calendar"
        }
    });
})

$(".buttonSubmitOptions").on("click", function() {
    generateCalendar();
    $('.container--calendar-options__shadowbox').hide();
    $('.container--calendar-options').hide();
    // toggleMenu();
});

$('.buttonLoad').on('click', function() {
    if ($('.userHook').val() !== undefined) {
        window.location.href = 'select_calendar.php';
    }
    else {
        $('.errorLogin').text("You need to be logged in to do that.");
        $('.buttonLogin').click();
    }
})

$('.buttonSubmitLogin').on("click", function() {
    var username = $('.fieldUsername').val();
    $.ajax({
        type: 'POST',
        url:  'login.php',
        data: {'username' : username},
        success: function(response) {
            if (response === 'true') {
                $('.formLogin').submit();
            }
            else {
                $('.errorLogin').text(response);
            }
        }
    });

    //$('.formLogin').submit();
})

$(".input__audience").on("keydown", function(e) {
    if (e.keyCode === 13) {
        generateCalendar();
        toggleMenu();
    }
});

$('.menu__button').on("click", function() {
    toggleMenu();
});

$('.buttonSave').on("click", function() {
    if ($('.userHook').val() !== undefined) {
        save();
    }
    else {
        $('.errorLogin').text("You need to be logged in to do that.");
        $('.buttonLogin').click();
    }
});

$('.buttonClose').on("click", function() {
    $('.container--calendar-options__shadowbox').hide();
    $(this).parent().hide();
});

function generateCalendar() {
    $("div[class*=row_]").remove();
    audienceCount = $(".input__audience").val();
    //console.log(audienceCount);
    var i, j;
    for (i = 0; i <= audienceCount; i++) {
        if (i === 0) {
            var newRow = "<div class='row_header row_" + i + "'></div>";
            var currentRow = ".row_header";
        }
        else {
            var newRow = "<div class='row_" + i + "'></div>";
            var currentRow = ".row_" + i;
        }

        $(".calendar").append(newRow);
        $(currentRow).addClass("clearfix");
        var numCells = $('input[name=months]:checked').val();
        for (j = 0; j <= numCells; j++) {
            if (j === 0 || i === 0) {
                var newCell = "<div class='col_header cell_" + i + "_" + j + " editable'><p></p></div>";
            }
            else {
                var newCell = "<div class='cell_" + i + "_" + j + " editable'><p>Click to edit cell</p></div>";
            }
            var currentCell = ".cell_" + i + "_" + j;
            $(currentRow).append(newCell);
            $(currentCell).addClass("box");

            if (numCells === "3") {
                $(currentCell).addClass("cells3");
            }
            else if (numCells === "12") {
                $(currentCell).addClass("cells12");
            }
        }
    }
    $("div[class*=row_]").hide();
    $("div[class*=row_]").show(1000, "linear");
}

function toggleMenu() {
    $('.container').toggleClass('open');
    $('.container').toggleClass('closed');

    $('.menu__fold-up').toggleClass('closed');
    $('.menu__fold-up').toggleClass('open');
    if($('.menu__fold-up').hasClass('closed')) {
        $('.inputAudience').hide('slow');
    }
    else {
        $('.inputAudience').show('slow');
    }

    $('.menu__button').toggleClass('menu__closed');
    $('.menu__button').toggleClass('menu__open');
}

$(".calendar").on("click", ".editable", function() {
    if($('.menu__fold-up').hasClass('open')) {
        toggleMenu();
    }
    var textEntry = "<textarea class='textEntry input--text' wrap='hard' cols='25'></textarea>";
    $(this).children().hide();
    $(this).addClass("editing");
    $(this).append(textEntry);
    $(".textEntry").focus();
    var that = $(this);
    $(".textEntry").focusout(function(e) {
        that.children().text( $(".textEntry").val() );
        $(".textEntry").remove();
        that.removeClass("editing");
        that.children().show();
        if(!that.hasClass("calendar--title")) {
            checkHeight(that);
        }
    })
});

function checkHeight(cell) {
    var height = cell.css("height");
    cell.siblings().css("height", height);
}

function save() {
    var rows = $('div[class*=row_]').length;
    //console.log(rows);
    var cols = parseInt($('input[name=months]:checked').val());
    var calendar = { "rows" : rows, "cols" : cols+1};
    calendar["title"] = $('.calendarTitle').text();
    calendar['owner'] = $('.userHook').val();
    var i, j;
    for(i = 0; i < rows; i++) {
        //calendar["rows"] += 1;
        for(j = 0; j <= cols; j++) {
            //calendar["cols"] += 1;
            var key = '.cell_' + i + '_' + j;
            var value = $(key).text();
            calendar[key] = { "row" : i, "col" : j, "content" : value };
        }
    }
    $.ajax({
        type: 'POST',
        url:  'save_calendar.php',
        data: calendar,
        success: function(response) {
            //console.log(response);
            $('.error').append(response);
            $('.container--messages').css('left', '30vw');
            $('.messages').text("Save successful");
            window.setTimeout(function() {
                $('.container--messages').css('left', '-100%');
            }, 3000);
            // toggleMenu();
        }
    });
}

// TODO: Refactor for loading
function loadCalendar() {
    $("div[class*=row_]").remove();
    if($('.loadFlag').val() === "true") {
        id = $('.idHook').val();

        var audienceCount;

        $.ajax({
            url : "load_calendar.php",
            method : "get",
            data : "id=" + id,
            success : function(data){
                result = $.parseJSON(data);
                calendarInfo = result[0];
                cells = result[1];
                console.log('test');
                console.log("Cells: " + cells);
                console.log("Rows: " + calendarInfo['rows']);
                audienceCount = calendarInfo['rows'];

                $('.calendar--title').children().hide();
                $('.calendar--title').children().text(calendarInfo['title']);
                $('.calendar--title').children().show();

                for (var i = 0; i < audienceCount; i++) {
                    var newRow = "<div class='row_"+i+"'></div>";
                    var currentRow = ".row_"+i;
                    $('.calendar').append(newRow);
                    if (i === 0) {
                        $(currentRow).addClass('row_header');
                    }
                    $(currentRow).addClass('clearfix');

                    // Evil ahead. for...in can bite my bird
                    for (var cell in cells) {
                        //console.log(cell);
                        //console.log(cells[cell]);
                        var row = parseInt(cells[cell]['row']);
                        //console.log(row);
                        if (row === i) {
                            var newCell = "<div class='cell_"+cells[cell]['row']+"_"+cells[cell]['col']+" editable'><p>"+cells[cell]['content']+"</p></div>";
                            var currentCell = ".cell_"+cells[cell]['row']+"_"+cells[cell]['col'];
                            //console.log(currentCell);
                            $(currentRow).append(newCell)
                            if (cells[cell]['row'] === "0" || cells[cell]['col'] === "0") {
                                $(currentCell).addClass("col_header");
                            }
                            if (calendarInfo['cols'] === "4") {
                                $(currentCell).addClass("cells3");
                            }
                            else {
                                $(currentCell).addClass("cells12");
                            }
                            $(currentCell).addClass('box');

                            //console.log(currentRow);
                        }
                        //console.log(currentRow);
                    }
                }
                $("div[class*=row_]").hide();
                $("div[class*=row_]").show(1000, "linear");
            }

        })
    }
}
