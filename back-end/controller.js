"use strict";

var response = require("./res");
var connection = require("./conn");

exports.customers = function (req, res) {
    connection.query("SELECT * FROM customer", function (error, rows, fields) {
        if (error) {
            response.error(error,res)
            console.log(error);
        } else {
            response.ok(rows, res);
        }
    });
};

exports.findCustomers = function (req, res) {
    var Id_user = req.params.Id_user;

    connection.query(
      "SELECT * FROM customer where Id_user = ?",
      [Id_user],
      function (error, rows, fields) {
        if (error) {
          console.log(error);
        } else {
          response.ok(rows, res);
        }
      }
    );
};

exports.createCustomers = function (req, res) {

    var Id_user = req.body.Id_user;
    var Name_user = req.body.Name_user;
    var Address_user = req.body.Address_user;
    var Phone_user = req.body.Phone_user;

    connection.query(
      "INSERT INTO customer (Name_user, Address_user,Phone_user) values (?,?,?)",
      [Name_user, Address_user, Phone_user],
      function (error, rows, fields) {
        if (error) {
          response.error(error, res);
          console.log(error);
        } else {
          response.ok("Berhasil menambahkan customer!", res);
        }
      }
    );
};

exports.updateCustomers = function (req, res) {

    var Id_user = req.body.Id_user;
    var Name_user = req.body.Name_user;
    var Address_user = req.body.Address_user;
    var Phone_user = req.body.Phone_user;

    connection.query(
      "UPDATE customer SET Name_user = ?, Address_user = ?, Phone_user = ?  WHERE Id_user = ?",
      [Name_user, Address_user, Phone_user, Id_user],
      function (error, rows, fields) {
          if (error) {
            response.error(error, res);
            console.log(error);
        } else {
            response.ok("Update Sukses", res);
        }
      }
    );
};

exports.deleteCustomers = function (req, res) {
  var Id_user = req.body.Id_user;

  connection.query(
    "DELETE FROM customer WHERE Id_user = ?",
    [Id_user],
    function (error, rows, fields) {
      if (error) {
        console.log(error);
      } else {
        response.ok("Delete Sukses", res);
      }
    }
  );
};

exports.index = function (req, res) {
    response.ok("Masuk Boss!", res);
};