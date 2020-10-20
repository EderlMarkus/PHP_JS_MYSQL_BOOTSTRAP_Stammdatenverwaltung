$('#submit').click(function (e) {
  e.preventDefault();
  if (checkIfElementsValid()) {
    if (validateForm()) {
      let id = uuidv4();
      let name = $('#name').val();
      let address = $('#address').val();
      let birthdate = $('#birthdate').val();
      let salary = $('#salary').val();
      let status = $('#status').val();
      let dateEntry = $('#dateEntry').val();
      let dateLeave = $('#dateLeave').val();

      let obj = {
        id,
        name,
        address,
        birthdate,
        salary,
        status,
        dateEntry,
        dateLeave,
      };

      console.log(JSON.stringify(obj));

      let url = 'backend/API/MITARBEITER/ADD/';

      $.post(url, JSON.stringify(obj))
        .done(function (response) {
          response = JSON.parse(response);
          debugger;
          if (response['SUCCESS'] !== undefined) {
            alert('Mitarbeiter ' + obj.name + ' geadded!');
          } else {
            alert('Mitarbeiter nicht geadded!');
          }
        })
        .fail(function (response) {
          response = JSON.parse(response);
          alert('Mitarbeiter nicht geadded! \n' + response.ERROR);
        });
    }
  }
});
