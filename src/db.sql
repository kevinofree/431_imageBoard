CREATE TABLE USER
(
  Username varchar(32) NOT NULL UNIQUE,
  Password varchar(32) NOT NULL,
  Fullname varchar(64) NOT NULL,
  Status tinyint NOT NULL,
  PRIMARY KEY (Username)
);

CREATE TABLE CHATROOM
(
  RoomNo int(11) NOT NULL AUTO_INCREMENT,
  RoomName varchar(64) NOT NULL,
  StartUser varchar(32) NOT NULL,
  DateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (StartUser) REFERENCES USER(Username),
  PRIMARY KEY (RoomNo)
);

CREATE TABLE CHATROOMLOG
(
  ChatID int(11) NOT NULL AUTO_INCREMENT,
  ChatEntry text NOT NULL,
  UserSentBy varchar(32) NOT NULL,
  RoomNo int(11) NOT NULL,
  TimeChatSent TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY(ChatID),
  FOREIGN KEY(RoomNo) REFERENCES CHATROOM(RoomNo),
  FOREIGN KEY(UserSentBy) REFERENCES USER(Username)
);

CREATE TABLE MAILBOX
(
  MsgID int(11) NOT NULL UNIQUE AUTO_INCREMENT,
  MsgText text NOT NULL,
  Status tinyint NOT NULL,
  Subject varchar(64),
  MsgDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Sender varchar(32) NOT NULL,
  Receiver varchar(32) NOT NULL,
  FOREIGN KEY (Receiver) REFERENCES USER(Username),
  FOREIGN KEY (Sender) REFERENCES USER(Username)
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
