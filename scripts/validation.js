function isValidNameInput(input) {
  if (input == null || input == '') return false;
  let textContainsNumber = /\d/g.test(input);
  return !textContainsNumber;
}

function checkIfInputIsValidByFieldType(fieldType, input) {
  if (input === null || typeof input === 'undefined' || input === '') {
    return false;
  }
  switch (true) {
    case fieldType.indexOf('name') > -1:
      return isValidNameInput(input);
    case fieldType.indexOf('address') > -1:
      return isValidAddressInput(input);
    case fieldType.indexOf('birthdate') > -1 ||
      fieldType.indexOf('dateEntry') > -1 ||
      fieldType.indexOf('dateLeave') > -1 ||
      fieldType.indexOf('date') > -1:
      return isValidDateInput(input);
    case fieldType.indexOf('status') > -1:
      return validateStatusInput(input);
    case fieldType.indexOf('salary') > -1:
      return isValidSalarayInput(input);
    default:
      break;
  }
}

function isValidTextInput(input) {
  if (input == null || input == '') return false;
  let textContainsNumber = /\d/g.test(input);
  return !textContainsNumber;
}

function isValidDateInput(input) {
  if (input == null || input == '') return false;
  let validDateText = /[0-9][0-9][0-9][0-9]-[[0-9][0-9]-[[0-9][0-9]/.test(
    input
  );
  return validDateText;
}

function isValidSalarayInput(input) {
  if (input == null || input == '') return false;
  let validInput = /^[0-9]*$/.test(input);
  return validInput;
}

function validateStatusInput(input) {
  if (input == null || input == '') return false;
  var input = input.trim().toLowerCase();
  return input === 'aktiv' || input === 'inaktiv';
}

function isValidAddressInput(input) {
  if (input == null || input == '') return false;
  return true;
}

function addDangerElementToInputField(id) {
  let small = $(
    "<small id='" +
      id +
      "Danger' class='danger text-danger " +
      id +
      "'>Bitte valide Daten eingeben.</small>"
  );

  return small;
}

/**
 * TODO: bei jedem input feld muss small geadded werden, wenn input keine id dann id erstellen
 */
function addDangerElements() {
  $('input').each(function () {
    let id = $(this).attr('id');
    if (typeof id === 'undefined') {
      id = uuidv4();
    }
    $(this).attr('id', id);
    let dangerExists = $('#' + id + 'Danger').length > 0;

    if (!dangerExists) {
      addDangerElementToInputField($(this), id);
    }
  });
}

function checkIfValidById(id, input) {
  switch (true) {
    case id.indexOf('name') > -1:
      return isValidNameInput(input);
    case id.indexOf('address') > -1:
      return isValidAddressInput(input);
    case id.indexOf('birthdate') > -1 ||
      id.indexOf('dateEntry') > -1 ||
      id.indexOf('dateLeave') > -1:
      return isValidDateInput(input);
    default:
      break;
  }
}

function checkIfValidByType(type, input) {
  switch (true) {
    case type.indexOf('text') > -1:
      return isValidTextInput(input);
    case type.indexOf('date') > -1:
      return isValidDateInput(input);
    default:
      break;
  }
}

function removeDangerElementFromInputField(inputfield) {
  inputfield.next('small').remove();
}

function validateForm() {
  let isValid;
  let inputsAreAllValid = true;
  let inputFields = $('input');

  inputFields.each(function () {
    removeDangerElementFromInputField($(this));

    let type = $(this).attr('type');
    let id = $(this).attr('id');
    let fieldType = $(this).attr('fieldType');
    let input = $(this).val();

    isValid = checkIfInputIsValidByFieldType(fieldType, input);

    if (!isValid) {
      let dangerElement = addDangerElementToInputField($(this), id);
      dangerElement.insertAfter($(this));
      dangerElement.css('display', 'block');
      inputsAreAllValid = false;
      return false;
    }
  });

  return inputsAreAllValid;
}
