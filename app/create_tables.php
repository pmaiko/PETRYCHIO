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

mysqli_query($connect,"CREATE TABLE users (
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
Name TEXT NOT NULL,
Last_Name TEXT NOT NULL,
Mail TEXT NOT NULL,
Login TEXT NOT NULL,
Password TEXT NOT NULL,
Photo TEXT NOT NULL)
");
mysqli_query($connect, "INSERT INTO users (Name, Last_Name, Mail, Login, Password, Photo) VALUES ('Petya','Maiko','petyamaiko@gmail.com', 'petya','petya','users-photo/petya.jpg')");

mysqli_query($connect, "CREATE TABLE playlist_petya (
id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
Song TEXT,
Name TEXT
)");
mysqli_query($connect, "INSERT INTO playlist_petya (Song, Name) VALUES
('http://ol5.mp3party.net/online/8418/8418196.mp3', 'Vanotek feat. Eneli - Tell Me Who'),
('http://drivemusic.me/dl/3IeFk__7x4KmQzNWelLp3w/1534278291/download_music/2017/08/mr.-da-nos-ohlala-radio-edit.mp3', 'Mr. Da-Nos - Ohlala (Radio Edit)')
");

?>
