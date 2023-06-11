<div id="dataContainer">
    <!-- The loaded data will be appended here -->
</div>
<button id="loadMoreButton" data-offset="0" data-limit="10">Load More</button>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var loadMoreButton = $('#loadMoreButton');
        var dataContainer = $('#dataContainer');

        loadMoreButton.click(function() {
            var offset = loadMoreButton.data('offset');
            var limit = loadMoreButton.data('limit');

            // Send an AJAX request to the server
            $.ajax({
                url: "{{ route('data.loadMore') }}",
                type: "GET",
                data: {
                    offset: offset,
                    limit: limit
                },
                dataType: "json",
                success: function(response) {
                    if (response.length > 0) {
                        // Append the loaded data to the container
                        response.forEach(function(data) {
                            var html = '<div>' +
                                '<h3>' + data.name + '</h3>' +
                                '<p>' + data.email + '</p>' +
                                '</div>';
                            dataContainer.append(html);
                        });

                        // Update the offset for the next load
                        var newOffset = offset + limit;
                        loadMoreButton.data('offset', newOffset);
                    } else {
                        // No more data available, hide the load more button
                        loadMoreButton.hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while loading data.');
                }
            });
        });
    });
</script>
