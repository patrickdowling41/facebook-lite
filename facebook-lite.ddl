CREATE TABLE FriendRequest (
    requestID             INTEGER NOT NULL ,
    sentOrReceived        VARCHAR2 (8) ,
    CONSTRAINT FRIENDREQUEST_PRIMARYKEY PRIMARY KEY ( requestID )
);

CREATE TABLE Friend
  (
    email                   VARCHAR2 (128) NOT NULL ,
    friendshipID            INTEGER NOT NULL
  ) ;


CREATE TABLE Friendship
  (
    friendshipID INTEGER NOT NULL ,
    startDate    DATE NOT NULL ,
    friendType   VARCHAR2 (32) NOT NULL,
    CONSTRAINT FREIDNSHIP_PRIMARYKEY PRIMARY KEY ( friendshipID )
) ;


CREATE TABLE Rating
  (
    ratingID      INTEGER NOT NULL ,
    postID	INTEGER NOT NULL ,
    raterEmail  VARCHAR2 (128) NOT NULL,
    CONSTRAINT LIKE_PRIMARYKEY PRIMARY KEY ( ratingID) 
  ) ;

CREATE TABLE Location
  (
    locationID INTEGER NOT NULL ,
    city       VARCHAR2 (64) NOT NULL ,
    country    VARCHAR2 (64) NOT NULL,
    CONSTRAINT LOCATION_PRIMARYKEY PRIMARY KEY ( locationID )
  ) ;


CREATE TABLE Post
  (
    postID         INTEGER NOT NULL ,
    replyToID      INTEGER ,
    body           VARCHAR2 (256) NOT NULL ,
    posterEmail          VARCHAR2 (128) NOT NULL ,
                   TIMESTAMP DATE NOT NULL ,
    originalPostID INTEGER ,
    CONSTRAINT POST_PRIMARYKEY PRIMARY KEY (postID)
  );


CREATE TABLE FacebookUser (
    email               VARCHAR2 (128) NOT NULL ,
    firstName           VARCHAR2 (64) NOT NULL ,
    surname             VARCHAR2 (64) NOT NULL ,
    screenName          VARCHAR2 (32) NOT NULL ,
    dateOfBirth         DATE NOT NULL ,
    gender              VARCHAR2 (8) ,
    status              VARCHAR2 (128) ,
    visibility          VARCHAR2 (16) NOT NULL ,
    passwordHash        VARCHAR2 (128) NOT NULL,
    locationID		INTEGER,
    constraint USER_PRIMARYKEY PRIMARY KEY (email)
  ) ;

CREATE TABLE UserRequest
  (
    email     VARCHAR2 (128) NOT NULL ,
    requestID INTEGER NOT NULL
  ) ;


ALTER TABLE UserRequest 
ADD FOREIGN KEY (requestID) REFERENCES FriendRequest(requestID);

ALTER TABLE Friend 
ADD FOREIGN KEY (friendshipID) REFERENCES Friendship(friendshipID);

ALTER TABLE Friend 
ADD FOREIGN KEY (email) REFERENCES FacebookUser(email);

ALTER TABLE Rating
ADD FOREIGN KEY (postID) REFERENCES Post(postID);

ALTER TABLE Rating
ADD FOREIGN KEY (raterEmail) REFERENCES FacebookUser(email);

ALTER TABLE Post 
ADD FOREIGN KEY (posterEmail) REFERENCES FacebookUser(email);

ALTER TABLE FacebookUser
ADD FOREIGN KEY (locationID) REFERENCES Location(locationID);

ALTER TABLE UserRequest
ADD FOREIGN KEY (email) REFERENCES FacebookUser (email);
