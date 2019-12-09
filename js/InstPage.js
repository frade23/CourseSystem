var mysql = require('mysql');
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : '123456',
    port: '3306',
    database: 'coursesystem'
});
//同意申请会【将stu_apply中的对应state由未处理变为'同意'，并且在stu_takes中为学生增加一条相应的选课信息】
//这个操作需要事务
function agree_apply(courseID,stuID) {
    connection.connect();
    connection.query('update from ', function(err, rows, fields) {
        if (err) throw err;
        console.log('The solution is: ', rows[0].solution);
    });
    var a="fuck";
    connection.end();
}
