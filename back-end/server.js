var express = require("express"),
    app = express(),
    port = process.env.PORT || 4000,
    bodyParser = require("body-parser"),
    controller = require("./controller");

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

var routes = require("./route");
routes(app);

app.listen(port);
console.log("Learn NodeJs, RESTful API server started on: " + port);
app.use(express.static("../front-end/index.html"));
