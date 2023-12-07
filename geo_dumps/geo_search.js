/**
 * Teste em geojson.io
 */
db.createCollection("locations")

db.locations.insertOne({
    "_id": UUID(),
    "type": "Feature",
    "properties": {},
    "geometry": {
        "coordinates": [
            -46.6472880496342,
            -23.551371984997232
        ],
        "type": "Point"
    }
})

db.locations.insertMany([
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Golden Hops Elixir",
            "type": "IPA (India Pale Ale)",
            "price": "1250"
        },
        "geometry": {
            "coordinates": [
                -46.6472880496342,
                -23.551371984997232
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Midnight Velvet Porter",
            "type": "Stout",
            "price": "899"
        },
        "geometry": {
            "coordinates": [
                -46.648073805241665,
                -23.548523479696584
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Citrus Zest Saison",
            "type": "Pilsner",
            "price": "1075"
        },
        "geometry": {
            "coordinates": [
                -46.64282352913622,
                -23.553565619421192
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Mountain Peak IPA",
            "type": "Wheat Beer",
            "price": "1233"
        },
        "geometry": {
            "coordinates": [
                -46.65257404190402,
                -23.555366336736483
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Amber Twilight Ale",
            "type": "Amber Ale",
            "price": "990"
        },
        "geometry": {
            "coordinates": [
                -46.659752990866224,
                -23.56089929555327
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Midnight Velvet Porter",
            "type": "Porter",
            "price": "1150"
        },
        "geometry": {
            "coordinates": [
                -46.640109100673016,
                -23.545576685124814
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Harvest Wheat Whispers",
            "type": "Wheat Beer",
            "price": "850"
        },
        "geometry": {
            "coordinates": [
                -46.65761002102718,
                -23.54335017431424
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Bavarian Bliss Bock",
            "type": "Bock",
            "price": "1350"
        },
        "geometry": {
            "coordinates": [
                -46.63653748427461,
                -23.562241575888265
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Mystic Oak Amber Ale",
            "type": "Amber Ale",
            "price": "1225"
        },
        "geometry": {
            "coordinates": [
                -46.628037037245235,
                -23.56862540439377
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Tropical Breeze Lager",
            "type": "Lager",
            "price": "1050"
        },
        "geometry": {
            "coordinates": [
                -46.655609915843684,
                -23.57317573889621
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Enchanted Abbey Tripel",
            "type": "Belgian Tripel",
            "price": "1575"
        },
        "geometry": {
            "coordinates": [
                -46.64054246133358,
                -23.578228707212077
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Frosted Raspberry Wheat",
            "type": "Wheat Beer",
            "price": "900"
        },
        "geometry": {
            "coordinates": [
                -46.68337955676526,
                -23.564817944172205
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Velvet Vanilla Cream Ale",
            "type": "Cream Ale",
            "price": "1100"
        },
        "geometry": {
            "coordinates": [
                -46.68602382191514,
                -23.544295210780675
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Golden Hops Elixir",
            "type": "IPA",
            "price": "1280"
        },
        "geometry": {
            "coordinates": [
                -46.65223598944186,
                -23.56444091497991
            ],
            "type": "Point"
        }
    },
    {
        "_id": UUID(),
        "type": "Feature",
        "properties": {
            "name": "Cherry Blossom Euphoria",
            "type": "Sour Beer",
            "price": "1420"
        },
        "geometry": {
            "coordinates": [
                -46.640718745676395,
                -23.566649213430125
            ],
            "type": "Point"
        }
    }
])

db.locations.createIndex({
    geometry: "2dsphere"
})

db.locations.find({}, {_id: false})

db.locations.drop()

db.locations.find({
    geometry: {
        $nearSphere: {
            $geometry: {
                type: "Point",
                coordinates: [
                    -46.640607575424866,
                    -23.557036821754764
                ]
            },
            $maxDistance: 1000
        }
    }
}, { _id: false })

