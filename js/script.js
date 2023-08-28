$(document).ready(function() {
    $.ajax({
        url: '../get_walkers.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var walkerList = $('#walker-list');
            walkerList.empty();

            for (var i = 0; i < data.length; i++) {
                var walker = data[i];
                walkerList.append('<div class="walker">' +
                    '<h2>' + walker.username + '</h2>' +
                    '<p>Átlagos értékelés: ' + walker.averageRating + '</p>' +
                    '<p>Leírás: ' + walker.description + '</p>' +
                    '</div>');
            }
        },
        error: function() {
            console.log('Hiba történt az AJAX kérés során.');
        }
    });
});