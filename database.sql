-- ============================================
-- ProjectHub — Project Idea Repository
-- Database Schema and Sample Data
-- ============================================
-- Problem Statement #37: Project Idea Repository
-- "Add project title, domain, description, technology,
--  and guide requirement; search by domain."
-- ============================================

-- ============================================
-- Main Table: project_ideas
-- ============================================
CREATE TABLE IF NOT EXISTS project_ideas (
    project_id      INT             AUTO_INCREMENT  PRIMARY KEY,
    project_title   VARCHAR(200)    NOT NULL,
    domain          VARCHAR(50)     NOT NULL,
    description     TEXT            NOT NULL,
    technology      VARCHAR(200)    NOT NULL,
    guide_required  VARCHAR(3)      NOT NULL,
    created_at      TIMESTAMP       DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- Sample Data (3–5 records)
-- ============================================
INSERT INTO project_ideas (project_title, domain, description, technology, guide_required) VALUES
('Smart Attendance System', 'AI / Machine Learning', 'An AI-powered attendance system that uses facial recognition to mark student attendance automatically during lectures.', 'Python, OpenCV, Flask, MySQL', 'Yes'),
('Blockchain Voting Platform', 'Blockchain', 'A decentralized voting application that ensures transparency and tamper-proof election results using blockchain technology.', 'Solidity, Ethereum, React, Node.js', 'Yes'),
('Campus Navigation App', 'Mobile Development', 'A mobile application that helps new students navigate the college campus with indoor maps and real-time directions.', 'Flutter, Dart, Google Maps API, Firebase', 'No'),
('IoT Weather Station', 'IoT', 'A low-cost weather monitoring station using sensors to collect temperature, humidity, and air quality data displayed on a web dashboard.', 'Arduino, ESP32, PHP, MySQL, HTML/CSS', 'Yes'),
("O'Reilly Research Toolkit", 'Data Science', 'A data analysis toolkit that aggregates research papers and provides visual summaries of trending topics in computer science.', 'Python, Pandas, Matplotlib, Flask', 'No');
