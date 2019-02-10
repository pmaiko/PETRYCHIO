<?php
mysqli_query($connect, "CREATE TABLE images (
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
src TEXT NOT NULL,
caption TEXT NOT NULL,
text TEXT NOT NULL,
categori TEXT NOT NULL)");
mysqli_query($connect, "INSERT INTO images (src, caption, text, categori) VALUES
('2','3','4','cat1'),
('2','3','4','cat2')
");

mysqli_query($connect,"CREATE TABLE users (id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY, login TEXT NOT NULL, password TEXT NOT NULL)");
mysqli_query($connect, "INSERT INTO users (login, password) VALUES ('admin','admin')");

mysqli_query($connect, "CREATE TABLE music (
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
Song TEXT,
Name TEXT
)");
mysqli_query($connect, "INSERT INTO music (Song, Name) VALUES 
('http://ol5.mp3party.net/online/8418/8418196.mp3', 'Vanotek feat. Eneli - Tell Me Who'),
('http://drivemusic.me/dl/3IeFk__7x4KmQzNWelLp3w/1534278291/download_music/2017/08/mr.-da-nos-ohlala-radio-edit.mp3', 'Mr. Da-Nos - Ohlala (Radio Edit)')
");

?>
