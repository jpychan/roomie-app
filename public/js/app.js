$(function() {

  var baseUrl = 'http://localhost:8000/';

  $('.groupMemberRemove').on('click', function(e) {

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

    e.preventDefault();

    var formData = {
        user_id: $(this).val(),
    };

    var group_id = $('#groupId').val();

    $.ajax({
      type: "POST",
      url: baseUrl + 'group/' + group_id + '/removeMember',
      data: formData,
      success: function (data) {
          $("#user" + data['user_id']).remove();
      },
      error: function (data) {
          console.log('Error:', data);
      }
    });
  });

  $('#newExpenseForm').on('click', '#divideCheckbox', function(e) {

    var breakdown = $('#expenseBreakdown');

    if(!$('#divideCheckbox').is(":checked")) {
      breakdown.show();
    }
    else {
      breakdown.hide();
    }
  });

  $('#newExpenseForm').on('click', '#divideCheckbox', function(e) {

    var breakdown = $('#expenseBreakdown');

    var inputs = breakdown.find('input');
    if(!$('#divideCheckbox').is(":checked")) {
      inputs.attr('required', true);
      breakdown.show();
    }
    else {
      inputs.removeAttr('required');
      breakdown.hide();
    }
  });

  $('#newExpenseForm').on('click', '.groupMemberRemoveBtn', function(e) {
    $(this).closest('.row').remove();
  });
});
