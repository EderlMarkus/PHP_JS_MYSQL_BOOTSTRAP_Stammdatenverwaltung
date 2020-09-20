jQuery('#getHistorie').click(function () {
  let url = 'backend/API/MITARBEITER/GETLAST20/';

  $('.extra').text('Hinzugefügt am');
  $.get(url).done(function (response) {
    let tbody = $('#table tbody');
    tbody.html('');
    response.forEach((element) => {
      let tbtr = $('<tr></tr>');
      for (key in element) {
        let td;
        if (key === 'addedOn') {
          td = $('<td>' + convertTimestamp(element[key]) + '</td>');
        } else {
          td = $('<td>' + element[key] + '</td>');
        }
        tbtr.append(td);
      }
      tbody.append(tbtr);
    });
    console.log(response);
  });
});

jQuery('#getMitarbeiterSalary').click(function () {
  $('.extra').text('Abweichung vom Durchschnittsgehalt');
  let url = 'backend/API/MITARBEITER/GETALL/';
  $.get(url).done(function (response) {
    let tbody = $('#table tbody');
    tbody.html('');
    response.forEach((element) => {
      let tbtr = $('<tr></tr>');
      for (key in element) {
        let td;
        if (key !== 'addedOn') {
          td = $('<td>' + element[key] + '</td>');
        }
        tbtr.append(td);
      }
      tbody.append(tbtr);
    });
    berechneAbweichungVonDurchschnittsgehalt();
  });
});

function convertTimestamp(timestamp) {
  let unix_timestamp = timestamp;
  // Create a new JavaScript Date object based on the timestamp
  // multiplied by 1000 so that the argument is in milliseconds, not seconds.
  var date = new Date(unix_timestamp * 1000);
  // Hours part from the timestamp
  var hours = date.getHours();
  // Minutes part from the timestamp
  var minutes = '0' + date.getMinutes();
  // Seconds part from the timestamp
  var seconds = '0' + date.getSeconds();

  // Will display time in 10:30:23 format
  var formattedTime =
    date.toLocaleDateString() +
    ', ' +
    hours +
    ':' +
    minutes.substr(-2) +
    ':' +
    seconds.substr(-2);

  return formattedTime;
}

function berechneAbweichungVonDurchschnittsgehalt() {
  let gesamtGehalt = 0;

  $('tbody tr').each(function () {
    let temp = parseInt($(this).find('td')[6].innerHTML);
    gesamtGehalt += temp;
  });

  $('tbody tr').each(function () {
    let tempGehalt = parseInt($(this).find('td')[6].innerHTML);
    console.log(tempGehalt);
    let persons = $('tr').length - 1;
    console.log(persons);

    let durchschnittsgehalt = gesamtGehalt / persons;
    console.log(durchschnittsgehalt);
    let temp = $('<td>' + (tempGehalt - durchschnittsgehalt) + '</td>');
    $(this).append(temp);
  });
}
