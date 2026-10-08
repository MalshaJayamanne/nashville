jQuery(document).ready(function ($) {
  /**
   * Handle button behaviour for Nginx cache purging.
   */
  $(".nginx-cache-manager-button .ab-item").on("click", function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      url: $(this).attr("href"),
      dataType: "json",
      data: {
        action: "nginx_cache_manager_purge_ajax_action",
      },
      success: function (response) {
        if (response?.status) {
          alert("Success: cache purged!");
        } else {
          alert("Error: cache purge failed!");
        }
      },
      error: function () {
        alert("Error: failed to purge cache!");
      },
    });
  });
});
