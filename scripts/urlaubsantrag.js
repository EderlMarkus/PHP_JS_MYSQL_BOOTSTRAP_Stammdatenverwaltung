function getMitarbeiterForSelect() {
  let url = 'backend/API/MITARBEITER/GETALL/';

  $.get(url).done(function (response) {
    response = JSON.parse(response);
    console.log(response);
    const selectfield = $('#name');
    response.forEach((element) => {
      let option = $(
        "<option id='" + element.id + "'>" + element.name + '</option>'
      );
      selectfield.append(option);
    });
  });
}

jQuery('#name').click(function () {
  $('.dateInputFields').css('display', 'none');
});

jQuery('#plan').click(function () {
  $('.dateInputFields').css('display', 'block');
});

jQuery('#submit').click(function (e) {
  e.preventDefault();
  const id = $('select option:selected').attr('id');
  const vacationStart = $('#vacationStart').val();
  const vacationEnd = $('#vacationEnd').val();

  const url = 'backend/API/URLAUB/ADD/';
  const obj = {
    id,
    vacationStart,
    vacationEnd,
  };

  console.log(obj);
  $.post(url, JSON.stringify(obj))
    .done(function (response) {
      console.log(response);
      response = JSON.parse(response);
      if (response['SUCCESS'] !== undefined) {
        alert('Urlaub  geadded!');
      } else {
        alert('Urlaub nicht geadded! \n' + response['ERROR']);
      }
    })
    .fail(function (response) {
      response = JSON.parse(response);
      alert('Urlaub nicht geadded! \n' + response);
    });
});

getMitarbeiterForSelect();
