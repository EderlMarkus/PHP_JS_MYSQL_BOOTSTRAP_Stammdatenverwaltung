$('#submit').click(function (e) {
  e.preventDefault();
  if (validateForm()) {
    let url = 'backend/API/MITARBEITER/GETBYNAME/?name=' + $('#name').val();

    $.get(url).done(function (response) {
      response = JSON.parse(response);
      let tbody = $('#table tbody');
      tbody.html('');
      response.forEach((element) => {
        let tbtr = $('<tr></tr>');
        for (key in element) {
          let td = $('<td>' + element[key] + '</td>');
          tbtr.append(td);
        }
        tbody.append(tbtr);
      });
      console.log(response);
    });
  }
});
