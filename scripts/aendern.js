$('#submit').click(function (e) {
  e.preventDefault();
  if (validateForm()) {
    $('#speichern').css('display', '');
    let url = 'backend/API/MITARBEITER/GETBYNAME/?name=' + $('#name').val();
    console.log(url);
    $.get(url).done(function (response) {
      if (response) {
        let tbody = $('#table tbody');
        tbody.html('');
        turnDataIntoTable(tbody, JSON.parse(response));
        validateForm();
      }
    });
  }
});

$('#speichern').click(function (e) {
  e.preventDefault();
  console.log('speichern');
  if (validateForm()) {
    sendChanges();
  }
});

function turnDataIntoTable(tbody, data) {
  data.forEach((element) => {
    let tbtr = $('<tr></tr>');
    for (key in element) {
      let td;
      if (key.indexOf('date') > -1) {
        td = $(
          '<td class="date"><input fieldType="date" type="date" value="' +
            element[key] +
            '" /></td>'
        );
      } else if (key === 'id') {
        td = $('<td class="date">' + element[key] + '</td>');
      } else if (key === 'status') {
        let select = $('<select required></select>');
        let optionaktiv = $('<option>aktiv</option>');
        let optioninaktiv = $('<option>inaktiv</option>');
        select.append(optionaktiv);
        select.append(optioninaktiv);
        td = $('<td class="status"></td>');
        td.append(select);
        select[0].value = element[key];
      } else if (key === 'salary') {
        td = $(
          '<td><input type="text" fieldType="salary" value="' +
            element[key] +
            '"/></td>'
        );
      } else if (key === 'address') {
        td = $(
          '<td><input type="text" fieldType="address" value="' +
            element[key] +
            '"/></td>'
        );
      } else {
        td = $(
          '<td><input type="text" fieldType="name" value="' +
            element[key] +
            '"/></td>'
        );
      }
      tbtr.append(td);
    }
    tbody.append(tbtr);
  });
}
function getEnteredDataAsObject(tr) {
  let id = $(tr).find('td')[0].innerHTML;
  let name = $(tr).find('td input')[0].value;
  let address = $(tr).find('td input')[1].value;
  let birthdate = $(tr).find('td input')[2].value;
  let dateEntry = $(tr).find('td input')[3].value;
  let dateLeave = $(tr).find('td input')[4].value;
  let salary = $(tr).find('td input')[5].value;
  let status = $(tr).find('td')[7].getElementsByTagName('select')[0].value;

  let obj = {
    id,
    name,
    address,
    birthdate,
    dateEntry,
    dateLeave,
    status,
    salary,
  };
  console.log(obj);
  return obj;
}
function sendChanges() {
  if (checkIfElementsValid()) {
    $('tr').each(function () {
      var obj = getEnteredDataAsObject(this);
      let url = 'backend/API/MITARBEITER/UPDATE/';
      $.post(url, JSON.stringify(obj))
        .done(function (response) {
          response = JSON.parse(response);
          if (typeof response['SUCCESS'] !== 'undefined') {
            alert('Mitarbeiter ' + obj.name + ' geupdated!');
          } else {
            alert(
              'Mitarbeiter ' +
                obj.name +
                ' nicht geupdated! \n' +
                response.ERROR[1]
            );
          }
        })
        .fail(function (response) {
          alert(
            'Mitarbeiter ' +
              obj.name +
              ' nicht geupdated! \n' +
              response.ERROR[1]
          );
        });
    });
  }
}
