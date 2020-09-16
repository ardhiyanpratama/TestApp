"use strict";

exports.ok = function (values, res) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

    var data = {
        status: 200,
        values: values,
    };
    res.json(data);
    res.end();
};