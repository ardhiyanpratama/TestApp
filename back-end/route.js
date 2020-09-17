"use strict";

module.exports = function (app) {
    var todoList = require("./controller");

    app.route("/").get(todoList.index);

    app.route("/customers").get(todoList.customers);

    app.route("/customers/:Id_user").get(todoList.findCustomers);

    app.route("/customers").post(todoList.createCustomers);

    app.route("/updateCustomers").post(todoList.updateCustomers);

    app.route("/deleteCustomers").post(todoList.deleteCustomers);
};