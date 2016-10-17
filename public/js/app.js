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
          console.log(data['user_id']);
          $("#user" + data['user_id']).remove();
      },
      error: function (data) {
          console.log('Error:', data);
      }
    });
  });
});

  // $.ajax('/festival-subscriptions',
  //     { dataType: 'json',
  //     success: function(data) {
  //       var tbody = $('.fave-festivals');
  //       tbody.empty();

  //       data.forEach(function(f) {
  //         var row = $('<tr>').addClass('fave')
  //         .attr('data-id', f['id'])
  //         .appendTo(tbody);
  //         var nameCol = $('<td>').appendTo(row);
  //         var link = $('<a>').attr('href', '/festivals/' + f['id'])
  //         .text(f['name'])
  //         .appendTo(nameCol);
  //         buildFestival(f['date'], row);
  //         buildFestival(f['location'], row);
  //         buildFestival(display(f['price']), row);
  //         buildFestival(display(f['camping']), row);

  //         displayCost(f['time_car'], f['price_car'], row);
  //         displayCost(f['time_bus'], f['price_bus'], row);
  //         displayCost(f['time_flight_in'], f['price_flight'], row);

  //         $('<td>').html('<button class="remove-fave"><i class="fa fa-star"></i> Remove</button>').appendTo(row);
  //       });
  //     }
  //   }
