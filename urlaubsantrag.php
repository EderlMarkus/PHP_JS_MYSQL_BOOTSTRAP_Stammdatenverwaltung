<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include './components/header.html';?>
  </head>
  <body>
  <?php include './components/navbar.html';?>
  <form class="blendIn">
    <div class="row">
    <div class="col-sm">
    <div class="form-group">
      <label for="name">Mitarbeitername:</label>
      <select
        required
        class="form-control"
        id="name"
      ></select>
    </div>
    </div>

    </div>
    <div class="row">
      <div class="col-sm">
    <button type="submit" id="plan" class="btn btn-primary">
        Urlaub planen
      </button>
    </div>
    </div>
    <div class="dateInputFields" style="display: none">
    <div class="row mt-3">
      <div class="col-sm">
      <div class="form-group">
      <label for="vacationStart">Urlaub Start:</label>
      <input required type="date" class="form-control" id="vacationStart" />
    </div>
      </div>
      <div class="col-sm">
      <div class="form-group">
      <label for="vacationEnd">Urlaub Ende:</label>
      <input required type="date" class="form-control" id="vacationEnd" />
    </div>
      </div>

    </div>

    <div class="row">
      <div class="col-sm">
    <button  id="submit" class="btn btn-primary">
        Urlaubsantrag abschicken
      </button>
    </div>
    </div>
    </div>
  </form>
  <script src="./scripts/urlaubsantrag.js?1234547"></script>
</body>
</html>