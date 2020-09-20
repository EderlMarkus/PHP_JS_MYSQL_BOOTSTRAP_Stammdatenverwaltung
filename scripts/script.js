function uuidv4() {
  return (
    'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
      var r = (Math.random() * 16) | 0,
        v = c == 'x' ? r : (r & 0x3) | 0x8;
      return v.toString(16);
    }) + '-uniqueId'
  );
}

function addMarginToBottom() {
  const body = $('body');
  const bottomElement = $('.fixed.bottom');

  if (bottomElement.length > 0) {
    var height = $('.fixed.bottom').innerHeight();
    body.css('margin-bottom', height + 'px');
  }
}

function checkIfElementsValid() {
  let retValue = true;
  $('select, input').each(function () {
    if (!$(this)[0].checkValidity()) {
      retValue = false;
    }
    $(this)[0].reportValidity();
  });
  return retValue;
}

$(document).ready(function () {
  addMarginToBottom();
});
