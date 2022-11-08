CREATE TABLE `users` (
    `user_id` int AUTO_INCREMENT,  
    `username` VARCHAR(20) NOT NULL,
    `user_password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (user_id)
);