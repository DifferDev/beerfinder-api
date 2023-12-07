CREATE TABLE `beers`
(
    `id`    int(11)      NOT NULL AUTO_INCREMENT,
    `name`  varchar(255) NOT NULL,
    `type`  varchar(255) NOT NULL,
    `price` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `locations`
(
    `id`        int(11)        NOT NULL AUTO_INCREMENT,
    `beer_id`   int(11)        NOT NULL,
    `latitude`  decimal(13, 8) NOT NULL,
    `longitude` decimal(13, 8) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT fk_locations_beer_id
        FOREIGN KEY (`beer_id`) REFERENCES beers (`id`)
);

drop table beers;
drop table locations;

INSERT INTO beerfinder.beers (name, type, price)
VALUES ('Red Hops Elixir', 'IPA (India Pale Ale)', '1250'),
       ('Midnight Velvet Porter', 'Stout', '899'),
       ('Citrus Zest Saison', 'Pilsner', '1075'),
       ('Mountain Peak IPA', 'Wheat Beer', '1233'),
       ('Amber Twilight Ale', 'Amber Ale', '990'),
       ('Midnight Velvet Porter', 'Porter', '1150'),
       ('Harvest Wheat Whispers', 'Wheat Beer', '850'),
       ('Bavarian Bliss Bock', 'Bock', '1350'),
       ('Mystic Oak Amber Ale', 'Amber Ale', '1225'),
       ('Tropical Breeze Lager', 'Lager', '1050'),
       ('Enchanted Abbey Tripel', 'Belgian Tripel', '1575'),
       ('Frosted Raspberry Wheat', 'Wheat Beer', '900'),
       ('Velvet Vanilla Cream Ale', 'Cream Ale', '1100'),
       ('Golden Hops Elixir', 'IPA', '1280'),
       ('Cherry Blossom Euphoria', 'Sour Beer', '1420')
;

INSERT INTO beerfinder.locations
    (beer_id, latitude, longitude)
VALUES (1, -46.64728805, -23.55137198),
       (2, -46.64807381, -23.54852348),
       (3, -46.64282353, -23.55356562),
       (4, -46.65257404, -23.55536634),
       (5, -46.65975299, -23.56089930),
       (6, -46.64010910, -23.54557669),
       (7, -46.65761002, -23.54335017),
       (8, -46.63653748, -23.56224158),
       (9, -46.62803704, -23.56862540),
       (10, -46.65560992, -23.57317574),
       (11, -46.64054246, -23.57822871),
       (12, -46.68337956, -23.56481794),
       (13, -46.68602382, -23.54429521),
       (14, -46.65223599, -23.56444091),
       (15, -46.64071875, -23.56664921)
;

SELECT *
FROM locations
INNER JOIN beers b
    on locations.beer_id = b.id
WHERE 6371 * 2 * ASIN(
    SQRT(
            POW(SIN((RADIANS(-46.64592616343512) - RADIANS(latitude)) / 2), 2) +
            COS(RADIANS(-46.64592616343512)) * COS(RADIANS(latitude)) *
            POW(SIN((RADIANS(-23.560764242448684) - RADIANS(longitude)) / 2), 2)
    )
) < 1;

SELECT *
FROM locations
WHERE 6371 * 2 * ASIN(
    SQRT(
        POW(SIN((RADIANS(:search_latitude) - RADIANS(latitude)) / 2), 2) +
        COS(RADIANS(:search_latitude)) * COS(RADIANS(latitude)) *
        POW(SIN((RADIANS(:search_longitude) - RADIANS(longitude)) / 2), 2)
    )
) < :radius;