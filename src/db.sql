CREATE TABLE USER
(
  Username varchar(20) NOT NULL UNIQUE,
  Password varchar(20) NOT NULL,
  FullName varchar(30) NOT NULL,
  Status int,
  PRIMARY KEY (Username)
);

CREATE TABLE MAILBOX
(
  MsgID int NOT NULL UNIQUE AUTO_INCREMENT,
  MsgText varchar(250) NOT NULL,
  Status tinyint NOT NULL,
  Subject varchar(20),
  MsgDate DateTime NOT NULL,
  Sender varchar(20) NOT NULL,
  Receiver varchar(20) NOT NULL,
  FOREIGN KEY (Receiver) REFERENCES USER(Username),
  FOREIGN KEY (Sender) REFERENCES USER(Username)
);

CREATE TABLE CHATROOM
(
  RoomNo int NOT NULL UNIQUE AUTO_INCREMENT,
  StartUser varchar(20) NOT NULL,
  Content varchar(250),
  FOREIGN KEY (StartUser) REFERENCES USER(Username),
  PRIMARY KEY (RoomNo)
);

CREATE TABLE FORUM
(
  ForumName varchar(30),
  Picture longblob NOT NULL,
  Status tinyint NOT NULL,
  Description varchar(250),
  Moderator varchar(20) NOT NULL,
  PRIMARY KEY (ForumName),
  FOREIGN KEY (Moderator) REFERENCES USER(Username)
);

CREATE TABLE THREAD
(
  ThreadNo int NOT NULL AUTO_INCREMENT,
  FName varchar(30) NOT NULL,
  TDate DateTime NOT NULL,
  Status tinyint NOT NULL,
  Title varchar(20),
  Content varchar(250) NOT NULL,
  StartUser varchar(20) NOT NULL,
  PRIMARY KEY (ThreadNo),
  FOREIGN KEY (StartUser) REFERENCES USER(Username),
  FOREIGN KEY (FName) REFERENCES FORUM(ForumName)
);

CREATE TABLE POST
(
  PostNo int not NULL AUTO_INCREMENT,
  PostText varchar(250),
  PostDate DateTime NOT NULL,
  PRIMARY KEY (PostNo)
);

CREATE TABLE CHATUSER
(
  Rno int NOT NULL,
  User varchar(20) NOT NULL,
  FOREIGN KEY (Rno) REFERENCES CHATROOM(RoomNo),
  FOREIGN KEY (User) REFERENCES USER(Username)
);

CREATE TABLE RANK
(
  UserN varchar(20) NOT NULL,
  FN varchar(30) NOT NULL,
  ThNo int NOT NULL,
  Ranking int NOT NULL,
  FOREIGN KEY (UserN) REFERENCES USER(Username),
  FOREIGN KEY (FN) REFERENCES FORUM(ForumName),
  FOREIGN KEY (ThNo) REFERENCES THREAD(ThreadNo)
);
