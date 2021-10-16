var path = "{{ url('homepage/action') }}";



$('#search').typeahead({


    source: function (query, process) {

        return $.get(path, {
            term: query,
            category: $("select#category").val()

        }, function (data) {
            return process(data);

        });

    }

});