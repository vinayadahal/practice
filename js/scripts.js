$(document).ready(function () {
    $('#selectForm').submit(function (e) {
        console.log($('#selectForm').serializeArray().length);
        if ($('#selectForm').serializeArray().length === 0 || $('#selectForm').serializeArray().length !== 4) {
            alert('Please choose everything from the dropdown.');
            e.preventDefault();
        }
        var values = {};
        $.each($('#selectForm').serializeArray(), function (i, field) {
            values[field.name] = field.value;
            console.log(values[field.name]);
        });
    });
    $('#readMoreClose').click(function () {
        closeReadMore();
    });
    $('#dropDown, #dropDownItem').mouseover(function () {
        menuListOn();
    });
    $('#dropDown, #dropDownItem').mouseout(function () {
        menuListOff();
    });
    $('#dropDownCompany, #dropDownItemCompany').mouseover(function () {
        menuListOnCompany();
    });
    $('#dropDownCompany, #dropDownItemCompany').mouseout(function () {
        menuListOffCompany();
    });

    $('#dropDownTrekking, #dropDownItemTrekking').mouseover(function () {
        menuListOnTrekking();
    });
    $('#dropDownTrekking, #dropDownItemTrekking').mouseout(function () {
        menuListOffTrekking();
    });
    $('#dropDownExp, #dropDownItemExp').mouseover(function () {
        menuListOnExp();
    });
    $('#dropDownExp, #dropDownItemExp').mouseout(function () {
        menuListOffExp();
    });
    $('#name_link').click(function () {
        show_logout();
    });
    $('#name_link').focusout(function () {
        hide_logout();
    });

    $('#title').change(function () {
        countChars();
    });

    $('#caption').change(function () {
        countCharsCaption();
    });

    $('#selectFeatured').change(function () {
        if ($(this).val() === 'Yes') {
            $('#offer').show();
            $('#lblOffer').show();
        } else {
            $('#lblOffer').hide();
            $('#offer').hide();
        }
    });

    $('#img').change(function () {
        var filesize = this.files[0].size;
        if (filesize >= 2097152) {
            alert('File size should be less than 2 MB.');
            this.value = '';
        } else {
            showImg(this);
        }
    });

    $("#deleteImage").change(function () {
        if (this.checked) {
            $("#browseBtn").css({
                'display': 'block'
            });
        } else {
            $("#browseBtn").css({
                'display': 'none'
            });
        }
    });
    $('#closeImage').click(function () {
        unloadImage();
    });

    $('#showPopForm').click(function () {
        loadForm();
    });

    $('#closeForm').click(function () {
        unloadForm();
    });

    $("#reviewForm").submit(function (event) {
        sendReview();
        event.preventDefault();
    });

    $("#generateIcons").click(function () {

    });
});

function countCharsCaption() {
    var val = $('#caption').val().length;
    if (val > 35) {
        alert('Only 35 characters are allowed in caption.');
        $('#caption').css({
            'color': '#f00'
        });
        return false;
    } else {
        $('#caption').css({
            'color': '#555'
        });
        return true;
    }
}

function countChars() {
    var val = $('#title').val().length;
    if (val > 40) {
        alert('Only 40 characters are allowed in title.');
        $('#title').css({
            'color': '#f00'
        });
        return false;
    } else if ($('#title').val() === '') {
        return false;
    } else {
        $('#title').css({
            'color': '#555'
        });
        return true;
    }

}

function validate(idArray) {
    var count = idArray.length;
    for (var i = 0; i <= count; i++) {
        if (idArray[i] === 'title') {
            countChars();
        }
        if (checkNull(idArray[i])) {
            continue;
        } else {
            alert('Please fill every fields.');
            return false;
        }
    }
    return true;
}

function checkNull(idName) {
    var id = $("#" + idName).val();
    if (id === '') {
        return false;
    } else {
        return true;
    }
}

function show_flash(id) {
    $("#" + id).fadeIn('slow');
    setInterval(function () {
        $("#" + id).fadeOut('slow');
    }, 5000);
}

function showImg(img) {
    if (img.files && img.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgLocation').attr('src', e.target.result);
        },
                reader.readAsDataURL(img.files[0]);
    }
}

function readMore() {
    $('#readMoreBack').fadeIn();
    $('#readMoreCont').fadeIn('slow');
    setScrollPosition();
}

function closeReadMore() {
    $('#readMoreBack').fadeOut('slow');
    $('#readMoreCont').fadeOut();
    $('#content').html('');
    unsetScrollPosition();
}

