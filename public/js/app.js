$(document).ready(function () {
  $('#search-form').on('submit', function (e) {
      e.preventDefault();
      const query = $('#search-input').val();
      window.location.href = '/?q=' + encodeURIComponent(query);
  });

  $('.save-user').on('click', function () {
      if (!confirm('Czy na pewno chcesz zapisać zmiany tego użytkownika?')) {
          return;
      }

      const row = $(this).closest('tr');
      const id = row.data('id');
      const name = row.find('.edit-name').val();
      const email = row.find('.edit-email').val();

      $.ajax({
          url: '/user/edit',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({ id, name, email }),
          success: function (response) {
              alert('Zapisano użytkownika');
          },
          error: function (xhr) {
              alert('Błąd zapisu: ' + (
                  xhr.responseJSON?.error || xhr.statusText
              ));
          }
      });
  });
});
