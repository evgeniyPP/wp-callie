(function($) {
  'use strict';

  // Mobile dropdown
  $('.has-dropdown>a').on('click', function() {
    $(this)
      .parent()
      .toggleClass('active');
  });

  // Aside Nav
  $(document).click(function(event) {
    if (!$(event.target).closest($('#nav-aside')).length) {
      if ($('#nav-aside').hasClass('active')) {
        $('#nav-aside').removeClass('active');
        $('#nav').removeClass('shadow-active');
      } else {
        if ($(event.target).closest('.aside-btn').length) {
          $('#nav-aside').addClass('active');
          $('#nav').addClass('shadow-active');
        }
      }
    }
  });

  $('.nav-aside-close').on('click', function() {
    $('#nav-aside').removeClass('active');
    $('#nav').removeClass('shadow-active');
  });

  $('.search-btn').on('click', function() {
    $('#nav-search').toggleClass('active');
  });

  $('.search-close').on('click', function() {
    $('#nav-search').removeClass('active');
  });

  // Parallax Background
  $.stellar({
    responsive: true
  });

  // Ajax
  $('#contactme-btn').on('click', function(e) {
    e.preventDefault();
    $('#contactme-btn').prop('disabled', true);

    var data = {
      action: 'contactme',
      name: $('input[name=your-name]').val(),
      email: $('input[name=your-email]').val(),
      subject: $('input[name=your-subject]').val(),
      message: $('textarea[name=your-message]').val()
    };

    $.post(
      window.wp.ajaxUrl,
      data,
      function(res) {
        if (res.success) {
          $('#contactme-message').text('Сообщение успешно отправлено!');
          $('#contactme-message').css('background', '#d4edda');
          $('#contactme-message').css('color', '#155724');
          $('#contactme-message').show();
        } else {
          $('#contactme-message').text('Произошла ошибка!');
          $('#contactme-message').css('background', '#f8d7da');
          $('#contactme-message').css('color', '#721c24');
          $('#contactme-message').show();
          console.log(res.errors);
        }

        $('#contactme-form').each(function() {
          this.reset();
        });
        $('#contactme-btn').prop('disabled', false);
      },
      'json'
    );
  });
})(jQuery);