function setScrollPosition() {
    var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft, self.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop
    ];
    var html = jQuery('html');
    html.data('scroll-position', scrollPosition);
    html.data('previous-overflow', html.css('overflow'));
    html.css('overflow', 'hidden');
    window.scrollTo(scrollPosition[0], scrollPosition[1]);
}

function unsetScrollPosition() {
    var html = jQuery('html');
    var scrollPosition = html.data('scroll-position');
    html.css('overflow', html.data('previous-overflow'));
    window.scrollTo(scrollPosition[0], scrollPosition[1]);
}

function menuListOn() {
    $('#dropDownItem').css({
        "display": "block"
    });
}

function menuListOff() {
    $('#dropDownItem').css({
        "display": "none"
    });
}

function menuListOnCompany() {
    $('#dropDownItemCompany').css({
        "display": "block"
    });
}

function menuListOffCompany() {
    $('#dropDownItemCompany').css({
        "display": "none"
    });
}

function menuListOnTrekking() {
    $('#dropDownItemTrekking').css({
        "display": "block"
    });
}

function menuListOffTrekking() {
    $('#dropDownItemTrekking').css({
        "display": "none"
    });
}

function menuListOnExp() {
    $('#dropDownItemExp').css({
        "display": "block"
    });
}

function menuListOffExp() {
    $('#dropDownItemExp').css({
        "display": "none"
    });
}

function show_logout() {
    $("#logout_box").fadeIn('slow');
}

function hide_logout() {
    $("#logout_box").fadeOut('slow');
}

function loadImage(imageLoc) {
    $('#background').fadeIn();
    $('#fullImageWrap').fadeIn(600);
    console.log(imageLoc);
    $("#imageFull").attr('src', imageLoc);
    $("#imageFull").attr('alt', 'Full Size Image');
    setScrollPosition();
}

function unloadImage() {
    $('#background').fadeOut(600);
    $('#fullImageWrap').fadeOut();
    $("#imageFull").attr('src', '');
    $("#imageFull").attr('alt', '');
    unsetScrollPosition();
}

function loadForm(heading) {
    $('#country').val('');
    $("#background").fadeIn();
    $("#feedsBg").fadeIn(600);
    $("#popHead").html(heading);
    if (heading === "Recommend Trip") {
        $("#labelDesc").html("Recommend Trip:");
        $("#lblVisited, #txtVisited").show();
    } else if (heading === "Suggestion") {
        $("#labelDesc").html("Suggestion:");
        $("#lblVisited, #txtVisited").hide();
    } else {
        $("#labelDesc").html("Feedback:");
        $("#lblVisited, #txtVisited").hide();
    }
    $("#reviewMail").val(heading);
    setScrollPosition();
}

function unloadForm() {
    $("#success").hide();
    $("#sendError").hide();
    $("#reviewForm").show();
    $("#background").fadeOut(600);
    $("#feedsBg").fadeOut();
    $('#name').val('');
    $('#email').val('');
    $('#country').val('');
    $('#desc').val('');
    $("#departure").val('');
    unsetScrollPosition();
}

function sendReview() {
    $("#loading").show();
    $("#reviewForm").hide();
    if (validate(['name', 'country', 'email', 'desc'])) {
        var url = $("#reviewForm").attr("url");
        var name = $('#name').val();
        var email = $('#email').val();
        var country = $('#country').val();
        var desc = $('#desc').val();
        var visited = $("#departure").val();
        var reviewMail = $("#reviewMail").val();
        var dataString;
        if (visited) {
            dataString = 'name=' + name + '&email=' + email + '&country=' + country + '&desc=' + desc + '&reviewMail=' + reviewMail + '&visited=' + visited;
        } else {
            dataString = 'name=' + name + '&email=' + email + '&country=' + country + '&desc=' + desc + '&reviewMail=' + reviewMail;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: dataString,
            cache: false,
            complete: function () {
                $('#loading').hide();
            },
            success: function () {
                $("#reivewForm").hide();
                $("#success").show();
            },
            failure: function () {
                $("#reivewForm").hide();
                $("#sendError").show();
            }
        });
    }
}

function generateIcons(url) {
    $("#generating").fadeIn();
    $.ajax({
        url: url,
        type: 'get',
        cache: false,
        success: function (response) {
            $("#generating").fadeOut(function () {
                alert(response);
            });
        },
        failure: function (response) {
            $("#generating").fadeOut(function () {
                alert('Cannot generate icons');
            });
        }
    });
}
