CREATE TABLE applicant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    gender VARCHAR(255),
    address VARCHAR(255),
    state VARCHAR(255),
    nationality VARCHAR(255),
    job_title VARCHAR(255),  -- (e.g., Nurse, Doctor)
    qualifications VARCHAR(255),  -- job position (e.g., Medical Degree, Nursing Degree)
    years_of_experience INT,  --  field for years of experience 
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
);

CREATE TABLE user_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password TEXT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE activity_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    username VARCHAR(255),
    actions VARCHAR(255),
    action_details TEXT,
action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id)
);

ALTER TABLE activity_logs ADD COLUMN action VARCHAR(255);

INSERT INTO applicant (first_name, last_name, email, gender, address, state, nationality, job_title, qualifications, years_of_experience, date_added) VALUES
('Sophia', 'Roberts', 'sophia.roberts@email.com', 'Female', '3939 Birch Ave, Town', 'TX', 'American', 'Healthcare Assistant', 'Health Care Assistant Cert', 3, '2024-10-31 17:45:00'),
('Lucas', 'Nelson', 'lucas.nelson@email.com', 'Male', '4040 Maple St, City', 'PA', 'Canadian', 'Nurse', 'Bachelor of Nursing', 5, '2024-10-30 16:30:00'),
('Isabella', 'Carter', 'isabella.carter@email.com', 'Female', '4141 Oak Ave, Village', 'FL', 'American', 'Technician', 'Medical Technician Cert', 4, '2024-10-29 15:20:00'),
('Mason', 'Scott', 'mason.scott@email.com', 'Male', '4242 Pine Blvd, City', 'NJ', 'American', 'Surgeon', 'MD, Surgical Residency', 22, '2024-10-28 14:00:00'),
('Amelia', 'Morris', 'amelia.morris@email.com', 'Female', '4343 Ash St, Village', 'TX', 'Canadian', 'Doctor', 'Medical Degree, Board Certified', 14, '2024-10-27 13:30:00'),
('Oliver', 'Mitchell', 'oliver.mitchell@email.com', 'Male', '4444 Cedar Ave, Town', 'FL', 'American', 'Nurse', 'Bachelor of Nursing', 6, '2024-10-26 12:15:00'),
('Ava', 'Garcia', 'ava.garcia@email.com', 'Female', '4545 Birch Blvd, City', 'PA', 'Canadian', 'Healthcare Assistant', 'Health Care Assistant Cert', 2, '2024-10-25 11:00:00'),
('Elijah', 'Rodriguez', 'elijah.rodriguez@email.com', 'Male', '4646 Pine St, Village', 'TX', 'American', 'Technician', 'Medical Technician Cert', 7, '2024-10-24 09:45:00'),
('Mia', 'Perez', 'mia.perez@email.com', 'Female', '4747 Maple Ave, Town', 'FL', 'Canadian', 'Doctor', 'Medical Degree', 12, '2024-10-23 08:30:00'),
('Liam', 'Hernandez', 'liam.hernandez@email.com', 'Male', '4848 Cedar Blvd, City', 'NJ', 'American', 'Surgeon', 'MD, Surgical Residency', 20, '2024-10-22 07:20:00'),
('Ella', 'King', 'ella.king@email.com', 'Female', '4949 Oak Ave, Town', 'TX', 'Canadian', 'Nurse', 'Bachelor of Nursing', 3, '2024-10-21 06:00:00'),
('Jack', 'Miller', 'jack.miller@email.com', 'Male', '5050 Ash Blvd, Village', 'TX', 'Canadian', 'Technician', 'Medical Technician Cert', 6, '2024-10-20 05:15:00'),
('Charlotte', 'Gonzalez', 'charlotte.gonzalez@email.com', 'Female', '5252 Pine St, Town', 'TX', 'American', 'Doctor', 'Medical Degree, Board Certified', 10, '2024-10-19 04:30:00'),
('Benjamin', 'Taylor', 'benjamin.taylor@email.com', 'Male', '5353 Oak Blvd, Village', 'NJ', 'Canadian', 'Surgeon', 'MD, Surgical Residency', 30, '2024-10-18 03:15:00'),
('Hazel', 'Johnson', 'hazel.johnson@email.com', 'Female', '5454 Maple Blvd, City', 'TX', 'American', 'Healthcare Assistant', 'Health Care Assistant Cert', 3, '2024-10-17 02:10:00'),
('Harper', 'Martinez', 'harper.martinez@email.com', 'Female', '5555 Cedar Blvd, Town', 'FL', 'Canadian', 'Technician', 'Medical Technician Cert', 5, '2024-10-16 01:00:00'),
('Ethan', 'Davis', 'ethan.davis@email.com', 'Male', '5656 Pine Ave, City', 'PA', 'American', 'Nurse', 'Bachelor of Nursing', 7, '2024-10-15 00:35:00'),
('Maddison', 'White', 'maddison.white@email.com', 'Female', '5757 Maple Blvd, Village', 'TX', 'Canadian', 'Doctor', 'Medical Degree, Board Certified', 9, '2024-10-14 23:20:00'),
('Lily', 'Thompson', 'lily.thompson@email.com', 'Female', '5858 Oak Blvd, City', 'NJ', 'American', 'Technician', 'Medical Technician Cert', 4, '2024-10-13 22:00:00'),
('Noah', 'Walker', 'noah.walker@email.com', 'Male', '5959 Birch Ave, Village', 'TX', 'Canadian', 'Healthcare Assistant', 'Health Care Assistant Cert', 1, '2024-10-12 21:45:00'),
('Mason', 'Young', 'mason.young@email.com', 'Male', '6060 Ash Blvd, City', 'FL', 'American', 'Surgeon', 'MD, Surgical Residency', 15, '2024-10-11 20:35:00'),
('Aria', 'Hall', 'aria.hall@email.com', 'Female', '6161 Maple Ave, Village', 'TX', 'Canadian', 'Nurse', 'Bachelor of Nursing', 3, '2024-10-10 19:25:00'),
('Amos', 'Adams', 'amos.adams@email.com', 'Male', '6262 Pine Blvd, City', 'PA', 'American', 'Technician', 'Medical Technician Cert', 6, '2024-10-09 18:10:00'),
('Maya', 'Evans', 'maya.evans@email.com', 'Female', '6363 Oak St, Town', 'TX', 'Canadian', 'Doctor', 'Medical Degree', 11, '2024-10-08 17:00:00'),
('Isaac', 'Parker', 'isaac.parker@email.com', 'Male', '6464 Ash Blvd, City', 'NJ', 'American', 'Healthcare Assistant', 'Health Care Assistant Cert', 2, '2024-10-07 15:55:00'),
('Victoria', 'Sanchez', 'victoria.sanchez@email.com', 'Female', '6565 Maple St, Town', 'FL', 'Canadian', 'Technician', 'Medical Technician Cert', 7, '2024-10-06 14:45:00'),
('David', 'Baker', 'david.baker@email.com', 'Male', '6666 Oak Blvd, Village', 'TX', 'American', 'Nurse', 'Bachelor of Nursing', 4, '2024-10-05 13:35:00'),
('Sophia', 'Harris', 'sophia.harris@email.com', 'Female', '6767 Birch Ave, City', 'PA', 'Canadian', 'Doctor', 'Medical Degree, Board Certified', 10, '2024-10-04 12:25:00'),
('Jack', 'Nelson', 'jack.nelson@email.com', 'Male', '6868 Pine Blvd, Town', 'TX', 'American', 'Technician', 'Medical Technician Cert', 5, '2024-10-03 11:10:00'),
('Zoe', 'Lopez', 'zoe.lopez@email.com', 'Female', '6969 Maple Ave, City', 'NJ', 'Canadian', 'Surgeon', 'MD, Surgical Residency', 20, '2024-10-02 10:00:00'),
('Elena', 'Miller', 'elena.miller@email.com', 'Female', '7070 Ash Blvd, Town', 'TX', 'American', 'Healthcare Assistant', 'Health Care Assistant Cert', 4, '2024-10-01 08:50:00'),
('Sebastian', 'Clark', 'sebastian.clark@email.com', 'Male', '7171 Pine Ave, City', 'PA', 'Canadian', 'Nurse', 'Bachelor of Nursing', 6, '2024-09-30 07:40:00'),
('Charlotte', 'Allen', 'charlotte.allen@email.com', 'Female', '7272 Cedar Blvd, Village', 'TX', 'American', 'Technician', 'Medical Technician Cert', 8, '2024-09-29 06:30:00'),
('Emily', 'Wright', 'emily.wright@email.com', 'Female', '7373 Oak Blvd, Town', 'NJ', 'Canadian', 'Doctor', 'Medical Degree, Board Certified', 9, '2024-09-28 05:20:00'),
('Nolan', 'Evans', 'nolan.evans@email.com', 'Male', '7474 Birch Blvd, City', 'TX', 'American', 'Healthcare Assistant', 'Health Care Assistant Cert', 1, '2024-09-27 04:15:00'),
('Evelyn', 'Young', 'evelyn.young@email.com', 'Female', '7575 Pine Blvd, Village', 'TX', 'Canadian', 'Technician', 'Medical Technician Cert', 6, '2024-09-26 03:00:00'),
('Matthew', 'Moore', 'matthew.moore@email.com', 'Male', '7676 Ash St, Town', 'TX', 'American', 'Nurse', 'Bachelor of Nursing', 5, '2024-09-25 01:50:00'),
('Sarah', 'King', 'sarah.king@email.com', 'Female', '7777 Maple Ave, City', 'FL', 'Canadian', 'Doctor', 'Medical Degree', 11, '2024-09-24 00:40:00'),
('Ella', 'Bennett', 'ella.bennett@email.com', 'Female', '7878 Birch Blvd, Town', 'TX', 'American', 'Healthcare Assistant', 'Health Care Assistant Cert', 2, '2024-09-23 23:30:00'),
('Henry', 'Lopez', 'henry.lopez@email.com', 'Male', '7979 Maple St, City', 'PA', 'Canadian', 'Nurse', 'Bachelor of Nursing', 4, '2024-09-22 22:10:00'),
('Grace', 'Morris', 'grace.morris@email.com', 'Female', '8080 Pine Ave, Village', 'TX', 'American', 'Technician', 'Medical Technician Cert', 3, '2024-09-21 21:00:00'),
('Alexander', 'Carter', 'alexander.carter@email.com', 'Male', '8181 Oak Blvd, City', 'NJ', 'Canadian', 'Doctor', 'Medical Degree, Board Certified', 15, '2024-09-20 19:50:00'),
('Nora', 'Reed', 'nora.reed@email.com', 'Female', '8282 Ash Blvd, Village', 'TX', 'American', 'Surgeon', 'MD, Surgical Residency', 12, '2024-09-19 18:40:00'),
('Isaac', 'Perry', 'isaac.perry@email.com', 'Male', '8383 Maple Blvd, City', 'FL', 'Canadian', 'Healthcare Assistant', 'Health Care Assistant Cert', 3, '2024-09-18 17:30:00'),
('Madeline', 'Ross', 'madeline.ross@email.com', 'Female', '8484 Birch Ave, Town', 'PA', 'American', 'Technician', 'Medical Technician Cert', 7, '2024-09-17 16:10:00'),
('Joseph', 'Mitchell', 'joseph.mitchell@email.com', 'Male', '8585 Cedar St, Village', 'TX', 'Canadian', 'Nurse', 'Bachelor of Nursing', 5, '2024-09-16 15:05:00'),
('Ella', 'Cameron', 'ella.cameron@email.com', 'Female', '8686 Oak Blvd, Town', 'NJ', 'American', 'Doctor', 'Medical Degree, Board Certified', 10, '2024-09-15 14:00:00'),
('Isaiah', 'Baker', 'isaiah.baker@email.com', 'Male', '8787 Pine St, City', 'FL', 'Canadian', 'Surgeon', 'MD, Surgical Residency', 18, '2024-09-14 12:45:00'),
('Mila', 'Shaw', 'mila.shaw@email.com', 'Female', '8888 Ash Ave, Village', 'TX', 'American', 'Technician', 'Medical Technician Cert', 5, '2024-09-13 11:30:00'),
('Elijah', 'Miller', 'elijah.miller@email.com', 'Male', '8989 Cedar Blvd, City', 'NJ', 'Canadian', 'Healthcare Assistant', 'Health Care Assistant Cert', 4, '2024-09-12 10:20:00');
