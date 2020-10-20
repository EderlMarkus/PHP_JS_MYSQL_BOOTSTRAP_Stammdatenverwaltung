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
        <input
          required
          fieldType = "name"
          type="text"
          class="form-control"
          id="name"
          placeholder="Name"
        />
      </div>
      <div class="form-group">
        <label for="address">Adresse:</label>
        <input
          type="text"
          class="form-control"
          fieldType = "address"
          id="address"
          placeholder="Adresse"
        />
      </div>
      <div class="form-group">
        <label for="birthdate">Geburtsdatum:</label>
        <input required
        fieldType = "birthdate"
        type="date" class="form-control" id="birthdate" />
      </div>
      <div class="form-group">
        <label for="salary">Gehalt:</label>
        <input
          type="number"
          fieldType = "salary"
          class="form-control"
          id="salary"
          placeholder="1000"
        />
      </div>
      </div>
      <div class="col-sm">
      <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status">
          <option>aktiv</option>
          <option>inaktiv</option>
        </select>
      </div>
      <div class="form-group">
        <label for="dateEntry">Aufnahmedatum:</label>
        <input required fieldType = "date" type="date" class="form-control" id="dateEntry" />
      </div>
      <div class="form-group">
        <label for="dateLeave">Austrittsdatum:</label>
        <input required fieldType = "date" type="date" class="form-control" id="dateLeave" />
      </div>
      </div>
      <div class="fixed bottom">
        <button type="submit" id="submit" class="btn btn-primary">
          Speichern
        </button>
      </div>
      </div>
    </form>
    <script src="./scripts/hinzufuegen.js?123"></script>
  </body>
</html>
