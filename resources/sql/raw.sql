DROP TABLE IF EXISTS categoriy;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS categorys;
DROP TABLE IF EXISTS categorie;
CREATE TABLE IF NOT EXISTS categorys (
    id INT(11) NOT NULL AUTO_INCREMENT,
    category VARCHAR(45) NOT NULL,
    category_fr VARCHAR(45) NULL DEFAULT NULL,
    category_en VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (id));

INSERT INTO `categorys` (`id`,  `category`, `category_fr`, `category_en`)
VALUES
       (1, 'Chemistry', 'Chimie', 'Chemistry'),
       (2, 'Mathematics', 'Vêtement', 'Mathematics'),
       (3, 'IT', 'Informatique', 'IT'),
       (4, 'Philosophy', 'Philosophie', 'Philosophy');
SELECT id,category,
       CASE category
           WHEN 'category_fr is null' THEN 'category_en'
           ELSE 'category_fr'
           END
FROM categorys as category;
