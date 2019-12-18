
# # -----------------------
#  create DATABASE COURSESYSTEM;
# -----------------------
CREATE TABLE account
(
ID VARCHAR(20) NOT NULL,
password VARCHAR(20) NOT NULL,
PRIMARY KEY (ID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# ------------------------------------------
CREATE TABLE instructor
(
workID VARCHAR(20) NOT NULL,
name VARCHAR(20) NOT NULL,
department VARCHAR(20) NOT NULL,
PRIMARY KEY (workID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# -------------------------------------------
CREATE TABLE course
(
courseID VARCHAR(20) NOT NULL,
title VARCHAR(20) NOT NULL,
workID VARCHAR(20) NOT NULL,
credit int NOT NULL,
department VARCHAR(20) NOT NULL,
expect_num int NOT NULL,
exam_type enum('考试','论文') NOT NULL,
PRIMARY KEY (courseID),
FOREIGN KEY(workID) REFERENCES instructor(workID) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# ------------------------------------------
CREATE TABLE classroom_time
(
classroom_time_id int NOT NULL auto_increment,
courseID VARCHAR(20) NOT NULL,
user_for enum('考试','上课') NOT NULL,
the_day enum('1','2','3','4','5','6','7') NOT NULL,
start_lesson enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
end_lesson enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL,
building_room VARCHAR(20) NOT NULL,
PRIMARY KEY(classroom_time_id,courseID),
FOREIGN KEY(courseID) REFERENCES course(courseID) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# ------------------------------------------
CREATE TABLE classroom
(
building_room int NOT NULL,
max_num int NOT NULL,
PRIMARY KEY (building_room)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# ---------------------------------
CREATE TABLE paper
(
courseID VARCHAR(20) NOT NULL,
theme VARCHAR(255),
ddl DATETIME NOT NULL,
PRIMARY KEY (courseID),
FOREIGN KEY(courseID) REFERENCES course(courseID) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# ---------------------------------
CREATE TABLE student
(
stuID VARCHAR(20) NOT NULL,
name VARCHAR(20) NOT NULL,
departemnt VARCHAR(20) NOT NULL,
total_credit int NOT NULL DEFAULT 0,
GPA FLOAT NOT NULL DEFAULT 0,
PRIMARY KEY (stuID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# ----------------------------------
CREATE TABLE stu_applys
(
apply_id int NOT NULL auto_increment,
courseID VARCHAR(20) NOT NULL,
stuID VARCHAR(20) NOT NULL,
state VARCHAR(20) NOT NULL,
mseeage VARCHAR(255) NOT NULL,
PRIMARY KEY (apply_id,courseID,stuID),
FOREIGN KEY(stuID) REFERENCES student(stuID) ON DELETE CASCADE,
FOREIGN KEY(courseID) REFERENCES course(courseID) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# --------------------------------
CREATE TABLE stu_takes
(
courseID VARCHAR(20) NOT NULL ,
stuID VARCHAR(20) NOT NULL,
dropped enum('是','否') NOT NULL,
grade VARCHAR(20),
PRIMARY KEY (courseID,stuID),
FOREIGN KEY(stuID) REFERENCES student(stuID) ON DELETE CASCADE ,
FOREIGN KEY(courseID) REFERENCES course(courseID) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
# -------------------------------
create trigger del_ins_account
after
delete
on instructor
for each row
 delete from account where ID = old.workID;
# -------------------------------





