CREATE TABLE USER
(
  Username varchar(32) NOT NULL UNIQUE,
  Password varchar(32) NOT NULL,
  Fullname varchar(64) NOT NULL,
  Status tinyint(1) NOT NULL,
  PRIMARY KEY (Username)
);

CREATE TABLE CHATROOM
(
  RoomNo int(11) NOT NULL AUTO_INCREMENT,
  RoomName varchar(64) NOT NULL,
  StartUser varchar(32) NOT NULL,
  DateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (RoomNo),
  FOREIGN KEY (StartUser) REFERENCES USER(Username)
);

CREATE TABLE CHATROOMUSER
(
  RoomNo int(11) NOT NULL,
  User varchar(20) NOT NULL,

  FOREIGN KEY (RoomNo) REFERENCES CHATROOM(RoomNo),
  FOREIGN KEY (User) REFERENCES USER(Username)
);


CREATE TABLE CHATROOMLOG
(
  ChatID int(11) NOT NULL AUTO_INCREMENT,
  ChatEntry text NOT NULL,
  SentBy varchar(32) NOT NULL,
  RoomNo int(11) NOT NULL,
  TimeChatSent TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY(ChatID),
  FOREIGN KEY(RoomNo) REFERENCES CHATROOM(RoomNo),
  FOREIGN KEY(SentBy) REFERENCES USER(Username)
);

CREATE TABLE MAILBOX
(
  MsgID int(11) NOT NULL UNIQUE AUTO_INCREMENT,
  MsgText text NOT NULL,
  Status tinyint(1) NOT NULL,
  Subject varchar(64),
  MsgDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Sender varchar(32) NOT NULL,
  Receiver varchar(32) NOT NULL,

  FOREIGN KEY (Receiver) REFERENCES USER(Username),
  FOREIGN KEY (Sender) REFERENCES USER(Username),
  PRIMARY KEY (MsgID)
);

CREATE TABLE FORUM
(
  ForumName varchar(64),
  Picture longblob NOT NULL,
  Status tinyint(1) NOT NULL,
  Description text NOT NULL,
  Moderator varchar(32) NOT NULL,
  FOREIGN KEY (Moderator) REFERENCES USER(Username),
  PRIMARY KEY (ForumName)
);

CREATE TABLE THREAD
(
  ThreadNo int(11) NOT NULL AUTO_INCREMENT,
  FName varchar(64) NOT NULL,
  TDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Status tinyint NOT NULL,
  Title varchar(20),
  Content text NOT NULL,
  StartUser varchar(32) NOT NULL,

  FOREIGN KEY (StartUser) REFERENCES USER(Username),
  FOREIGN KEY (FName) REFERENCES FORUM(ForumName),
  PRIMARY KEY (ThreadNo)
);

CREATE TABLE POST
(
  PostNo int not NULL AUTO_INCREMENT,
  PostText varchar(250),
  PostDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  ThreadNo int(11) NOT NULL,
  Poster varchar(32) NOT NULL,
  Image longblog.
  FOREIGN KEY (Poster) REFERENCES USER(Username),
  FOREIGN KEY (ThreadNo) REFERENCES THREAD(ThreadNo),
  PRIMARY KEY (PostNo)
);

CREATE TABLE RANK
(
  Username varchar(32) NOT NULL,
  FN varchar(30) NOT NULL,
  ThNo int NOT NULL,
  Ranking int NOT NULL,
  FOREIGN KEY (Username) REFERENCES USER(Username),
  FOREIGN KEY (FN) REFERENCES FORUM(ForumName),
  FOREIGN KEY (ThNo) REFERENCES THREAD(ThreadNo)
);


CREATE TABLE BANNED
(
  FName varchar(64),
  User varchar(32) NOT NULL,
  FOREIGN KEY (User) REFERENCES USER(Username),
  FOREIGN KEY (FName) REFERENCES FORUM(ForumName)
);

CREATE TABLE REQUESTS
(
  FName varchar(64) NOT NULL,
  Description text NOT NULL,
  RequestedBy varchar(32) NOT NULL,
  FOREIGN KEY (RequestedBy) REFERENCES USER(Username)
);
