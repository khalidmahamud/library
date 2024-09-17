$(document).ready(function () {
  function loadBooks(query) {
    $.ajax({
      url: "../views/search.php",
      type: "GET",
      data: { query: query },
      success: function (data) {
        $("#search-results").html(data);
        if (query.trim() !== "") {
          $("#results-heading").text("Search Results");
        } else {
          $("#results-heading").text("All Books");
        }
      },
    });
  }

  loadBooks("");

  $("#searchbar").on("input", function () {
    let query = $(this).val();
    loadBooks(query);
  });
});
