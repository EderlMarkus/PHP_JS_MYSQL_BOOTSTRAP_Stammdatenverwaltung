<!DOCTYPE html>
<html lang="en">
<head>
<?php include './components/header.html';?>
</head>
  <body>
  <?php include './components/navbar.html';?>
  <form class="blendIn">
      <div class="form-group">
        <label for="name">Mitarbeitername:</label>
        <input type="text" class="form-control" id="name" fieldType = "name" placeholder="Name" />
      </div>
      <button type="submit" id="submit" class="btn btn-primary">Suchen</button>
      <table class="table table-responsive table-sm" id="table">
        <thead></thead>
        <tbody></tbody>
      </table>
      <div class="fixed bottom">
        <button
          type="submit"
          style="display: none"
          id="speichern"
          class="btn btn-primary"
        >
          Speichern
        </button>
      </div>
    </form>
    <script src="./scripts/aendern.js"></script>
  </body>
</html>
