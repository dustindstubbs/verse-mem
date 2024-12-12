function addVerse(setVerse, force, title) {
    // If verse is not empty
    if (setVerse != '') {
        if (setVerse.length < 40) {
            // Get title and text from ESV API
            $.ajax({
                url: `https://api.esv.org/v3/passage/text/?q=${setVerse}&include-passage-references=false&include-verse-numbers=false&include-headings=false&include-footnotes=false&include-short-copyright=false`,
                type: 'GET',
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Token a1112b727237c6c9e446712047194b05deda87c5")
                },
                success: function(data){
                    if (!data.passages[0]){
                        sendAlert(`We couldn't find anything for "${setVerse}". Try something like "Romans 8:1"`);
                        $( "#inputVerse" ).val('');
                    }else{
                        // If verse is not too long
                        if (data.passages[0].length < 500 || force == true) {
                            // Send verse information to PHP function for writing to DB
                            $.ajax({
                                type: 'POST',
                                url: adminURL,
                                data: {
                                    'action': 'edit_verse',
                                    'usage': 'add',
                                    'verse' : data.canonical,
                                    'text' : data.passages[0]
                                },
                                success: function(data){
                                    reloadVerses();
                                    $( "#inputVerse" ).val('');
                                }
                            });
                        }else{
                            $('#lengthModal').modal('show');
                        }
                    }
                }
            });
        }else{
            if (force !== true) {
                $('#customModal').modal('show');
                $('#customTitle').focus();
            }else{
                // Send custom string to PHP function for writing to DB
                $.ajax({
                    type: 'POST',
                    url: adminURL,
                    data: {
                        'action': 'edit_verse',
                        'usage': 'add',
                        'verse' : title,
                        'text' : $('#inputVerse').val()
                    },
                    success: function(data){
                        reloadVerses();
                        $("#inputVerse").val('');
                        $("#customTitle").val('');
                    }
                });
            }
        }
    }else{
        sendAlert('Enter a verse to add it to your list. E.g., "Romans 8:1"');
    }
}

function reloadVerses(){
    $( "#verseList" ).load(location.href + " #verseList");
}

function makeScore(key,referer){
    console.log(referer);
    Cookies.set('progress', 'up');
    var newScore = parseInt(Cookies.get('score'))+2;
    Cookies.set('score', newScore);

    // Check if won
    if (Cookies.get('score') == 10){ 
        // Finish
        $.ajax({
            type: 'POST',
            url: adminURL,
            data: {
                'action': 'edit_verse',
                'usage': 'score',
                'key': key
            },
            success: function(data){
                console.log("YOU WON!");
                playDing();
                playDing();
                $("body").html(`<div class="vh-100 container text-center d-flex flex-column gap-5 align-items-center justify-content-center"><svg xmlns="http://www.w3.org/2000/svg" width="300" height="200" viewBox="0 0 24 20" class="text-primary"><path fill="currentcolor" d="M21 14l-1.003 4c-.555-1.086-1.33-2.031-2.251-2.806l3.249-4.594c1.138.98 2.198 2.124 3.005 3.4h-3zm-.096-5.008l-3.486 4.929c-1.521-1.136-3.38-1.862-5.418-1.862-2.037 0-3.915.692-5.427 1.849l-3.481-4.923c2.497-1.858 5.567-2.985 8.908-2.985 3.342 0 6.41 1.128 8.904 2.992zm-12.41.779l.506-.486-.694-.096-.306-.63-.306.63-.694.096.506.486-.123.689.617-.33.617.33-.123-.689zm4.496-.092l1.01-.971-1.389-.191-.611-1.262-.611 1.261-1.389.192 1.011.971-.247 1.38 1.236-.662 1.236.661-.246-1.379zm3.504.19l.506-.486-.694-.096-.306-.63-.306.63-.694.096.506.486-.123.689.617-.329.617.33-.123-.69zm-13.489.731c-1.138.981-2.198 2.124-3.005 3.4h3l1.003 4c.556-1.086 1.33-2.031 2.251-2.806l-3.249-4.594z"/></svg><div class="text-primary display-3">Round Complete!</div><div class="d-flex flex-row gap-5"><a href="/${referer}" class="btn btn-light px-4 py-3">Done</a><button onclick="resetGame()" class="btn btn-primary px-4 py-2">Next Round <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-miterlimit="2" stroke-linejoin="round" height="20px" width="20px" fill-rule="evenodd" clip-rule="evenodd" class="ms-1 mb-1"><path fill="currentcolor" d="m14.523 18.787s4.501-4.505 6.255-6.26c.146-.146.219-.338.219-.53s-.073-.383-.219-.53c-1.753-1.754-6.255-6.258-6.255-6.258-.144-.145-.334-.217-.524-.217-.193 0-.385.074-.532.221-.293.292-.295.766-.004 1.056l4.978 4.978h-14.692c-.414 0-.75.336-.75.75s.336.75.75.75h14.692l-4.979 4.979c-.289.289-.286.762.006 1.054.148.148.341.222.533.222.19 0 .378-.072.522-.215z"></path></svg></button></div></div>`);
            }
        });
    }else{
        // Continue Game
        window.location.reload();
    }
}

function removeScore(){
    Cookies.set('progress', 'down');
    if (Cookies.get('score')>0){
        var newScore = parseInt(Cookies.get('score'))-1;
        Cookies.set('score', newScore);
        window.location.reload();
    }
    // Reload Game
    window.location.reload();
}

function resetGame(){
    Cookies.set('progress', null);
    Cookies.set('score', 0);
    window.location.reload();
}

function gameComplete(){
    $('#buttonNext').removeClass('disabled');
    gamecompleted = true;
}

function deleteVerse(key) {
    $.ajax({
        type: 'POST',
        url: adminURL,
        data: {
            'action': 'edit_verse',
            'usage': 'delete',
            'key' : key,
        },
        success: function(data){
            reloadVerses();
        }
    });
}

function sendAlert(alertText) {
    $( "#alert-section" ).append(`<div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">${alertText}<span type="button" class="ms-5 close" data-dismiss="alert" aria-label="Close" style="float: right;font-size: 1.5rem;font-weight: 700;line-height: 1;color: #000;text-shadow: 0 1px 0 #fff;opacity: .5;"><span aria-hidden="true">×</span></span></div>`);
}

function playDing(){
    let rando = Math.floor(Math.random() * 9) + 1;
    const audio = new Audio(`wp-content/plugins/verse-mem/assets/audio/ding-${rando}.mp3`);
    audio.play();
}

function playBad(){
    let rando = Math.floor(Math.random() * 2) + 1;
    const audio = new Audio(`wp-content/plugins/verse-mem/assets/audio/bad-${rando}.mp3`);
    audio.play();
}