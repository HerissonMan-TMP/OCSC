$(".button-load-data").click(function() {
    let eventId = $("#truckersmp_event_id").val();
    let url = "https://api.truckersmp.com/v2/events/" + eventId;
    $.get(url, function(data) {
        $("#title").val(data.response.name);
        $("#banner_url").val(data.response.banner);
        $("#location").val(data.response.departure.city);
        $("#destination").val(data.response.arrive.city);
        $("#server").val(data.response.server.name);
        $("#meetup_date").val(data.response.start_at);
    });
});
