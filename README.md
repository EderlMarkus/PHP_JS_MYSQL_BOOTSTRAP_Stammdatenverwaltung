# Stammdatenverwaltung

## Getting started

- das file in den lokalen htdocs Ordner verschieben
- XAMPP starten
- zu localhost/phpmyadmin wechseln
- neue Datenbank anlegen
- Datenbank "sqa_fernlehre01" benennen
- index.html starten.

## API Calls

Folgende Schnittstellen wurden definiert:

- backend/API/MITARBEITER/ADD
  Parameter: ["id", "address", "birthdate", "dateEntry", "dateLeave", "name", "salary", "status"]
  Method: POST
- backend/API/MITARBEITER/GET
  Parameter: ["id"]
  Method: GET
- backend/API/MITARBEITER/UPDATE
  Parameter: ["id", "address", "birthdate", "dateEntry", "dateLeave", "name", "salary", "status"]
  Method: POST
- backend/API/MITARBEITER/DELETE
  Parameter: ["id"]
  Method: POST
- backend/API/MITARBEITER/GETBYNAME
  Parameter: ["name"]
  Method: GET
- backend/API/MITARBEITER/GETLAST20
  Parameter: []
  Method: GET
