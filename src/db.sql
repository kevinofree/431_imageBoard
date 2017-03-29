CREATE TABLE USER
(
  Username varchar(20) NOT NULL UNIQUE,
  Password varchar(20) NOT NULL,
  FullName varchar(30) NOT NULL,
  Status tiny int,
  PRIMARY KEY (Username)
);

CREATE TABLE MailBox
{
 MsgID int NOT NULL UNIQUE AUTO_INCREMENT,
 MsgText varchar(250) NOT NULL,
 Status tiny int NOT NULL,
 Subject varchar(20),
 MsgDate DateTime NOT NULL,
 Sender varchar(20) NOT NULL,
 Receiver varchar(20) NOT NULL,
 PRIMARY KEY (MsgID),
 FOREIGN KEY (Receiver) REFERENCES USER(Username),
 FOREIGN KEY (Sender) REFERENCES USER(Username),
};

CREATE TABLE CHATROOM
{
  RoomNo int NOT NULL UNIQUE AUTO_INCREMENT,
  Content varchar,
  StartUser varchar(20),
  FOREIGN KEY (StartUser) REFERENCES USER(Username),
  PRIMARY KEY (RoomNo)
};

CREATE TABLE FORUM
{
  ForumName varchar(20),
  Picture longblob NOT NULL,
  Status tiny int,
  Description varchar(250),
  Moderator varchar(20),
  PRIMARY KEY (ForumName),
  FOREIGN KEY (Moderator) REFERENCES USER(Username)
};

CREATE TABLE THREAD{
  ThreadNo int NOT NULL,
  FName varchar(20),
  Tdate DateTime NOT NULL,
  Status tiny int,
  Title varchar(20)
  StartUser varchar(20),
  FOREIGN KEY (StartUser) REFERENCES USER(Username),
  FOREIGN KEY (FName) REFERENCES FORUM(ForumName)
};

CREATE TABLE POST{
  PostNo int NOT NULL,
  PostText varchar(250),
  PostDate DateTime NOT NULL
};

CREATE TABLE CHATUSER
{
  Rno int NOT NULL,
  User varchar(20) NOT NULL,
  FOREIGN KEY (Rno) REFERENCES CHATROOM(RoomNo),
  FOREIGN KEY (User) REFERENCES USER(Username)
};

CREATE TABLE RANK
{
  UserN varchar(20),
  FN varchar(20),
  ThNo int,
  Ranking int,
  FOREIGN KEY (UserN) REFERENCES USER(Username),
  FOREIGN KEY (FN) REFERENCES FORUM(ForumName),
  FOREIGN KEY (ThNo) REFERENCES THREAD(ThreadNo),
}
